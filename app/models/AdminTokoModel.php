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
}
