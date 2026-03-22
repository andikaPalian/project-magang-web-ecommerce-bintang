<?php

declare(strict_types=1);
class AdminArticleController extends Controller
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
    $data['judul'] = 'Article Management | TI MART';
    $data['articles'] = $this->model('ArticleModel')->getAllArticles();

    $totalArticle = count($data['articles']);
    $publishedLive = 0;
    $draftPending = 0;

    foreach ($data['articles'] as $cat) {
      if ($cat['status'] === 'published') {
        $publishedLive++;
      } else {
        $draftPending++;
      }
    }

    $data['stats'] = [
      'total_articles' => $totalArticle,
      'published_live' => $publishedLive,
      'draft_pending' => $draftPending
    ];

    $this->view('templates/header_admin', $data);
    $this->view('templates/sidebar_admin', $data);
    $this->view('admin_web/articles', $data);
    $this->view('templates/footer_admin', $data);
  }

  public function store(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      if (empty($_POST['title']) || empty($_POST['content'])) {
        $this->sendResponse('error', 'Judul dan konten artikel tidak boleh kosong.', '/adminarticle', 400);
      }

      $_POST['slug'] = Helper::createSlug($_POST['title']);
      $_POST['author_id'] = $_SESSION['user_id'];

      $imageName = null;
      if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = Helper::uploadImage($_FILES['image'], 'articles');
        if (!$imageName) {
          $this->sendResponse('error', 'Gagal upload gambar! Format tidak sesuai atau ukuran melebihi batas 5MB.', '/adminarticle', 400);
        }
      }

      if ($this->model('ArticleModel')->addArticle($_POST, $imageName) > 0) {
        $this->sendResponse('success', 'Artikel berhasil ditambahkan.', '/adminarticle', 200);
      } else {
        $this->sendResponse('error', 'Gagal menambahkan artikel.', '/adminarticle', 500);
      }
    }
  }

  public function update(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $article_id = (int) ($_POST['id'] ?? 0);

      if ($article_id <= 0 || empty($_POST['title']) || empty($_POST['content'])) {
        $this->sendResponse('error', 'Data artikel tidak valid.', '/adminarticle', 400);
      }

      $_POST['slug'] = Helper::createSlug($_POST['title']);

      $oldArticle = $this->model('ArticleModel')->getArticleById($article_id);

      $imageName = null;
      if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageName = Helper::uploadImage($$_FILES['image'], 'articles');
        if (!$imageName) {
          $this->sendResponse('error', 'Gagal upload gambar! Format tidak sesuai atau ukuran melebihi batas 5MB.', '/adminarticle', 400);
        }

        if (!empty($oldArticle['image'])) {
          Helper::deleteImage($oldArticle['image'], 'articles');
        }

        if ($this->model('ArticleModel')->updateArticle($article_id, $_POST, $imageName) >= 0) {
          $this->sendResponse('success', 'Artikel berhasil diperbarui.', '/adminarticle', 200);
        } else {
          $this->sendResponse('error', 'Gagal memperbarui artikel.', '/adminarticle', 500);
        }
      }
    }
  }

  public function delete(string $article_id): void
  {
    $articleId = (int) $article_id;

    $article = $this->model('ArticleModel')->getArticleById($articleId);
    if (!$article) {
      $this->sendResponse('error', 'Artikel tidak ditemukan.', '/adminarticle', 400);
    }

    if ($this->model('ArticleModel')->deleteArticle($articleId) > 0) {
      if ($article['image_url']) {
        Helper::deleteImage($article['image_url'], 'articles');
      }
      $this->sendResponse('success', 'Artikel berhasil dihapus.', '/adminarticle', 200);
    } else {
      $this->sendResponse('error', 'Gagal menghapus artikel.', '/adminarticle', 500);
    }
  }
}
