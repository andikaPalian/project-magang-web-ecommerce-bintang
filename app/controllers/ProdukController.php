<?php

declare(strict_types=1);
class ProdukController extends Controller
{
  public function detail(string $slug): void
  {
    if (empty($slug)) {
      header('Location: ' . BASEURL);
      exit;
    }

    $productModel = $this->model('ProdukModel');

    $produk = $productModel->getProductBySlug($slug);
    if (!$produk) {
      header("Location: " . BASEURL);
      exit;
    }

    $data['judul'] = $produk['name'] . ' | Ecommerce Bintang';
    $data['produk'] = $produk;

    $id = (int) $produk['id'];
    $user_id = $_SESSION['user_id'] ?? null;

    $data['stok'] = $productModel->getProductStock($id);
    $data['spesifikasi'] = $productModel->getProductSpecs($id);
    $data['ulasan'] = $productModel->getProductReviews($id);
    $data['produk_serupa'] = $productModel->getRecommendedProducts(5, $user_id);

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/detail', $data);
    $this->view('templates/footer', $data);
  }
}
