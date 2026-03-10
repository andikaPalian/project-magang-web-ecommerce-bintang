<?php

declare(strict_types=1);
class CheckoutController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $_SESSION['flash_error'] = 'Silahkan login terlebih dahulu!';
      header('Location: ' . BASEURL . '/auth');
      exit;
    }
  }

  public function index(): void
  {
    $user_id = $_SESSION['user_id'];

    $cartModel = $this->model('CartModel');

    $data['cart_items'] = $cartModel->getCartByUserId($user_id);

    if (empty($data['cart_items'])) {
      $_SESSION['flash_error'] = 'Keranjang belanja kosong!';
      header('Location: ' . BASEURL . '/cart');
      exit;
    }

    $total = $cartModel->getCartTotal($user_id);
    $data['total_harga'] = $total['total_harga'] ?? 0;
    $data['total_diskon'] = $total['harga_diskon'] ?? 0;
    $data['subtotal_bayar'] = $total['total_bayar'] ?? 0;

    $data['judul'] = 'Checkout | TI MART';

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/checkout', $data);
    $this->view('templates/footer', $data);
  }
}
