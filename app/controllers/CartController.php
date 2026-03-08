<?php

declare(strict_types=1);
class CartController extends Controller
{
  private function isAjax(): bool
  {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);
  }

  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $is_ajax = $this->isAjax();
      if ($is_ajax) {
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode([
          'status' => 'error',
          'message' => 'Silahkan Login terlebih dahulu!',
          'redirect' => BASEURL . '/auth'
        ]);
        exit;
      }

      $_SESSION['flash_error'] = 'Silahkan login terlebih dahulu!';
      header('Location: ' . BASEURL . '/auth');
      exit;
    }
  }

  public function index(): void
  {
    $user_id = $_SESSION['user_id'];
    $cartModel = $this->model('CartModel');

    $data['judul'] = 'Keranjang Belanja | Ecommerce Bintang';

    $data['cart_items'] = $cartModel->getCartByUserId($user_id);

    $total = $cartModel->getCartTotal($user_id);

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
      $is_ajax = $this->isAjax();
      if ($is_ajax) {
        header('Content-Type: application/json');
      }

      $user_id = $_SESSION['user_id'];
      $product_id = (int) ($_POST['product_id'] ?? 0);
      $quantity = (int) ($_POST['quantity'] ?? 0);

      if ($product_id <= 0 || $quantity <= 0) {
        if ($is_ajax) {
          http_response_code(400);
          echo json_encode(['message' => 'Data produk atau jumlah tidak valid.']);
          exit;
        }

        $_SESSION['flash_error'] = 'Data produk atau jumlah tidak valid.';
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? BASEURL));
        exit;
      }

      $stock = $this->model('ProdukModel')->getProductStock($product_id);
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
        if ($is_ajax) {
          http_response_code(400);
          echo json_encode(['message' => 'Gagal!. Sisa stok hanya ' . $stock . ' barang. Anda sudah memiliki ' . $current_quantity_in_cart . ' di keranjang.']);
          exit;
        }

        $_SESSION['flash_error'] = 'Gagal! Sisa stok hanya ' . $stock . ' barang. Anda sudah memiliki ' . $current_quantity_in_cart . ' di keranjang.';
      } else {
        $this->model('CartModel')->addToCart($user_id, $product_id, $quantity);
        if ($is_ajax) {
          http_response_code(200);

          $cart_count = $this->model('CartModel')->countCartItems($user_id);

          echo json_encode([
            'status' => 'success',
            'message' => 'Produk berhasil ditambahkan ke keranjang!',
            'cart_count' => $cart_count
          ]);
          exit;
        }
        $_SESSION['flash_success'] = 'Produk berhasil ditambahkan ke keranjang!';
      }


      $referer = $_SERVER['HTTP_REFERER'] ?? BASEURL;
      header('Location: ' . $referer);
      exit;
    }
  }

  public function update(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $is_ajax = $this->isAjax();
      if ($is_ajax) {
        header('Content-Type: application/json');
      }

      $user_id = $_SESSION['user_id'];
      $cart_id = (int) ($_POST['cart_id'] ?? 0);
      $product_id = (int) ($_POST['product_id'] ?? 0);
      $action = $_POST['action'] ?? '';
      $current_quantity = (int) ($_POST['current_quantity'] ?? 1);
      $new_quantity = $current_quantity;

      $stock = $this->model('ProdukModel')->getProductStock($product_id);

      if ($action === 'increment' && $current_quantity >= $stock) {
        if ($is_ajax) {
          http_response_code(400);
          echo json_encode(['message' => 'Maksimal stok tercapai (' . $stock . ' barang)']);
          exit;
        }

        $_SESSION['flash_error'] = 'Gagal! Sisa stok hanya ' . $stock . ' barang.';
        header('Location: ' . BASEURL . '/cart');
        exit;
      }

      if ($action === 'decrement' && $current_quantity <= 1) {
        if ($cart_id > 0) {
          $this->model('CartModel')->removeFromCart($cart_id, $user_id);
          if ($is_ajax) {
            http_response_code(200);
            echo json_encode([
              'status' => 'success',
              'cart_count' => $this->model('CartModel')->countCartItems($user_id),
              'total' => $this->model('CartModel')->getCartTotal($user_id)
            ]);
            exit;
          }

          $_SESSION['flash_success'] = 'Produk berhasil dihapus dari keranjang!';
        }
        header('Location: ' . BASEURL . '/cart');
        exit;
      }

      $new_quantity = match ($action) {
        'increment' => $current_quantity + 1,
        'decrement' => $current_quantity - 1,
        default => $current_quantity
      };

      if ($new_quantity !== $current_quantity && $cart_id > 0) {
        $this->model('CartModel')->updateQuantity($cart_id, $user_id, $new_quantity);
      }

      if ($is_ajax) {
        http_response_code(200);
        echo json_encode([
          'status' => 'success',
          'new_quantity' => $new_quantity,
          'cart_count' => $this->model('CartModel')->countCartItems($user_id),
          'total' => $this->model('CartModel')->getCartTotal($user_id)
        ]);
        exit;
      }

      header('Location: ' . BASEURL . '/cart');
      exit;
    }
  }

  public function remove(string $cart_id): void
  {
    $is_ajax = $this->isAjax();
    if ($is_ajax) {
      header('Content-Type: application/json');
    }

    $id = (int) $cart_id;
    $user_id = $_SESSION['user_id'];

    if ($id > 0) {
      $this->model('CartModel')->removeFromCart($id, $user_id);
      if ($is_ajax) {
        http_response_code(200);
        echo json_encode([
          'status' => 'success',
          'message' => 'Produk berhasil dihapus!',
          'cart_count' => $this->model('CartModel')->countCartItems($user_id),
          'total' => $this->model('CartModel')->getCartTotal($user_id)
        ]);
        exit;
      }

      $_SESSION['flash_success'] = 'Produk berhasil dihapus dari keranjang!';
    }

    header('Location: ' . BASEURL . '/cart');
    exit;
  }
}
