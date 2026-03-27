<?php

declare(strict_types=1);
class EkspedisiController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }

    if (!in_array($_SESSION['role'], ['admin_web', 'ekspedisi'])) {
      $this->sendResponse('error', 'Anda tidak memiliki akses ke halaman ini!', '', 403);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Antrian Ekspedisi | TI MART';
    $data['pickups'] = $this->model('EkspedisiModel')->getAvailablePickups();

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('ekspedisi/pickup', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function take(string $order_id): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $orderid = (int) $order_id;
      $courierId = (int) $_SESSION['user_id'];

      if ($this->model('EkspedisiModel')->takePackage($orderid, $courierId) > 0) {
        $this->sendResponse('success', 'Paket berhasil diambil! Silahkan mulai perjalanan.', '/ekspedisi', 200);
      } else {
        $this->sendResponse('error', 'Gagal mengambil paket!', '/ekspedisi', 500);
      }
    }
  }

  public function markDelivered(string $order_id): void
  {
    if ($$_SERVER['REQUEST_METHOD'] === 'POST') {
      $orderId = (int) $order_id;

      if ($this->model('EkspedisiModel')->completeDelivery($orderId) > 0) {
        $this->sendResponse('success', 'Pengiriman berhasil diselesaikan!', '/ekspedisi', 200);
      } else {
        $this->sendResponse('error', 'Gagal menyelesaikan pengiriman!', '/ekspedisi', 500);
      }
    }
  }
}
