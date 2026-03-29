<?php

declare(strict_types=1);
class OutboundController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }

    if (!in_array($_SESSION['role'], ['gudang', 'admin_web'])) {
      $this->sendResponse('error', 'Anda tidak memiliki akses ke halaman ini!', '', 403);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Outbound | TI MART';
    $data['orders'] = $this->model('OrderModel')->getOrdersForOutbound();

    $data['products'] = $this->model('ProdukModel')->getAllProducts();
    $data['locations'] = $this->model('UserModel')->getAllLocations();

    $totalReady = count($data['orders']);
    $totalParcels = 0;

    foreach ($data['orders'] as $order) {
      $totalParcels++;
    }

    $data['stats'] = [
      'ready_to_ship' => $totalReady,
      'total_parcels' => $totalParcels
    ];

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('gudang/outbound', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function dispatch(string $order_id): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $orderId = (int) $order_id;

      $update_status = $this->model('OrderModel')->updateOrderStatus($orderId, 'shipped');

      if ($update_status >= 0) {
        $this->sendResponse('success', 'Status pesanan berhasil diperbarui!', '/outbound', 200);
      } else {
        $this->sendResponse('error', 'Terjadi kesalahan saat memperbarui status pesanan!', '/outbound', 500);
      }
    }
  }
}
