<?php

declare(strict_types=1);
class OrderController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: ' . BASEURL . '/auth');
      exit;
    }
  }

  public function index(): void
  {
    $user_id = $_SESSION['user_id'];

    $data['judul'] = 'Orders | TI MART';

    $data['orders'] = $this->model('OrderModel')->getOrdersByUserId($user_id);

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/order_history', $data);
    $this->view('templates/footer', $data);
  }

  public function create(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user_id = $_SESSION['user_id'];

      $recipient_name = htmlspecialchars(trim($_POST['recipient_name'] ?? ''));
      $recipient_phone = htmlspecialchars(trim($_POST['phone_number'] ?? ''));
      $shipping_address = htmlspecialchars(trim($_POST['shipping_address'] ?? ''));
      $shipping_cost = (float) ($_POST['shipping_method'] ?? 0);
      $shipping_method_name = ($shipping_cost == 150000) ? 'Heavy Cargo' : 'Standard Drop';
      $payment_method = htmlspecialchars(trim($_POST['payment_method'] ?? 'Transfer BCA'));

      if (empty($recipient_name) || empty($recipient_phone) || empty($shipping_address)) {
        $_SESSION['flash_error'] = 'Harap isi data pengiriman dengan lengkap!';
        header('Location: ' . BASEURL . '/checkout');
        exit;
      }

      $cartModel = $this->model('CartModel');
      $cart_items = $cartModel->getCartByUserId($user_id);

      if (empty($cart_items)) {
        $_SESSION['flash_error'] = 'Keranjang belanja kosong!';
        header('Location: ' . BASEURL . '/cart');
        exit;
      }

      $total = $cartModel->getCartTotal($user_id);
      $total_price = $total['total_harga'];
      $discount_applied = $total['harga_diskon'];
      $subtotal_bayar = $total['total_bayar'];
      $grand_total = $subtotal_bayar + $shipping_cost;

      $invoice_number = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

      $orderData = [
        'invoice_number' => $invoice_number,
        'user_id' => $user_id,
        'fulfilled_by_location_id' => 1,
        'total_price' => $total_price,
        'shipping_cost' => $shipping_cost,
        'shipping_method' => $shipping_method_name,
        'payment_method' => $payment_method,
        'discount_applied' => $discount_applied,
        'grand_total' => $grand_total,
        'recipient_name' => $recipient_name,
        'recipient_phone' => $recipient_phone,
        'shipping_address' => $shipping_address
      ];

      $orderModel = $this->model('OrderModel');
      $order_id = $orderModel->processNewOrder($orderData, $cart_items);

      if ($order_id) {
        $_SESSION['flash_success'] = 'Pemesanan berhasil!';
        header('Location: ' . BASEURL . '/order/success/' . $order_id);
        exit;
      } else {
        $_SESSION['flash_error'] = 'Pemesanan gagal!';
        header('Location: ' . BASEURL . '/checkout');
        exit;
      }
    }
  }

  public function success(?string $order_id = null): void
  {
    if (!$order_id) {
      header('Location: ' . BASEURL . '/checkout');
      exit;
    }

    $data['judul'] = 'Pesanan Berhasil | TI MART';
    $data['order'] = $this->model('OrderModel')->getOrderById((int) $order_id);

    if (!$data['order'] || $data['order']['user_id'] !== $_SESSION['user_id']) {
      header('Location: ' . BASEURL . '/home');
      exit;
    }

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/order_success', $data);
    $this->view('templates/footer', $data);
  }

  public function upload(?string $order_id = null): void
  {
    $user_id = $_SESSION['user_id'];

    if (!$order_id) {
      $_SESSION['flash_error'] = 'ID pesanan tidak ditemukan di URL.';
      header('Location: ' . BASEURL . '/order');
      exit;
    }

    $data['judul'] = 'Upload Bukti | TI MART';
    $data['order'] = $this->model('OrderModel')->getOrderById((int) $order_id);

    if (!$data['order']) {
      $_SESSION['flash_error'] = 'Pesanan tidak ditemukan.';
      header('Location: ' . BASEURL . '/order');
      exit;
    }

    if ($data['order']['user_id'] != $user_id) {
      $_SESSION['flash_error'] = 'Ini bukan pesanan anda.';
      header('Location: ' . BASEURL . '/order');
      exit;
    }

    if ($data['order']['payment_status'] != 'pending') {
      $_SESSION['flash_error'] = 'Pesanan ini sudah tidak membutuhkan bukti pembayaran.';
      header('Location: ' . BASEURL . '/order');
      exit;
    }

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/upload_bukti', $data);
    $this->view('templates/footer', $data);
  }

  public function processUpload(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $order_id = (int) ($_POST['order_id'] ?? 0);
      $file = $_FILES['payment_proof'] ?? null;

      if (!$order_id || !$file || $file['error'] !== UPLOAD_ERR_OK) {
        $_SESSION['flash_error'] = 'Gagal mengunggah file. Pastikan anda memilih gambar.';
        header('Location: ' . BASEURL . '/order/upload/' . $order_id);
        exit;
      }

      $allowed_ext = ['jpg', 'jpeg', 'png'];
      $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

      if (!in_array($file_ext, $allowed_ext)) {
        $_SESSION['flash_error'] = 'Format file tidak diizinkan. Hanya JPG, JPEG, dan PNG diperbolehkan.';
        header('Location: ' . BASEURL . '/order/upload/' . $order_id);
        exit;
      }

      if ($file['size'] > 5242880) {
        $_SESSION['flash_error'] = 'Ukuran file terlalu besar. Maksimal 5MB.';
        header('Location: ' . BASEURL . '/order/upload/' . $order_id);
        exit;
      }

      $new_file_name = 'proof_' . $order_id . '_' . time() . '.' . $file_ext;
      $target_dir = $_SERVER['DOCUMENT_ROOT'] . '/website-ecommerce-bintang/public/img/proofs/';

      if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
      }

      $target_file = $target_dir . $new_file_name;

      if (move_uploaded_file($file['tmp_name'], $target_file)) {
        $this->model('OrderModel')->updatePaymentProof($order_id, $new_file_name);

        $_SESSION['flash_success'] = 'BUKTI BERHASIL DIKIRIM! MENUNGGU VERIFIKASI ADMIN.';
        header('Location: ' . BASEURL . '/order');
        exit;
      } else {
        $_SESSION['flash_error'] = 'Sistem gagal menyimpan file gambar.';
        header('Location: ' . BASEURL . '/order');
        exit;
      }
    }
  }
}
