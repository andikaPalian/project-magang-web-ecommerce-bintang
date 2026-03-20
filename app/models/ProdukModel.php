<?php

declare(strict_types=1);
class ProdukModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getCategories(int $limit = 8): array
  {
    $this->db->query("SELECT * FROM categories LIMIT :limit");
    $this->db->bind("limit", $limit);

    return $this->db->resultSet();
  }

  public function getFlashSaleProducts(int $limit = 5): array
  {
    $this->db->query("SELECT * FROM products WHERE is_active = 1 AND discount_price IS NOT NULL AND discount_price > 0 ORDER BY created_at DESC LIMIT :limit");
    $this->db->bind("limit", $limit);

    return $this->db->resultSet();
  }

  public function getBestSellerProducts(int $limit = 5): array
  {
    $this->db->query("SELECT p.*, SUM(oi.quantity) AS total_terjual FROM products p JOIN order_items oi ON p.id = oi.product_id JOIN orders o ON oi.order_id = o.id WHERE p.is_active = 1 AND o.payment_status = 'paid' GROUP BY p.id ORDER BY total_terjual DESC LIMIT :limit");
    $this->db->bind("limit", $limit);
    $result = $this->db->resultSet();

    if (empty($result)) {
      $this->db->query("SELECT * FROM products WHERE is_active = 1 ORDER BY created_at DESC LIMIT :limit");
      $this->db->bind("limit", $limit);
      return $this->db->resultSet();
    }

    return $result;
  }

  public function getRecommendedProducts(int $limit = 10, ?int $user_id = null): array
  {
    if ($user_id !== null) {
      $this->db->query("SELECT p.category_id FROM order_items oi JOIN orders o ON oi.order_id = o.id JOIN products p ON oi.product_id = p.id WHERE o.user_id = :user_id GROUP BY p.category_id ORDER BY COUNT(p.category_id) DESC LIMIT 1");
      $this->db->bind("user_id", $user_id);
      $favCategory = $this->db->single();

      if ($favCategory) {
        $this->db->query("SELECT * FROM products WHERE category_id = :category_id AND is_active = 1 ORDER BY RAND() LIMIT :limit");
        $this->db->bind("category_id", $favCategory['category_id']);
        $this->db->bind("limit", $limit);

        $result = $this->db->resultSet();

        if (!empty($result)) {
          return $result;
        }
      }
    }
    $this->db->query("SELECT * FROM products WHERE is_active = 1 ORDER BY RAND() LIMIT :limit");
    $this->db->bind("limit", $limit);

    return $this->db->resultSet();
  }

  public function getProductById(int $product_id): array|false
  {
    $this->db->query("SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = :product_id AND p.is_active = 1");
    $this->db->bind("product_id", $product_id);

    return $this->db->single();
  }

  public function getProductBySlug(string $slug): array|false
  {
    $this->db->query("SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.slug = :slug AND p.is_active = 1");
    $this->db->bind("slug", $slug);

    return $this->db->single();
  }

  public function getProductStock(int $product_id): int
  {
    $this->db->query("SELECT SUM(stock_quantity) AS total_stock FROM product_stocks WHERE product_id = :product_id");
    $this->db->bind("product_id", $product_id);

    $result = $this->db->single();
    return (int) $result['total_stock'] ?? 0;
  }

  public function getProductSpecs(int $product_id): array
  {
    $this->db->query("SELECT * FROM product_specifications WHERE product_id = :product_id");
    $this->db->bind("product_id", $product_id);

    return $this->db->resultSet();
  }

  public function addProductSpecs(array $data): int
  {
    $this->db->query("INSERT INTO product_specifications (product_id, spec_name, spec_value) VALUES (:product_id, :spec_name, :spec_value)");
    $this->db->bind("product_id", $data['product_id']);
    $this->db->bind("spec_name", $data['spec_name']);
    $this->db->bind("spec_value", $data['spec_value']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function updateProductSpecs(array $data): int
  {
    $this->db->query("UPDATE product_specifications SET spec_name = :spec_name, spec_value = :spec_value WHERE id = :spec_id");
    $this->db->bind('spec_name', $data['spec_name']);
    $this->db->bind('spec_value', $data['spec_value']);
    $this->db->bind('spec_id', $data['id']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteProductSpecs(int $spec_id): int
  {
    $this->db->query("DELETE FROM product_specifications WHERE id = :spec_id");
    $this->db->bind("spec_id", $spec_id);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getProductReviews(int $product_id): array
  {
    $this->db->query("SELECT r.*, u.name as reviewer_name FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.product_id = :product_id ORDER BY r.created_at DESC");
    $this->db->bind("product_id", $product_id);

    return $this->db->resultSet();
  }

  public function getSimiliarProducts(int $category_id, int $current_product_id, int $limit = 5): array
  {
    $this->db->query("SELECT * FROM products WHERE category_id = :category_id AND id != :product_id AND is_active = 1 ORDER BY RAND() LIMIT :limit");
    $this->db->bind("category_id", $category_id);
    $this->db->bind("product_id", $current_product_id);
    $this->db->bind("limit", $limit);

    return $this->db->resultSet();
  }

  public function getAllProducts(): array
  {
    $this->db->query("SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.is_active = 1 ORDER BY p.created_at DESC");

    return $this->db->resultSet();
  }

  public function getProductsByCategorySlug(string $slug): array
  {
    $this->db->query("SELECT p.*, c.name AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE c.slug = :slug AND p.is_active = 1 ORDER BY p.created_at DESC");
    $this->db->bind("slug", $slug);

    return $this->db->resultSet();
  }

  public function getAllCategoriesAdmin(): array
  {
    $this->db->query("SELECT * FROM categories ORDER BY name ASC");

    return $this->db->resultSet();
  }

  public function getAllProductsForAdmin(): array
  {
    $this->db->query("SELECT p.*, c.name AS category_name, COALESCE(SUM(ps.stock_quantity), 0) AS total_stock FROM products p LEFT JOIN categories c ON p.category_id = c.id LEFT JOIN product_stocks ps ON p.id = ps.product_id GROUP BY p.id ORDER BY p.created_at DESC");

    return $this->db->resultSet();
  }

  public function addProduct(array $data, ?string $image_url = null): int
  {
    $this->db->query("INSERT INTO products (category_id, name, slug, description, price, discount_price, weight_grams, image_url, is_active) VALUES (:category_id, :name, :slug, :description, :price, :discount_price, :weight_grams, :image_url, :is_active)");

    $this->db->bind('category_id', $data['category_id']);
    $this->db->bind('name', $data['name']);
    $this->db->bind('slug', $data['slug']);
    $this->db->bind('description', $data['description']);
    $this->db->bind('price', $data['price']);
    $this->db->bind('discount_price', !empty($data['discount_price']) ? $data['discount_price'] : null);
    $this->db->bind('weight_grams', $data['weight_grams']);
    $this->db->bind('image_url', $image_url);
    $this->db->bind('is_active', $data['is_active']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function updateProduct(array $data, ?string $image_url = null): int
  {
    $imageQuery = $image_url ? ", image_url = :image_url" : "";

    $this->db->query("UPDATE products SET category_id = :category_id, name = :name, slug = :slug, description = :description, price= :price, discount_price = :discount_price, weight_grams = :weight_grams, is_active = :is_active $imageQuery WHERE id = :id");

    $this->db->bind('category_id', $data['category_id']);
    $this->db->bind('name', $data['name']);
    $this->db->bind('slug', $data['slug']);
    $this->db->bind('description', $data['description']);
    $this->db->bind('price', $data['price']);
    $this->db->bind('discount_price', !empty($data['discount_price']) ? $data['discount_price'] : null);
    $this->db->bind('weight_grams', $data['weight_grams']);
    $this->db->bind('is_active', $data['is_active']);
    $this->db->bind('id', $data['id']);

    if ($image_url) {
      $this->db->bind('image_url', $image_url);
    }

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteProduct(int $product_id): int
  {
    $this->db->query("DELETE FROM products WHERE id = :id");
    $this->db->bind('id', $product_id);

    $this->db->execute();

    return $this->db->rowCount();
  }
}
