<?php

declare(strict_types=1);
class FulfillmentController extends Controller
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
    $data['judul'] = 'Pengemasan | TI MART';
    $data['orders'] = $this->model('OrderModel')->getOrdersForFulfillment();

    $totalOrders = count($data['orders']);
    $totalItemsToPick = 0;

    foreach ($data['orders'] as $order) {
      $totalItemsToPick += (int) $order['total_items'];
    }

    $data['stats'] = [
      'pending_invoices' => $totalOrders,
      'total_items_to_pick' => $totalItemsToPick
    ];

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('gudang/fulfillment', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function mark_packed(string $order_id): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $orderId = (int) $order_id;

      $update_status = $this->model('OrderModel')->updateOrderStatus($orderId, 'ready_for_pickup');

      if ($update_status >= 0) {
        $this->sendResponse('success', 'Status pesanan berhasil diperbarui!', '/fulfillment', 200);
      } else {
        $this->sendResponse('error', 'Terjadi kesalahan saat memperbarui status pesanan!', '/fulfillment', 500);
      }
    }
  }

  public function print_slip(string $order_id): void
  {
    $orderId = (int) $order_id;

    $data['order'] = $this->model('OrderModel')->getOrderById($orderId);
    $data['items'] = $this->model('OrderModel')->getOrderItemDetails($orderId);
    $data['judul'] = 'PACKING SLIP - ' . $data['order']['invoice_number'];

    if (!$data['order']) {
      $this->sendResponse('error', 'Pesanan tidak ditemukan!', '/fulfillment', 404);
    }

    $this->view('gudang/print_slip', $data);
  }
}
