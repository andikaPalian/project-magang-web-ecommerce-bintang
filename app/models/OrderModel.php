<?php

declare(strict_types=1);
class OrderModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function processNewOrder(array $orderData, array $cart_items): int|bool
  {
    try {
      $this->db->beginTransaction();

      $this->db->query("INSERT INTO orders (invoice_number, user_id, fulfilled_by_location_id, total_price, shipping_cost, shipping_method, discount_applied, grand_total, payment_status, order_status, recipient_name, recipient_phone, shipping_address) VALUES (:invoice_number, :user_id, :location_id, :total_price, :shipping_cost, :shipping_method, :discount_applied, :grand_total, 'pending', 'pending', :recipient_name, :recipient_phone, :shipping_address)");
      $this->db->bind('invoice_number', $orderData['invoice_number']);
      $this->db->bind('user_id', $orderData['user_id']);
      $this->db->bind('location_id', $orderData['fulfilled_by_location_id']);
      $this->db->bind('total_price', $orderData['total_price']);
      $this->db->bind('shipping_cost', $orderData['shipping_cost']);
      $this->db->bind('shipping_method', $orderData['shipping_method']);
      $this->db->bind('discount_applied', $orderData['discount_applied']);
      $this->db->bind('grand_total', $orderData['grand_total']);
      $this->db->bind('recipient_name', $orderData['recipient_name']);
      $this->db->bind('recipient_phone', $orderData['recipient_phone']);
      $this->db->bind('shipping_address', $orderData['shipping_address']);
      $this->db->execute();

      $order_id = (int) $this->db->lastInsertId();

      foreach ($cart_items as $item) {
        $price_to_save = !empty($item['discount_price']) ? $item['discount_price'] : $item['price'];

        $this->db->query("INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) VALUES (:order_id, :product_id, :quantity, :price)");
        $this->db->bind("order_id", $order_id);
        $this->db->bind("product_id", $item['product_id']);
        $this->db->bind("quantity", $item['quantity']);
        $this->db->bind("price", $price_to_save);
        $this->db->execute();

        $this->db->query("UPDATE products_stocks SET stock_quantity = stock_quantity - :quantity WHERE product_id = :product_id AND location_id = :location_id AND stock_quantity >= :quantity");
        $this->db->bind("quantity", $item['quantity']);
        $this->db->bind("product_id", $item['product_id']);
        $this->db->bind("location_id", $orderData['fulfilled_by_location_id']);
        $this->db->execute();

        if ($this->db->rowCount() === 0) {
          throw new Exception("Stok penuh tidak mencukupi untuk item: " . $item['name']);
        }
      }

      $this->db->query("DELETE FROM carts WHERE user_id = :user_id");
      $this->db->bind("user_id", $orderData['user_id']);
      $this->db->execute();

      $this->db->commit();
      return $order_id;
    } catch (Exception $e) {
      $this->db->rollBack();
      return false;
    }
  }

  public function getOrderById(int $order_id): array|false
  {
    $this->db->query("SELECT * FROM orders WHERE id = :order_id");
    $this->db->bind("order_id", $order_id);

    return $this->db->single();
  }
}
