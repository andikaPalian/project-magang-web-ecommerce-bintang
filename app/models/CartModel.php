<?php

declare(strict_types=1);
class CartModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getCartByUserId(int $user_id): array
  {
    $this->db->query("SELECT c.id as cart_id, c.quantity, p.id as product_id, p.name, p.slug, p.price, p.discount_price, p.image_url, p.weight_grams FROM carts c JOIN products p ON c.product_id = p.id WHERE c.user_id = :user_id ORDER BY c.created_at DESC");
    $this->db->bind("user_id", $user_id);

    return $this->db->resultSet();
  }

  public function addToCart(int $user_id, int $product_id, int $quantity = 1): int
  {
    $this->db->query("INSERT INTO carts (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity) ON DUPLICATE KEY UPDATE quantity = quantity + VALUES(quantity)");
    $this->db->bind("user_id", $user_id);
    $this->db->bind("product_id", $product_id);
    $this->db->bind("quantity", $quantity);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function updateQuantity(int $cart_id, int $user_id, int $quantity): int
  {
    $this->db->query("UPDATE carts SET quantity = :quantity WHERE id = :cart_id AND user_id = :user_id");
    $this->db->bind("cart_id", $cart_id);
    $this->db->bind("user_id", $user_id);
    $this->db->bind("quantity", $quantity);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function removeFromCart(int $cart_id, int $user_id): int
  {
    $this->db->query("DELETE FROM carts WHERE id = :cart_id AND user_id = :user_id");
    $this->db->bind("cart_id", $cart_id);
    $this->db->bind("user_id", $user_id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function countCartItems(int $user_id): int
  {
    $this->db->query("SELECT COUNT(id) AS total_items FROM carts WHERE user_id = :user_id");
    $this->db->bind("user_id", $user_id);

    $result = $this->db->single();

    return (int) ($result['total_items'] ?? 0);
  }

  public function cleanCart(int $user_id): int
  {
    $this->db->query("DELETE FROM carts WHERE user_id = :user_id");
    $this->db->bind("user_id", $user_id);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getCartTotal(int $user_id): array
  {
    $cart_item = $this->getCartByUserId($user_id);

    $total_harga = 0;
    $total_diskon = 0;

    foreach ($cart_item as $item) {
      $harga_asli = (float) $item['price'];
      $harga_final = !empty($item['discount_price']) ? (float) $item['discount_price'] : $harga_asli;
      $quantity = (int) $item['quantity'];

      $total_harga += ($harga_asli * $quantity);
      $total_diskon += (($harga_asli - $harga_final) * $quantity);
    }

    return [
      'total_harga' => $total_harga,
      'total_diskon' => $total_diskon,
      'total_bayar' => $total_harga - $total_diskon
    ];
  }

  public function getCartTotalItem(int $user_id): int
  {
    $this->db->query("SELECT SUM(quantity) AS total_items FROM carts WHERE user_id = :user_id");
    $this->db->bind("user_id", $user_id);

    $result = $this->db->single();

    return (int) ($result['total_items'] ?? 0);
  }
}
