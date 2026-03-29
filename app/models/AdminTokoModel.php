<?php

declare(strict_types=1);
class AdminTokoModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getDashboardStats(int $location_id): array
  {
    $this->db->query("SELECT COUNT(id) AS total_transactions, COALESCE(SUM(grand_total), 0) AS total_revenue FROM orders WHERE fulfilled_by_location_id = :location_id AND payment_status = 'paid' AND DAtE(created_at) = CURRENT_DATE()");
    $this->db->bind('location_id', $location_id);

    $result = $this->db->single();

    return $result ?: [
      'total_transactions' => 0,
      'total_revenue' => 0
    ];
  }

  public function getLowStockAlerts(int $location_id, int $treshold = 10): array
  {
    $this->db->query("SELECT p.name, ps.stock_quantity FROM product_stocks ps JOIN products p ON ps.product_id = p.id WHERE ps.location_id = :location_id AND ps.stock_quantity < :treshold ORDER BY ps.stock_quantity ASC");
    $this->db->bind('location_id', $location_id);
    $this->db->bind('treshold', $treshold);

    return $this->db->resultSet() ?: [];
  }

  public function getRecentSales(int $location_id, int $limit = 5): array
  {
    $this->db->query("SELECT o.invoice_number, o.grand_total, o.created_at, (SELECT p.name FROM order_items oi JOIN products p ON oi.product_id = p.id WHERE oi.order_id = o.id LIMIT 1) AS first_item_name FROM orders o WHERE o.fulfilled_by_location_id = :location_id AND o.payment_status = 'paid' ORDER BY o.created_at DESC LIMIT :limit");
    $this->db->bind('location_id', $location_id);
    $this->db->bind('limit', $limit);

    return $this->db->resultSet() ?: [];
  }

  public function getHourlyTraffic(int $location_id): array
  {
    $this->db->query("SELECT HOUR(created_at) AS jam_transaksi, COUNT(id) AS jumlah FROM orders WHERE fulfilled_by_location_id = :location_id AND payment_status = 'paid' AND DATE(created_at) = CURRENT_DATE() GROUP BY HOUR(created_at)");
    $this->db->bind('location_id', $location_id);

    return $this->db->resultSet() ?: [];
  }

  public function getPostProducts(int $location_id): array
  {
    $this->db->query("SELECT p.id, p.name, p.price, p.discount_price, p.image_url, ps.stock_quantity FROM products p JOIN product_stocks ps ON p.id = ps.product_id WHERE ps.location_id = :location_id AND ps.stock_quantity > 0 AND p.is_active = 1 ORDER BY p.name ASC");
    $this->db->bind('location_id', $location_id);

    return $this->db->resultSet() ?: [];
  }

  public function processPosCheckout(array $data, array $cartItems): bool
  {
    try {
      $this->db->beginTransaction();

      $invoice_number = 'INV-POS-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

      $this->db->query("INSERT INTO orders (invoice_number, user_id, fulfilled_by_location_id, total_price, shipping_cost, shipping_method, grand_total, payment_status, payment_method, order_status, recipient_name, recipient_phone, shipping_address) VALUES (:invoice, :user_id, :location_id, :total_price, 0, 'Offline POS', :grand_total, 'paid', :payment_method, 'delivered', 'Walk-In Guest', '-', 'Pembelian Fisik di Toko')");

      $this->db->bind(':invoice', $invoice_number);
      $this->db->bind(':user_id', $data['kasir_id']);
      $this->db->bind(':location_id', $data['location_id']);
      $this->db->bind(':total_price', $data['total_price']);
      $this->db->bind(':grand_total', $data['total_price']);
      $this->db->bind(':payment_method', $data['payment_method']);

      $this->db->execute();

      $order_id = $this->db->lastInsertId();

      foreach ($cartItems as $item) {
        $this->db->query("INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) VALUES (:order_id, :product_id, :quantity, :price)");
        $this->db->bind(':order_id', $order_id);
        $this->db->bind(':product_id', $item['product_id']);
        $this->db->bind(':quantity', $item['quantity']);
        $this->db->bind(':price', $item['price']);
        $this->db->execute();

        $this->db->query("UPDATE product_stocks SET stock_quantity = stock_quantity - :quantity WHERE product_id = :product_id AND location_id = :location_id");
        $this->db->bind(':quantity', $item['quantity']);
        $this->db->bind(':product_id', $item['product_id']);
        $this->db->bind(':location_id', $data['location_id']);
        $this->db->execute();
      }

      $this->db->commit();

      return true;
    } catch (Exception $e) {
      $this->db->rollBack();

      return false;
    }
  }
}
