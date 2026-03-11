<?php

declare(strict_types=1);
class WishlistModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getWishlistByUserId(int $user_id): array
  {
    $this->db->query("SELECT p.*, w.id as wishlist_id FROM wishlists w JOIN products p ON w.product_id = p.id WHERE w.user_id = :user_id ORDER BY w.created_at DESC");
    $this->db->bind('user_id', $user_id);

    $result = $this->db->resultSet();

    return $result ? $result : [];
  }

  public function getWishlistCount(int $user_id): int
  {
    $this->db->query("SELECT COUNT(*) AS total FROM wishlists WHERE user_id = :user_id");
    $this->db->bind("user_id", $user_id);

    $result = $this->db->single();

    return (int) ($result['total'] ?? 0);
  }

  public function toggleWishList(int $user_id, int $product_id): string|bool
  {
    try {
      $this->db->query("SELECT id FROM wishlists WHERE user_id = :user_id AND product_id = :product_id");
      $this->db->bind("user_id", $user_id);
      $this->db->bind("product_id", $product_id);

      $existing = $this->db->single();

      if ($existing) {
        $this->db->query("DELETE FROM wishlists WHERE user_id = :user_id AND product_id = :product_id");
        $this->db->bind("user_id", $user_id);
        $this->db->bind("product_id", $product_id);
        $this->db->execute();
        return 'removed';
      } else {
        $this->db->query("INSERT INTO wishlists (user_id, product_id) VALUES (:user_id, :product_id)");
        $this->db->bind("user_id", $user_id);
        $this->db->bind("product_id", $product_id);
        $this->db->execute();
        return 'added';
      }
    } catch (Exception $e) {
      return false;
    }
  }

  public function isProductInWishlist(int $user_id, int $product_id): bool
  {
    $this->db->query("SELECT id FROM wishlists WHERE user_id = :user_id AND product_id = :product_id");
    $this->db->bind("user_id", $user_id);
    $this->db->bind("product_id", $product_id);

    return $this->db->single() ? true : false;
  }
}
