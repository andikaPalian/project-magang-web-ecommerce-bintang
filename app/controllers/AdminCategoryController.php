<?php

declare(strict_types=1);
class AdminCategoryController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }

    if ($_SESSION['role'] !== 'admin_web') {
      $this->sendResponse('error', 'Anda tidak memiliki akses ke halaman ini!', '', 403);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Category Management | TI MART';
    $data['categories'] = $this->model('CategoryModel')->getAllCategories();

    $products = $this->model('ProdukModel')->getAllProducts();

    $totalCategories = count($data['categories']);
    $totalProductsIndexed = count($products);

    $productCount = [];
    foreach ($products as $p) {
      $categoryId = $p['category_id'];
      if (!isset($productCount[$categoryId])) {
        $productCount[$categoryId] = 0;
      }
      $productCount[$categoryId]++;
    }

    $activeCategories = 0;
    foreach ($data['categories'] as &$cat) {
      $count = $productCount[$cat['id']] ?? 0;
      $cat['product_count'] = $count;

      if ($count > 0) {
        $activeCategories++;
      }
    }

    $data['stats'] = [
      'total_categories' => $totalCategories,
      'total_products_indexed' => $totalProductsIndexed,
      'active_categories' => $activeCategories
    ];

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('admin_web/categories', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function store(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (empty($_POST['name'])) {
        $this->sendResponse('error', 'Nama kategori tidak boleh kosong.', '/admincategory', 400);
      }

      $_POST['slug'] = Helper::createSlug($_POST['name']);

      $iconName = null;
      if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
        $iconName = Helper::uploadImage($_FILES['icon'], 'categories');
        if (!$iconName) {
          $this->sendResponse('error', 'Gagal upload icon! Format tidak sesuai atau ukuran melebihi batas 5MB.', '/admincategory', 400);
        }
      }

      if ($this->model('CategoryModel')->addCategory($_POST, $iconName)) {
        $this->sendResponse('success', 'Kategori berhasil ditambahkan!', '/admincategory', 200);
      } else {
        $this->sendResponse('error', 'Gagal menambahkan kategori!', '/admincategory', 500);
      }
    }
  }

  public function update(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $category_id = (int) ($_POST['id'] ?? 0);
      $name = trim($_POST['name'] ?? '');

      if ($category_id <= 0 || empty($name)) {
        $this->sendResponse('error', 'Data kategori tidak valid', '/admincategory', 400);
      }

      $_POST['slug'] = Helper::createSlug($_POST['name']);

      $iconName = null;
      if (isset($_FILES['icon']) && $_FILES['icon']['error'] === UPLOAD_ERR_OK) {
        $iconName = Helper::uploadImage($_FILES['icon'], 'categories');
        if (!$iconName) {
          $this->sendResponse('error', 'Gagal upload icon! Format tidak sesuai atau ukuran melebihi batas 5MB.', '/admincategory', 400);
        }
      }

      if ($this->model('CategoryModel')->updateCategory($_POST, $iconName)) {
        $this->sendResponse('success', 'Kategori berhasil diperbarui!', '/admincategory', 200);
      } else {
        $this->sendResponse('error', 'Gagal memperbarui kategori!', '/admincategory', 500);
      }
    }
  }

  public function delete(string $category_id): void
  {
    $categoryId = (int) $category_id;

    if ($categoryId <= 0) {
      $this->sendResponse('error', 'ID kategori tidak valid.', '/admincategory', 400);
    }

    $category = $this->model('CategoryModel')->getCategoryById($categoryId);
    if (!$category) {
      $this->sendResponse('error', 'Kategori tidak ditemukan.', '/admincategory', 400);
    }

    if ($this->model('CategoryModel')->deleteCategory($categoryId) > 0) {
      if ($category && !empty($category['icon'])) {
        Helper::deleteImage($category['icon'], 'categories');
      }

      $this->sendResponse('success', 'Kategori berhasil dihapus! Produk yang terikat kini menjadi "Tanpa Kategori".', '/admincategory', 200);
    } else {
      $this->sendResponse('error', 'Gagal menghapus kategori!', '/admincategory', 500);
    }
  }
}
