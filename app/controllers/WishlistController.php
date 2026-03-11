<?php

declare(strict_types=1);
class WishlistController extends Controller
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
          'message' => 'Silahkan login terlebih dahulu!',
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

    $data['judul'] = 'Wishlist | TI MART';

    $data['wishlist'] = $this->model('WishlistModel')->getWishlistByUserId($user_id);

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/wishlist', $data);
    $this->view('templates/footer', $data);
  }

  public function toggle(string $product_id): void
  {
    $is_ajax = $this->isAjax();
    if ($is_ajax) {
      header('Content-Type: application/json');
    }

    $user_id = $_SESSION['user_id'];
    $id_product = (int) $product_id;
    if ($id_product <= 0) {
      if ($is_ajax) {
        http_response_code(400);
        echo json_encode(['error' => 'ID produk tidak valid.']);
        exit;
      }
      header('Location: ' . BASEURL);
      exit;
    }

    $result = $this->model('WishlistModel')->toggleWishList((int) $user_id, (int) $product_id);

    if ($is_ajax) {
      http_response_code(200);
      echo json_encode([
        'status' => 'success',
        'action' => $result,
        'message' => $result === 'added' ? 'Produk berhasil ditambahkan ke wishlist.' : 'Produk berhasil dihapus dari wishlist.',
        'wishlist_count' => $this->model('WishlistModel')->getWishlistCount($user_id)
      ]);
      exit;
    }

    $_SESSION['flash_success'] = ($result === 'added') ? 'Berhasil menambahkan produk ke wishlist.' : 'Berhasil menghapus produk dari wishlist.';
    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? BASEURL));
    exit;
  }
}
