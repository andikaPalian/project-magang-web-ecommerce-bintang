<?php

declare(strict_types=1);
class WishlistController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Wishlist | TI MART';
    $data['wishlist'] = $this->model('WishlistModel')->getWishlistByUserId($_SESSION['user_id']);

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/wishlist', $data);
    $this->view('templates/footer', $data);
  }

  public function toggle(string $product_id): void
  {
    $id_product = (int) $product_id;
    if ($id_product <= 0) {
      $this->sendResponse('error', 'ID produk tidak valid.', '', 400);
    }

    $result = $this->model('WishlistModel')->toggleWishList((int) $_SESSION['user_id'], (int) $product_id);

    $this->sendResponse('success', $result === 'added' ? 'Produk berhasil ditambahkan ke wishlist.' : 'Produk berhasil dihapus dari wishlist.', '', 200, [
      'action' => $result,
      'wishlist_count' => $this->model('WishlistModel')->getWishlistCount($_SESSION['user_id'])
    ]);
  }
}
