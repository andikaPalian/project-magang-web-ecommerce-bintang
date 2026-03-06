<?php
class HomeController extends Controller
{
  public function index(): void
  {
    $data['judul'] = 'Beranda | Ecommerce Bintang';

    $productModel = $this->model('ProdukModel');

    $data['kategori'] = $productModel->getCategories(8);
    $data['flash_sale'] = $productModel->getFlashSaleProducts(5);
    $data['terlaris'] = $productModel->getBestSellerProducts(5);
    $data['rekomendasi'] = $productModel->getRecommendedProducts(10, null);

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/index', $data);
    $this->view('templates/footer', $data);
  }
}
