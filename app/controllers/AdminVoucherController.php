<?php

declare(strict_types=1);
class AdminVoucherController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }

    if ($_SESSION['role'] !== 'admin_web') {
      $this->sendResponse('error', 'Anda tidak memiliki akses ke halaman ini!', '', 403);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Voucher Management | TI MART';
    $data['vouchers'] = $this->model('VoucherModel')->getAllVouchers();

    $totalVouchers = count($data['vouchers']);
    $activeVouchers = 0;
    $expiredVouchers = 0;
    $today = date('Y-m-d');

    foreach ($data['vouchers'] as &$v) {
      if ($v['is_active'] == 1 && $v['valid_until'] >= $today) {
        $v['calculated_status'] = 'ACTIVE';
        $activeVouchers++;
      } else if ($v['is_active'] == 0 && $v['valid_until'] >= $today) {
        $v['calculated_status'] = 'PENDING';
      } else {
        $v['calculated_status'] = 'EXPIRED';
        $expiredVouchers++;
      }
    }

    $data['stats'] = [
      'total_vouchers' => $totalVouchers,
      'active_vouchers' => $activeVouchers,
      'expired_vouchers' => $expiredVouchers
    ];

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('admin_web/vouchers', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function store(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (empty($_POST['code']) || empty($_POST['discount_amount'])) {
        $this->sendResponse('error', 'Kode voucher dan jumlah diskon tidak boleh kosong.', '/adminvoucher', 400);
      }

      $existingVoucher = $this->model('VoucherModel')->getVoucherByCode($_POST['code']);
      if ($existingVoucher) {
        $this->sendResponse('error', 'Kode voucher sudah digunakan! Gunakan kode lain.', '/adminvoucher', 400);
      }

      try {
        if ($this->model('VoucherModel')->addVoucher($_POST) > 0) {
          $this->sendResponse('success', 'Voucher berhasil ditambahkan!', 'adminvoucher', 200);
        } else {
          $this->sendResponse('error', 'Gagal menambahkan voucher!', '/adminvoucher', 500);
        }
      } catch (PDOException $e) {
        $this->sendResponse('error', 'Database error: ' . $e->getMessage(), '/adminvoucher', 500);
      }
    }
  }

  public function update(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $voucher_id = (int) ($_POST['id'] ?? 0);
      if ($voucher_id <= 0 || empty($_POST['code'])) {
        $this->sendResponse('error', 'Data voucher tidak valid.', '/adminvoucher', 400);
      }

      try {
        if ($this->model('VoucherModel')->updateVoucher($_POST, $voucher_id) >= 0) {
          $this->sendResponse('success', 'Voucher berhasil diperbarui!', 'adminvoucher', 200);
        } else {
          $this->sendResponse('error', 'Gagal memperbarui voucher!', '/adminvoucher', 500);
        }
      } catch (PDOException $e) {
        $this->sendResponse('error', 'Database error: ' . $e->getMessage(), '/adminvoucher', 500);
      }
    }
  }

  public function delete(string $voucher_id): void
  {
    $voucherId = (int) $voucher_id;

    try {
      if ($this->model('VoucherModel')->deleteVoucher($voucherId) > 0) {
        $this->sendResponse('success', 'Voucher berhasil dihapus!', '/adminvoucher', 200);
      } else {
        $this->sendResponse('error', 'Gagal menghapus voucher!', '/adminvoucher', 500);
      }
    } catch (PDOException $e) {
      $this->sendResponse('error', 'Database error: ' . $e->getMessage(), '/adminvoucher', 500);
    }
  }
}
