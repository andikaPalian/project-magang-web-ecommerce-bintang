<?php

declare(strict_types=1);
class CartController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }
  }

  public function index(): void
  {
    $cartModel = $this->model('CartModel');

    $data['judul'] = 'Keranjang Belanja | TI MART';
    $data['cart_items'] = $cartModel->getCartByUserId($_SESSION['user_id']);

    $total = $cartModel->getCartTotal($_SESSION['user_id']);

    $data['total_harga'] = $total['total_harga'];
    $data['total_diskon'] = $total['total_diskon'];
    $data['total_bayar'] = $total['total_bayar'];

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/cart', $data);
    $this->view('templates/footer', $data);
  }

  public function add(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user_id = $_SESSION['user_id'];
      $product_id = (int) ($_POST['product_id'] ?? 0);
      $quantity = (int) ($_POST['quantity'] ?? 0);
      $action_type = $_POST['action'] ?? '';
      $referer = $_SERVER['HTTP_REFERER'] ?? BASEURL;

      if ($product_id <= 0 || $quantity <= 0) {
        $this->sendResponse('error', 'Data produk atau jumlah tidak valid.', $referer, 400);
        return;
      }

      $stock = $this->model('ProdukModel')->getProductStock($product_id);

      if ($action_type === 'buy_now') {
        if ($quantity > $stock) {
          $this->sendResponse('error', 'Gagal! Sisa stok hanya ' . $stock . ' barang.', $referer, 400);
        }

        $_SESSION['buy_now_item'] = [
          'product_id' => $product_id,
          'quantity' => $quantity
        ];
        $this->sendResponse('success', 'Mengarahkan ke halaman checkout...', '/checkout');
      }

      $cart_items_result = $this->model('CartModel')->getCartByUserId($user_id);
      $cart_items = is_array($cart_items_result) ? $cart_items_result : [];

      $current_quantity_in_cart = 0;
      foreach ($cart_items as $item) {
        if ($item['product_id'] === $product_id) {
          $current_quantity_in_cart = (int) $item['quantity'];
          break;
        }
      }

      if (($current_quantity_in_cart + $quantity) > $stock) {
        $this->sendResponse('error', 'Gagal! Sisa stok hanya ' . $stock . ' barang. Anda telah memiliki ' . $current_quantity_in_cart . ' di keranjang.', $referer, 400);
      }

      $this->model('CartModel')->addToCart($user_id, $product_id, $quantity);

      $this->sendResponse('success', 'Produk berhasil ditambahkan ke keranjang!', $referer, 200, [
        'cart_count' => $this->model('CartModel')->countCartItems($user_id)
      ]);
    }
  }

  public function update(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $user_id = $_SESSION['user_id'];
      $cart_id = (int) ($_POST['cart_id'] ?? 0);
      $product_id = (int) ($_POST['product_id'] ?? 0);
      $action = $_POST['action'] ?? '';
      $current_quantity = (int) ($_POST['current_quantity'] ?? 1);
      $new_quantity = $current_quantity;

      $stock = $this->model('ProdukModel')->getProductStock($product_id);

      if ($action === 'increment' && $current_quantity >= $stock) {
        $this->sendResponse('error', "Maksimal stok tercapai ($stock barang)", '/cart', 400);
      }

      if ($action === 'decrement' && $current_quantity <= 1) {
        if ($cart_id > 0) {
          $this->model('CartModel')->removeFromCart($cart_id, $user_id);

          $this->sendResponse('success', 'Produk berhasil dihapus dari keranjang!', '/cart', 200, [
            'cart_count' => $this->model('CartModel')->countCartItems($user_id),
            'total' => $this->model('CartModel')->getCartTotal($user_id)
          ]);
        }
        $this->sendResponse('error', 'Produk tidak valid', '/cart', 400);
      }

      $new_quantity = match ($action) {
        'increment' => $current_quantity + 1,
        'decrement' => $current_quantity - 1,
        default => $current_quantity
      };

      if ($new_quantity !== $current_quantity && $cart_id > 0) {
        $this->model('CartModel')->updateQuantity($cart_id, $user_id, $new_quantity);
      }

      $this->sendResponse('success', 'Jumlah produk berhasil diperbarui!', '/cart', 200, [
        'new_quantity' => $new_quantity,
        'cart_count' => $this->model('CartModel')->countCartItems($user_id),
        'total' => $this->model('CartModel')->getCartTotal($user_id)
      ]);
    }
  }

  public function remove(string $cart_id): void
  {
    $id = (int) $cart_id;
    $user_id = $_SESSION['user_id'];

    if ($id > 0) {
      $this->model('CartModel')->removeFromCart($id, $user_id);

      $this->sendResponse('success', 'Produk berhasil dihapus dari keranjang!', '/cart', 200, [
        'cart_count' => $this->model('CartModel')->countCartItems($user_id),
        'total' => $this->model('CartModel')->getCartTotal($user_id)
      ]);
    } else {
      $this->sendResponse('error', 'Produk tidak valid', '/cart', 400);
    }
  }
}
