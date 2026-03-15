<?php

declare(strict_types=1);
class DashboardModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getCount(string $table): int
  {
    $this->db->query("SELECT COUNT(*) AS total FROM {$table}");

    $result = $this->db->single();

    return (int) ($result['total'] ?? 0);
  }

  public function getTodayRevenue(): int
  {
    $this->db->query("SELECT COUNT(*) AS total FROM orders WHERE DATE(created_at) = CURDATE()");

    $result = $this->db->single();

    return (int) ($result['total'] ?? 0);
  }

  public function getSalesLast7Days(): array
  {
    $chartData = [
      'labels' => [],
      'data' => []
    ];

    $tempData = [];
    for ($i = 6; $i >= 0; $i--) {
      $date = date('Y-m-d', strtotime("-$i days"));
      $tempData[$date] = 0;
    }

    $this->db->query("SELECT DATE(created_at) AS date, SUm(grand_total) AS total FROM orders WHERE created_at >= CURDATE() - INTERVAL 6 DAY GROUP BY DATE(created_at)");

    $result = $this->db->resultSet();

    foreach ($result as $row) {
      if (isset($tempData[$row['date']])) {
        $tempData[$row['date']] = (int) $row['total'];
      }
    }

    foreach ($tempData as $date => $total) {
      $chartData['labels'][] = strtoupper(date('D', strtotime($date)));
      $chartData['data'][] = $total;
    }

    return $chartData;
  }

  public function getSystemLog(): array
  {
    $this->db->query("SELECT title, message, created_at FROM notifications ORDER BY created_at DESC LIMIT 4");

    return $this->db->resultSet();
  }

  public function getRecentOrders(): array
  {
    $this->db->query("SELECT o.invoice_number, u.name AS user_name, o.order_status, o.created_at FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC LIMIT 5");

    return $this->db->resultSet();
  }
}
