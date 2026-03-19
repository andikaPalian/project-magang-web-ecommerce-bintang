<?php

declare(strict_types=1);
class CategoryModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllCategories(): array
  {
    $this->db->query("SELECT c.*, COUNT(p.id) AS product_count FROM categories c LEFT JOIN products p ON c.id = p.category_id GROUP BY c.id ORDER BY c.name ASC");

    return $this->db->resultSet();
  }

  public function getCategoryById(int $category_id): array|false
  {
    $this->db->query("SELECT * FROM categories WHERE id = :category_id");
    $this->db->bind('category_id', $category_id);

    return $this->db->single();
  }

  public function addCategory(array $data, ?string $icon = null): int
  {
    $this->db->query("INSERT INTO categories (name, slug, icon) VALUES (:name, :slug, :icon)");
    $this->db->bind('name', $data['name']);
    $this->db->bind('slug', $data['slug']);
    $this->db->bind('icon', $icon);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function updateCategory(array $data, ?string $icon = null): int
  {
    $iconQuery = $icon ? ', icon = :icon' : '';

    $this->db->query("UPDATE categories SET name = :name, slug = :slug $iconQuery WHERE id = :id");

    $this->db->bind('name', $data['name']);
    $this->db->bind('slug', $data['slug']);
    $this->db->bind('id', $data['id']);

    if ($icon) {
      $this->db->bind('icon', $icon);
    }

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function countProductsInCategory(int $category_id): int
  {
    $this->db->query("SELECT COUNT(*) AS total FROM products WHERE category_id = :category_id");
    $this->db->bind("category_id", $category_id);

    $result = $this->db->single();

    return (int) ($result['total'] ?? 0);
  }

  public function deleteCategory(int $category_id): int
  {
    $this->db->query("DELETE FROM categories WHERE id = :category_id");
    $this->db->bind('category_id', $category_id);

    $this->db->execute();

    return $this->db->rowCount();
  }
}
