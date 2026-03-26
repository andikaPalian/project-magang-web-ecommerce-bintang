<?php

declare(strict_types=1);
class GudangController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }

    if ($_SESSION['role'] !== 'gudang') {
      $this->sendResponse('error', 'Anda tidak memiliki akses ke halaman ini!', '', 403);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Gudang | TI MART';
    $data['packing_due'] = $this->model('OrderModel')->countOrdersByStatus('processing');
    $data['ready_pickup'] = $this->model('OrderModel')->countOrdersByStatus('ready_for_pickup');
    $data['low_stock'] = $this->model('ProdukModel')->countLowStockProducts(5);
    $data['recent_activities'] = $this->model('OrderModel')->getRecentOrderActivities(8);

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('gudang/index', $data);
    $this->view('templates/footer_admin', $data);
  }
}
