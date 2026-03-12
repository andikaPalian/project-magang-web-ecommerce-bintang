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

    $data['judul'] = 'Checkout | TI MART';

    if (isset($_SESSION['buy_now_item'])) {
      $product_id = $_SESSION['buy_now_item']['product_id'];
      $quantity = $_SESSION['buy_now_item']['quantity'];

      $produk = $this->model('ProdukModel')->getProductById((int) $product_id);

      if (!$produk) {
        unset($_SESSION['buy_now_item']);
        $_SESSION['flash_error'] = 'Produk tidak ditemukan atau tidak tersedia.';
        header('Location: ' . BASEURL . '/cart');
        exit;
      }

      $harga_asli = (float) $produk['price'];
      $harga_diskon = !empty($produk['discount_price']) ? (float) $produk['discount_price'] : $harga_asli;
      $diskon_per_item = $harga_asli - $harga_diskon;

      $data['cart_items'] = [
        [
          'cart_id' => 0,
          'product_id' => $produk['id'],
          'name' => $produk['name'],
          'price' => $produk['price'],
          'discount_price' => $produk['discount_price'],
          'image_url' => $produk['image_url'],
          'quantity' => $quantity,
          'weight_grams' => $produk['weight_grams'] ?? 0
        ]
      ];

      $data['total_harga'] = $harga_asli * $quantity;
      $data['total_diskon'] = $diskon_per_item * $quantity;
      $data['subtotal_bayar'] = $harga_diskon * $quantity;
    } else {
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
    }


    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/checkout', $data);
    $this->view('templates/footer', $data);
  }
}
