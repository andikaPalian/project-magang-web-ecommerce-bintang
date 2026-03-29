<?php

declare(strict_types=1);
class AdminTokoController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu.', '/auth', 401);
    }

    if ($_SESSION['role'] !== 'admin_toko') {
      $this->sendResponse('error', 'Anda tidak memiliki akses ke halaman ini.', '', 403);
    }

    if (!isset($_SESSION['location_id']) || empty($_SESSION['location_id'])) {
      $this->sendResponse('error', 'Anda belum didaftarkan pada lokasi cabang toko manapun. Silakan hubungi administrator untuk mendapatkan akses.', '', 403);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Dashboard Cabang | TI MART';

    $location_id = (int) $_SESSION['location_id'];

    $data['stats'] = $this->model('AdminTokoModel')->getDashboardStats($location_id);
    $data['low_stock'] = $this->model('AdminTokoModel')->getLowStockAlerts($location_id);
    $data['recent_sales'] = $this->model('AdminTokoModel')->getRecentSales($location_id);

    $rawTraffic = $this->model('AdminTokoModel')->getHourlyTraffic($location_id);
    $trafficData = [0, 0, 0, 0, 0, 0, 0];

    foreach ($rawTraffic as $row) {
      $jam = (int) $row['jam_transaksi'];
      $jumlah = (int) $row['jumlah'];

      if ($jam >= 0) {
        $index = (int) floor(($jam - 8) / 2);

        if ($index > 6) {
          $index = 6;
        }

        $trafficData[$index] += $jumlah;
      }
    }

    $data['traffic'] = $trafficData;

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('admin_toko/index', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function pos(): void
  {
    $data['judul'] = 'POS | TI MART';
    $location_id = (int) $_SESSION['location_id'];

    $data['products'] = $this->model('AdminTokoModel')->getPostProducts($location_id);

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('admin_toko/pos', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function processCheckout(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $json = file_get_contents('php://input');
      $requestData = json_decode($json, true);

      if (!$requestData || empty($requestData['cart'])) {
        $this->sendResponse('error', 'Data keranjang tidak valid', '', 400);
      }

      $checkoutData = [
        'kasir_id' => $_SESSION['user_id'],
        'location_id' => $_SESSION['location_id'],
        'total_price' => $requestData['total_payable'],
        'payment_method' => $requestData['payment_method']
      ];
      $cartItems = $requestData['cart'];

      $isSuccess = $this->model('AdminTokoModel')->processPosCheckout($checkoutData, $cartItems);
      if ($isSuccess) {
        $this->sendResponse('success', 'Transaksi berhasil diproses.', '', 200);
      } else {
        $this->sendResponse('error', 'Transaksi gagal diproses.', '', 500);
      }
    }
  }
}
