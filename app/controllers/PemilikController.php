<?php

declare(strict_types=1);
class PemilikController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu.', '/login', 401);
    }

    if (!in_array($_SESSION['role'], ['admin_web', 'pemilik'])) {
      $this->sendResponse('error', 'Anda tidak memiliki akses ke halaman ini.', '', 403);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Dashboard Pemilik | TI MART';
    $data['total_revenue'] = $this->model('PemilikModel')->getTotalRevenue();
    $data['revenue_growth'] = $this->model('PemilikModel')->getRevenueGrowth();
    $data['successful_sales'] = $this->model('PemilikModel')->getSuccessfulSales();
    $data['completion_rate'] = $this->model('PemilikModel')->getCompletionRate();
    $data['active_customers'] = $this->model('PemilikModel')->getActiveCustomers();
    $data['top_products'] = $this->model('PemilikModel')->getTopProducts();
    $data['revenue_trend'] = $this->model('PemilikModel')->getRevenueTrend30Days();
    $data['shipping_dist'] = $this->model('PemilikModel')->getShippingDistribution();

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('pemilik/index', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function finance(): void
  {
    $data['judul'] = 'Financial Reports | TI MART';
    $data['transactions'] = $this->model('PemilikModel')->getFinancialLogs();

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('pemilik/finance', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function radar(): void
  {
    $data['judul'] = 'Operational Radar | TI MART';

    $rawStats = $this->model('PemilikModel')->getRadarStats();

    $stats = [
      'pending' => 0,
      'processing' => 0,
      'on_delivery' => 0
    ];
    foreach ($rawStats as $row) {
      if ($row['order_status'] === 'pending') {
        $stats['pending'] += $row['total'];
      }
      if (in_array($row['order_status'], ['processing', 'ready_for_pickup'])) {
        $stats['processing'] += $row['total'];
      }
      if (in_array($row['order_status'], ['shipped', 'on_delivery'])) {
        $stats['on_delivery'] += $row['total'];
      }
    }

    $data['radar_stats'] = $stats;
    $data['fleets'] = $this->model('PemilikModel')->getFleetProductivity();

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('pemilik/radar', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function master_data(): void
  {
    $data['judul'] = 'Master Data | TI MART';
    $data['stocks'] = $this->model('PemilikModel')->getStockLevels();
    $data['accounts'] = $this->model('PemilikModel')->getAccountRegistry();

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('pemilik/master_data', $data);
    $this->view('templates/footer_admin', $data);
  }
}
