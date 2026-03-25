<?php

declare(strict_types=1);
class AdminOrderController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }

    if (!in_array($_SESSION['role'], ['admin_web', 'pemilik'])) {
      $this->sendResponse('error', 'Anda tidak memiliki akses ke halaman ini!', '', 403);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Order Management | TI MART';
    $data['orders'] = $this->model('OrderModel')->getAllOrders();

    $total_orders = count($data['orders']);
    $pending_fullfillment = 0;
    $shipped_total = 0;
    $total_revenue = 0;

    foreach ($data['orders'] as $order) {
      if (in_array($order['order_status'], ['pending', 'processing'])) {
        $pending_fullfillment++;
      } else if (in_array($order['order_status'], ['shipped', 'delivered'])) {
        $shipped_total++;
      }

      if ($order['payment_status'] === 'paid') {
        $total_revenue += (float) $order['grand_total'];
      }
    }

    $data['stats'] = [
      'total_orders' => $total_orders,
      'pending_fulfillment' => $pending_fullfillment,
      'shipped_total' => $shipped_total,
      'total_revenue' => $total_revenue
    ];

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('admin_web/orders', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function verifyPayment(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $order_id = (int) ($_POST['order_id'] ?? 0);
      $action = $_POST['action'];

      if ($order_id <= 0) {
        $this->sendResponse('error', 'Order ID tidak valid!', '/adminorder', 400);
      }

      if ($action === 'approve') {
        $this->model('OrderModel')->updatePaymentStatus($order_id, 'paid');
        $this->model('OrderModel')->updateOrderStatus($order_id, 'processing');
        $this->sendResponse('success', 'Pembayaran berhasil diverifikasi!', '/adminorder', 200);
      } else if ($action === 'reject') {
        $this->model('OrderModel')->updatePaymentStatus($order_id, 'failed');
        $this->sendResponse('success', 'Pembayaran ditolak!', '/adminorder', 200);
      } else {
        $this->sendResponse('error', 'Aksi tidak valid!', '/adminorder', 400);
      }
    }
  }

  public function updateOrderStatus(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $order_id = (int) ($_POST['order_id'] ?? 0);
      $new_status = $_POST['new_status'];

      if ($order_id <= 0) {
        $this->sendResponse('error', 'Order ID tidak valid!', '/adminorder', 400);
      }

      if ($this->model('OrderModel')->updateOrderStatus($order_id, $new_status) > 0) {
        $this->sendResponse('success', 'Status pesanan berhasil diperbarui!', '/adminorder', 200);
      } else {
        $this->sendResponse('error', 'Gagal memperbarui status pesanan!', '/adminorder', 500);
      }
    }
  }

  public function exportCSV(): void
  {
    $filename = "TIMART-ORDER-" . date('Ymd_His') . ".csv";

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');

    $output = fopen('php://output', 'w');

    fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

    $delimiter = ',';

    fputcsv($output, [
      'INVOICE NUMBER',
      'TANGGAL TRANSAKSI',
      'NAMA PELANGGAN',
      'TOTAL HARGA (IDR)',
      'STATUS PEMBAYARAN',
      'STATUS PENGIRIMAN',
      'METODE PEMBAYARAN',
      'METODE PENGIRIMAN'
    ], $delimiter);

    $orders = $this->model('OrderModel')->getAllOrders();

    if (!empty($orders)) {
      foreach ($orders as $o) {
        $invoiceExtracted = explode('-', $o['invoice_number'])[2] ?? $o['invoice_number'];
        $safeInvoice = "INV-" . $invoiceExtracted;

        $customerName = $o['customer_name'] ?? ($o['recipient_name'] ?? 'UNKNOWN');

        fputcsv($output, [
          $safeInvoice,
          date('Y-m-d H:i:s', strtotime($o['created_at'])),
          strtoupper((string)$customerName),
          (float) $o['grand_total'],
          strtoupper($o['payment_status'] ?? 'UNKNOWN'),
          strtoupper($o['order_status'] ?? 'UNKNOWN'),
          strtoupper($o['payment_method'] ?? 'UNKNOWN'),
          strtoupper($o['shipping_method'] ?? 'UNKNOWN')
        ], $delimiter);
      }
    }

    fclose($output);
    exit();
  }
}
