<?php

declare(strict_types=1);
class AdminProductController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }

    if (!in_array($_SESSION['role'], ['admin_web', 'admin_toko'])) {
      $this->sendResponse('error', 'Anda tidak memiliki akses ke halaman ini!', '', 403);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Product Management | TI MART';
    $data['products'] = $this->model('ProdukModel')->getAllProductsForAdmin();
    $data['categories'] = $this->model('ProdukModel')->getAllCategoriesAdmin();

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('admin_web/products', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function storeProduct(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $_POST['slug'] = Helper::createSlug($_POST['name']);

      $imageName = null;
      if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = Helper::uploadImage($_FILES['image'], 'products');
        if (!$imageName) {
          $this->sendResponse('error', 'Format gambar salah atau ukuran melebihi batas 5MB.', '/adminproduct', 400);
          return;
        }
      }

      if ($this->model('ProdukModel')->addProduct($_POST, $imageName) > 0) {
        $this->sendResponse('success', 'Produk baru berhasil ditambahkan ke katalog!', '/adminproduct');
      } else {
        $this->sendResponse('error', 'Gagal menyimpan produk ke database.', '/adminproduct', 500);
      }
    }
  }

  public function updateProduct(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $_POST['slug'] = Helper::createSlug($_POST['name']);

      $id = (int) $_POST['id'];
      $imageName = null;

      if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = Helper::uploadImage($_FILES['image'], 'products');
        if (!$imageName) {
          $this->sendResponse('error', 'Format gambar salah atau ukuran melebihi batas 5MB.', '/adminproduct', 400);
          return;
        }
      }

      if ($this->model('ProdukModel')->updateProduct($_POST, $imageName) >= 0) {
        $this->sendResponse('success', 'Data produk berhasil diperbarui!', '/adminproduct');
      } else {
        $this->sendResponse('error', 'Tidak ada perubahan atau gagal memperbarui data produk.', '/adminproduct', 400);
      }
    }
  }

  public function deleteProduct(string $product_id): void
  {
    $productId = (int) $product_id;

    if ($this->model('ProdukModel')->deleteProduct($productId) > 0) {
      $this->sendResponse('success', 'Produk berhasil dihapus dari katalog!', '/adminproduct');
    } else {
      $this->sendResponse('error', 'Gagal menghapus produk dari katalog.', '/adminproduct', 400);
    }
  }

  public function getSpecs(string $product_id): void
  {
    $specs = $this->model('ProdukModel')->getProductSpecs((int) $product_id);
    $this->sendData($specs);
  }

  public function storeSpecs(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if ($this->model('ProdukModel')->addProductSpecs($_POST) > 0) {
        $this->sendResponse('success', 'Spesifikasi produk berhasil ditambahkan!', '/adminproduct');
      } else {
        $this->sendResponse('error', 'Gagal menyimpan spesifikasi produk ke database.', '/adminproduct', 500);
      }
    }
  }

  public function deleteSpecs(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $spec_id = (int) $_POST['id'];

      if ($this->model('ProdukModel')->deleteProductSpecs($spec_id) > 0) {
        $this->sendResponse('success', 'Spesifikasi produk berhasil dihapus!', '/adminproduct');
      } else {
        $this->sendResponse('error', 'Gagal menghapus spesifikasi produk.', '/adminproduct', 400);
      }
    }
  }
}
