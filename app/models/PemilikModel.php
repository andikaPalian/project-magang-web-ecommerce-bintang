<?php

declare(strict_types=1);
class PemilikModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getTotalRevenue(): float
  {
    $this->db->query("SELECT SUM(grand_total) AS total FROM orders WHERE payment_status = 'paid' OR order_status = 'delivered'");

    $result = $this->db->single();

    return (float) ($result['total'] ?? 0);
  }

  public function getRevenueGrowth(): array
  {
    $this->db->query("SELECT SUM(grand_total) AS total FROM orders WHERE (payment_status = 'paid' OR order_status = 'delivered') AND MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())");
    $currentMonth = (float) ($this->db->single()['total'] ?? 0);

    $this->db->query("SELECT SUM(grand_total) as total FROM orders WHERE (payment_status = 'paid' OR order_status = 'delivered') AND MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)");
    $lastMonth = (float) ($this->db->single()['total'] ?? 0);

    $growth = 0;
    if ($lastMonth > 0) {
      $growth = (($currentMonth - $lastMonth) / $lastMonth) * 100;
    } else {
      $growth = $currentMonth > 0 ? 100 : 0;
    }

    return [
      'growth' => round($growth, 1),
      'is_positive' => $growth >= 0
    ];
  }

  public function getSuccessfulSales(): int
  {
    $this->db->query("SELECT COUNT(id) AS total FROM orders WHERE order_status IN ('shipped', 'delivered')");

    $result = $this->db->single();

    return (int) ($result['total'] ?? 0);
  }

  public function getCompletionRate(): float
  {
    $this->db->query("SELECT COUNT(id) AS total FROM orders");
    $totalOrders = (int) ($this->db->single()['total'] ?? 0);

    if ($totalOrders === 0) return 0.0;

    $this->db->query("SELECT COUNT(id) AS total FROM orders WHERE order_status IN ('shipped', 'delivered')");
    $completedOrders = (int) ($this->db->single()['total'] ?? 0);

    return round(($completedOrders / $totalOrders) * 100, 1);
  }

  public function getActiveCustomers(): int
  {
    $this->db->query("SELECT COUNT(id) AS total FROM users WHERE role = 'pembeli'");

    $result = $this->db->single();

    return (int) ($result['total'] ?? 0);
  }

  public function getTopProducts(): array
  {
    $this->db->query("SELECT p.slug, p.name, SUM(oi.quantity) AS total_sold, SUM(oi.quantity * oi.price_at_purchase) AS revenue_gen, p.is_active FROM order_items oi JOIN orders o ON oi.order_id = o.id JOIN products p ON oi.product_id = p.id WHERE o.payment_status = 'paid' OR o.order_status = 'delivered' GROUP BY p.id ORDER BY total_sold DESC LIMIT 5");

    return $this->db->resultSet();
  }

  public function getRevenueTrend30Days(): array
  {
    $this->db->query("SELECT DATE(created_at) AS order_date, SUM(grand_total) AS daily_revenue FROM orders WHERE (payment_status = 'paid' OR order_status = 'delivered') AND created_at >= DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY) GROUP BY DATE(created_at) ORDER BY DATE(created_at)");
    $results = $this->db->resultSet();

    $labels = [];
    $data = [];
    foreach ($results as $row) {
      $labels[] = date('d M', strtotime($row['order_date']));
      $data[] = (float)$row['daily_revenue'];
    }
    return ['labels' => $labels, 'data' => $data];
  }

  public function getShippingDistribution(): array
  {
    $this->db->query("SELECT shipping_method, COUNT(id) AS total FROM orders WHERE shipping_method != '' AND shipping_method IS NOT NULL GROUP BY shipping_method");
    $results = $this->db->resultSet();

    $labels = [];
    $data = [];
    $total = 0;
    foreach ($results as $row) {
      $labels[] = strtoupper($row['shipping_method']);
      $data[] = (int)$row['total'];
      $total += (int)$row['total'];
    }

    return [
      'labels' => $labels,
      'data' => $data,
      'total' => $total,
      'raw' => $results
    ];
  }

  private function buildFinanceFilterQuery(array $filters): string
  {
    $filterQuery = "";
    if (!empty($filters['date_range'])) {
      if ($filters['date_range'] === 'LAST_30_DAYS') {
        $filterQuery .= " AND DATE(o.created_at) >= DATE_SUB(CURRENT_DATE(), INTERVAL 30 DAY)";
      } elseif ($filters['date_range'] === 'THIS_YEAR') {
        $filterQuery .= " AND YEAR(o.created_at) = YEAR(CURRENT_DATE())";
      }
    }
    if (isset($filters['payment_status']) && is_array($filters['payment_status'])) {
      $status_map = ['completed' => "'paid'", 'pending' => "'pending'"];
      $selected = [];
      foreach ($filters['payment_status'] as $status) {
        if (isset($status_map[$status])) $selected[] = $status_map[$status];
      }
      if (!empty($selected)) {
        $filterQuery .= " AND o.payment_status IN (" . implode(',', $selected) . ")";
      } else {
        $filterQuery .= " AND 1=0";
      }
    } else {
      $filterQuery .= " AND 1=0";
    }
    return $filterQuery;
  }

  public function getFinancialLogs(array $filters = [], int $limit = 0, int $offset = 0): array
  {
    $query = "SELECT o.invoice_number, o.created_at, u.name AS customer_name, o.grand_total, o.payment_status, o.order_status FROM orders o JOIN users u ON o.user_id = u.id WHERE 1=1";

    $query .= $this->buildFinanceFilterQuery($filters);
    $query .= " ORDER BY o.created_at DESC";

    if ($limit > 0) {
      $query .= " LIMIT :limit OFFSET :offset";
    }

    $this->db->query($query);

    if ($limit > 0) {
      $this->db->bind(':limit', $limit);
      $this->db->bind(':offset', $offset);
    }

    return $this->db->resultSet();
  }

  public function getFinancialTotals(array $filters = []): array
  {
    $query = "SELECT COUNT(o.id) AS total_transactions, SUM(o.grand_total) AS total_revenue, SUM(CASE WHEN o.order_status = 'delivered' THEN 1 ELSE 0 END) AS completed_delivered FROM orders o JOIN users u ON o.user_id = u.id WHERE 1=1";
    $query .= $this->buildFinanceFilterQuery($filters);
    $this->db->query($query);
    return $this->db->single();
  }

  public function getRadarStats(): array
  {
    $this->db->query("SELECT order_status, COUNT(id) AS total FROM orders GROUP BY order_status");
    return $this->db->resultSet();
  }

  public function getFleetProductivity(): array
  {
    $this->db->query("SELECT u.id, u.name, COUNT(d.id) AS total_completed FROM users u LEFT JOIN deliveries d ON u.id = d.courier_id AND d.delivery_status = 'completed' WHERE u.role = 'ekspedisi' GROUP BY u.id");

    return $this->db->resultSet();
  }

  public function getStockLevels(): array
  {
    $this->db->query("SELECT p.slug, p.name AS product_name, l.name AS location_name, ps.stock_quantity FROM product_stocks ps JOIN products p ON ps.product_id = p.id JOIN locations l ON ps.location_id = l.id ORDER BY ps.stock_quantity ASC");

    return $this->db->resultSet();
  }

  public function getAccountRegistry(): array
  {
    $this->db->query("SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC");

    return $this->db->resultSet();
  }
}
