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

  public function create(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user_id = $_SESSION['user_id'];

      $recipient_name = htmlspecialchars(trim($_POST['recipient_name'] ?? ''));
      $recipient_phone = htmlspecialchars(trim($_POST['recipient_phone'] ?? ''));
      $shipping_address = htmlspecialchars(trim($_POST['recipient_address'] ?? ''));
      $shipping_cost = (float) ($_POST['shipping_method'] ?? 0);
      $shipping_method_name = ($shipping_cost == 150000) ? 'Kargo' : 'Reguler';
      $payment_method = htmlspecialchars(trim($_POST['payment_method'] ?? 'Transfer BCA'));

      if (empty($recipient_name) || empty($recipient_phone) || empty($recipient_address)) {
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
        header('Location: ' . BASEURL . '/order/success' . $order_id);
        exit;
      } else {
        $_SESSION['flash_error'] = 'Pemesanan gagal!';
        header('Location: ' . BASEURL . '/checkout');
        exit;
      }
    }
  }

  public function success(string $order_id): void
  {
    $data['judul'] = 'Pesanan Berhasil | Alaska Electronics';
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
}
