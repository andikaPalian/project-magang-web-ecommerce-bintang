<?php

declare(strict_types=1);
class ProdukController extends Controller
{
  public function detail(string $slug): void
  {
    $user_id = $_SESSION['user_id'] ?? null;

    if (empty($slug)) {
      $this->sendResponse('error', 'Slug tidak valid.', '', 400);
    }

    $productModel = $this->model('ProdukModel');
    $wishlistModel = $this->model('WishlistModel');

    $produk = $productModel->getProductBySlug($slug);
    if (!$produk) {
      $this->sendResponse('error', 'Produk tidak ditemukan.', '', 404);
    }

    $data['judul'] = $produk['name'] . ' | TI MART';
    $data['produk'] = $produk;

    $id = (int) $produk['id'];
    $category_id = (int) $produk['category_id'];

    $data['stok'] = $productModel->getProductStock($id);
    $data['spesifikasi'] = $productModel->getProductSpecs($id);
    $data['ulasan'] = $productModel->getProductReviews($id);

    $produk_serupa = $productModel->getSimiliarProducts($category_id, $id, 5);

    $data['is_wishlisted'] = $user_id ? $wishlistModel->isProductInWishlist((int) $user_id, $id) : false;

    if (is_array($produk_serupa)) {
      foreach ($produk_serupa as &$p) {
        $p['is_wishlisted'] = $user_id ? $wishlistModel->isProductInWishlist((int) $user_id, (int) $p['id']) : false;
      }
    }

    $data['produk_serupa'] = $produk_serupa ? $produk_serupa : [];

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/detail', $data);
    $this->view('templates/footer', $data);
  }
}
