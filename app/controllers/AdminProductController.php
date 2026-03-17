<?php

declare(strict_types=1);
class AdminProductController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      header('Location: ' . BASEURL . '/auth');
      exit;
    }

    if (!in_array($_SESSION['role'], ['admin_web', 'admin_toko'])) {
      header('Location: ' . BASEURL);
      exit;
    }
  }

  private function createSlug(string $string): string
  {
    $slug = strtolower(trim($string));
    $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
    $slug = $slug . '-' . substr(uniqid(), -5);

    return $slug;
  }

  private function uploadImage(): string|false
  {
    $fileName = $_FILES['image']['name'];
    $fileSize = $_FILES['image']['size'];
    $tmpName = $_FILES['image']['tmp_name'];

    $ext = ['jpg', 'jpeg', 'png', 'webp'];
    $fileExt = explode('.', $fileName);
    $fileExt = strtolower(end($fileExt));

    if (!in_array($fileExt, $ext)) {
      return false;
    }

    if ($fileSize > 5242880) {
      return false;
    }

    $newFileName = uniqid() . '.' . $fileExt;
    $destination = dirname(__DIR__, 2) . '/public/img/products/';

    if (!is_dir($destination)) {
      mkdir($destination, 0777, true);
    }

    move_uploaded_file($tmpName, $destination . $newFileName);

    return $newFileName;
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
      $_POST['slug'] = $this->createSlug($_POST['name']);
    }

    $imageName = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $imageName = $this->uploadImage();
      if (!$imageName) {
        header('Location: ' . BASEURL . '/adminproduct');
        exit;
      }
    }

    if ($this->model('ProdukModel')->addProduct($_POST, $imageName) > 0) {
      header('Location: ' . BASEURL . '/adminproduct');
      exit;
    } else {
      header('Location: ' . BASEURL . '/adminproduct');
      exit;
    }
  }

  public function updateProduct(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $_POST['slug'] = $this->createSlug($_POST['name']);

      $id = (int) $_POST['id'];
      $imageName = null;

      if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = $this->uploadImage();
      }

      if ($this->model('ProdukModel')->updateProduct($_POST, $imageName) >= 0) {
        header('Location: ' . BASEURL . '/adminproduct');
        exit;
      } else {
        header('Location: ' . BASEURL . '/adminproduct');
        exit;
      }
    }
  }

  public function deleteProduct(string $product_id): void
  {
    $productId = (int) $product_id;

    if ($this->model('ProdukModel')->deleteProduct($productId) > 0) {
      header('Location: ' . BASEURL . '/adminproduct');
      exit;
    } else {
      header('Location: ' . BASEURL . '/adminproduct');
      exit;
    }
  }
}
