<?php

declare(strict_types=1);
class HomeController extends Controller
{
  public function index(): void
  {
    $user_id = $_SESSION['user_id'] ?? null;

    $data['judul'] = 'Beranda | TI MART';

    $productModel = $this->model('ProdukModel');
    $wishlistModel = $this->model('WishlistModel');

    $kategori = $productModel->getCategories(8);
    $flash_sale = $productModel->getFlashSaleProducts(5);
    $terlaris = $productModel->getBestSellerProducts(5);
    $rekomendasi = $productModel->getRecommendedProducts(10, null);

    foreach ($flash_sale as &$p) {
      $p['is_wishlisted'] = $user_id ? $wishlistModel->isProductInWishlist($user_id, $p['id']) : false;
    }

    foreach ($terlaris as &$p) {
      $p['is_wishlisted'] = $user_id ? $wishlistModel->isProductInWishlist($user_id, $p['id']) : false;
    }

    foreach ($rekomendasi as &$p) {
      $p['is_wishlisted'] = $user_id ? $wishlistModel->isProductInWishlist($user_id, $p['id']) : false;
    }

    $data['kategori'] = $kategori;
    $data['flash_sale'] = $flash_sale;
    $data['terlaris'] = $terlaris;
    $data['rekomendasi'] = $rekomendasi;

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/index', $data);
    $this->view('templates/footer', $data);
  }
}
