<?php

declare(strict_types=1);
class KatalogController extends Controller
{
  public function index(): void
  {
    $data['judul'] = 'Semua Produk | TI MART';
    $data['produk'] = $this->model('ProdukModel')->getAllProducts();
    $data['kategori'] = $this->model('ProdukModel')->getCategories(20);

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/katalog', $data);
    $this->view('templates/footer', $data);
  }

  public function kategori(string $slug): void
  {
    $data['judul'] = 'Kategori: ' . strtoupper($slug) . ' | TI MART';

    $data['produk'] = $this->model('ProdukModel')->getProductsByCategorySlug($slug);
    $data['kategori'] = $this->model('ProdukModel')->getCategories(20);
    $data['active_category'] = $slug;

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/katalog', $data);
    $this->view('templates/footer', $data);
  }

  public function flashsale(): void
  {
    $data['judul'] = 'Flash Sale | TI MART';

    $data['produk'] = $this->model('ProdukModel')->getFlashSaleProducts(20);
    $data['kategori'] = $this->model('ProdukModel')->getCategories(20);
    $data['active_category'] = 'FLASH SALE';

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/katalog', $data);
    $this->view('templates/footer', $data);
  }

  public function bestseller(): void
  {
    $data['judul'] = 'Best Seller | TI MART';

    $data['produk'] = $this->model('ProdukModel')->getBestSellerProducts(20);
    $data['kategori'] = $this->model('ProdukModel')->getCategories(20);
    $data['active_category'] = 'PRODUK TERLARIS';

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/katalog', $data);
    $this->view('templates/footer', $data);
  }
}
