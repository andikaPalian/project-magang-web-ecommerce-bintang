<?php

declare(strict_types=1);
class CheckoutController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Checkout | TI MART';
    $data['user'] = $this->model('UserModel')->getUserById($_SESSION['user_id']);

    if (isset($_SESSION['buy_now_item'])) {
      $product_id = $_SESSION['buy_now_item']['product_id'];
      $quantity = $_SESSION['buy_now_item']['quantity'];

      $produk = $this->model('ProdukModel')->getProductById((int) $product_id);

      if (!$produk) {
        unset($_SESSION['buy_now_item']);
        $this->sendResponse('error', 'Produk tidak ditemukan atau tidak tersedia.', '/cart', 400);
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

      $data['cart_items'] = $cartModel->getCartByUserId($_SESSION['user_id']);

      if (empty($data['cart_items'])) {
        $this->sendResponse('error', 'Keranjang belanja kosong!', '/cart', 400);
      }

      $total = $cartModel->getCartTotal($_SESSION['user_id']);
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
