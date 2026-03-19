<?php

declare(strict_types=1);
class AdminWebController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }

    if ($_SESSION['role'] !== 'admin_web' && $_SESSION['role'] !== 'pemilik') {
      $this->sendResponse('error', 'Anda tidak memiliki akses ke halaman ini!', '', 403);
    }
  }

  public function dashboard(): void
  {
    $data['judul'] = 'Dashboard | TI MART';

    $dashboardModel = $this->model('DashboardModel');

    $data['total_produk']  = $dashboardModel->getCount('products');
    $data['total_user']    = $dashboardModel->getCount('users');
    $data['total_artikel'] = $dashboardModel->getCount('articles');
    $data['revenue_hari_ini'] = $dashboardModel->getTodayRevenue();

    $data['chart_data']    = $dashboardModel->getSalesLast7Days();
    $data['system_logs']   = $dashboardModel->getSystemLog();
    $data['recent_orders'] = $dashboardModel->getRecentOrders();

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('admin_web/index', $data);
    $this->view('templates/footer_admin', $data);
  }
}
