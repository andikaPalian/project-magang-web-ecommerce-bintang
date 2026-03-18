<?php

declare(strict_types=1);
class OrderController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth');
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Orders | TI MART';
    $data['orders'] = $this->model('OrderModel')->getOrdersByUserId($_SESSION['user_id']);

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
        $this->sendResponse('error', 'Harap isi data pengirim dengan lengkap!', '/checkout');
      }

      $cartModel = $this->model('CartModel');
      $cart_items = $cartModel->getCartByUserId($user_id);

      if (empty($cart_items)) {
        $this->sendResponse('error', 'Keranjang belanja kosong!', '/cart');
      }

      $total = $cartModel->getCartTotal($user_id);
      $invoice_number = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

      $orderData = [
        'invoice_number' => $invoice_number,
        'user_id' => $user_id,
        'fulfilled_by_location_id' => 1,
        'total_price' => $total['total_harga'],
        'shipping_cost' => $shipping_cost,
        'shipping_method' => $shipping_method_name,
        'payment_method' => $payment_method,
        'discount_applied' => $total['harga_diskon'],
        'grand_total' => $total['total_bayar'] + $shipping_cost,
        'recipient_name' => $recipient_name,
        'recipient_phone' => $recipient_phone,
        'shipping_address' => $shipping_address
      ];

      $orderModel = $this->model('OrderModel');
      $order_id = $orderModel->processNewOrder($orderData, $cart_items);

      if ($order_id) {
        $this->sendResponse('success', 'Pemesanan berhasil!', '/order/success/' . $order_id);
      } else {
        $this->sendResponse('error', 'Pemesanan gagal!', '/checkout');
      }
    }
  }

  public function success(?string $order_id = null): void
  {
    if (!$order_id) {
      $this->sendResponse('error', 'ID pesanan tidak valid!', '/checkout');
    }

    $data['judul'] = 'Pesanan Berhasil | TI MART';
    $data['order'] = $this->model('OrderModel')->getOrderById((int) $order_id);

    if (!$data['order'] || $data['order']['user_id'] !== $_SESSION['user_id']) {
      $this->sendResponse('error', 'Pesanan tidak ditemukan!', '/home');
    }

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/order_success', $data);
    $this->view('templates/footer', $data);
  }

  public function upload(?string $order_id = null): void
  {
    if (!$order_id) {
      $this->sendResponse('error', 'ID pesanan tidak valid!', '/order');
    }

    $data['judul'] = 'Upload Bukti | TI MART';
    $data['order'] = $this->model('OrderModel')->getOrderById((int) $order_id);

    if (!$data['order'] || $data['order']['user_id'] != $_SESSION['user_id']) {
      $this->sendResponse('error', 'Pesanan tidak ditemukan atau bukan pesanan Anda!', '/order');
    }

    if ($data['order']['payment_status'] != 'pending') {
      $this->sendResponse('error', 'Pesanan ini sudah tidak membutuhkan bukti pembayaran', '/order');
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

      if (!$order_id || empty($_FILES['payment_proof']) || $_FILES['payment_proof']['error'] !== UPLOAD_ERR_OK) {
        $this->sendResponse('error', 'Gagal mengunggah file. Pastikan anda memilih gambar.', '/order/upload/' . $order_id);
      }

      $uploadFileName = Helper::uploadImage($_FILES['payment_proof'], 'proofs');

      if (!$uploadFileName) {
        $this->sendResponse('error', 'Format file tidak valid atau ukuran melebihi batas 5MB', '/order/upload/' . $order_id);
      }

      $this->model('OrderModel')->updatePaymentProof($order_id, $uploadFileName);

      $this->sendResponse('success', 'Bukti pembayaran berhasil dikirim!. Silahkan menunggu konfirmasi dari admin', '/order');
    }
  }
}
