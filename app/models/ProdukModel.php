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
}
