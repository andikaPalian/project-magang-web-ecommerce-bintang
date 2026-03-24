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
      $recipient_name = htmlspecialchars(trim($_POST['recipient_name'] ?? ''));
      $recipient_phone = htmlspecialchars(trim($_POST['phone_number'] ?? ''));
      $shipping_address = htmlspecialchars(trim($_POST['shipping_address'] ?? ''));
      $shipping_cost = (float) ($_POST['shipping_cost'] ?? 50000);
      $shipping_method_name = htmlspecialchars(trim($_POST['shipping_method_name'] ?? 'Standard Drop'));
      $payment_method = htmlspecialchars(trim($_POST['payment_method'] ?? 'Transfer BCA'));
      $voucher_id = !empty($_POST['voucher_id']) ? (int) $_POST['voucher_id'] : null;

      if (empty($recipient_name) || empty($recipient_phone) || empty($shipping_address)) {
        $this->sendResponse('error', 'Harap isi data pengirim dengan lengkap!', '/checkout');
      }

      $cart_items = [];
      $total_harga = 0;
      $harga_diskon_produk = 0;
      $subtotal_bayar = 0;

      if (isset($_SESSION['buy_now_item'])) {
        $product_id = $_SESSION['buy_now_item']['product_id'];
        $quantity = $_SESSION['buy_now_item']['quantity'];
        $produk = $this->model('ProdukModel')->getProductById((int) $product_id);

        if (!$produk) {
          $this->sendResponse('error', 'Produk tidak ditemukan!', '/cart', 400);
        }

        $harga_asli = (float) $produk['price'];
        $harga_diskon = (float) $produk['discount_price'] ? (float) $produk['discount_price'] : $harga_asli;

        $cart_items = [[
          'cart_id' => 0,
          'product_id' => $produk['id'],
          'name' => $produk['name'],
          'price' => $produk['price'],
          'discount_price' => $produk['discount_price'],
          'image_url' => $produk['image_url'],
          'quantity' => $quantity
        ]];

        $total_harga = $harga_asli * $quantity;
        $harga_diskon_produk = ($harga_asli - $harga_diskon) * $quantity;
        $subtotal_bayar = $total_harga - $harga_diskon_produk;
      } else {
        $cart_items = $this->model('CartModel')->getCartByUserId($_SESSION['user_id']);
        if (empty($cart_items)) {
          $this->sendResponse('error', 'Keranjang belanja kosong!', '/cart', 400);
        }

        $total = $this->model('CartModel')->getCartTotal($_SESSION['user_id']);
        $total_harga = $total['total_harga'] ?? 0;
        $harga_diskon_produk = $total['harga_diskon'] ?? 0;
        $subtotal_bayar = $total['total_bayar'] ?? 0;
      }

      $voucher_discount = 0;
      if ($voucher_id) {
        $voucher = $this->model('VoucherModel')->getVoucherById($voucher_id);
        $today = date('Y-m-d');

        if ($voucher && $voucher['is_active'] == 1 && $voucher['valid_until'] >= $today && $subtotal_bayar >= $voucher['min_purchase']) {
          if ($voucher['discount_type'] === 'percent') {
            $voucher_discount = $subtotal_bayar * ((float) $voucher['discount_amount'] / 100);
          } else {
            $voucher_discount = (float) $voucher['discount_amount'];
          }

          if ($voucher_discount > $total_harga) {
            $voucher_discount = $total_harga;
          }
        } else {
          $voucher_id = null;
        }
      }

      $grand_total = $subtotal_bayar - $voucher_discount + $shipping_cost;
      $total_discount_applied = $harga_diskon_produk + $voucher_discount;
      $invoice_number = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

      $orderData = [
        'invoice_number' => $invoice_number,
        'user_id' => $_SESSION['user_id'],
        'fulfilled_by_location_id' => 1,
        'voucher_id' => $voucher_id,
        'total_price' => $total_harga,
        'shipping_cost' => $shipping_cost,
        'shipping_method' => $shipping_method_name,
        'payment_method' => $payment_method,
        'discount_applied' => $total_discount_applied,
        'grand_total' => $grand_total,
        'recipient_name' => $recipient_name,
        'recipient_phone' => $recipient_phone,
        'shipping_address' => $shipping_address
      ];

      $order_id = $this->model('OrderModel')->processNewOrder($orderData, $cart_items);
      if ($order_id) {
        if (isset($_SESSION['buy_now_item'])) {
          unset($_SESSION['buy_now_item']);
        }

        $this->sendResponse('success', 'Pesanan berhasil!', '/order/success/' . $order_id);
      } else {
        $this->sendResponse('error', 'Gagal membuat pesanan!', '/checkout');
      }

      // $cartModel = $this->model('CartModel');
      // $cart_items = $cartModel->getCartByUserId($user_id);

      // if (empty($cart_items)) {
      //   $this->sendResponse('error', 'Keranjang belanja kosong!', '/cart');
      // }

      // $total = $cartModel->getCartTotal($user_id);
      // $invoice_number = 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

      // $orderData = [
      //   'invoice_number' => $invoice_number,
      //   'user_id' => $user_id,
      //   'fulfilled_by_location_id' => 1,
      //   'total_price' => $total['total_harga'],
      //   'shipping_cost' => $shipping_cost,
      //   'shipping_method' => $shipping_method_name,
      //   'payment_method' => $payment_method,
      //   'discount_applied' => $total['harga_diskon'],
      //   'grand_total' => $total['total_bayar'] + $shipping_cost,
      //   'recipient_name' => $recipient_name,
      //   'recipient_phone' => $recipient_phone,
      //   'shipping_address' => $shipping_address
      // ];

      // $orderModel = $this->model('OrderModel');
      // $order_id = $orderModel->processNewOrder($orderData, $cart_items);

      // if ($order_id) {
      //   $this->sendResponse('success', 'Pemesanan berhasil!', '/order/success/' . $order_id);
      // } else {
      //   $this->sendResponse('error', 'Pemesanan gagal!', '/checkout');
      // }
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
