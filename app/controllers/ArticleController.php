<?php

declare(strict_types=1);
class ArticleController extends Controller
{
  public function index(): void
  {
    $data['judul'] = 'Blog and Articles | TI MART';
    $data['articles'] = $this->model('ArticleModel')->getPublishedArticles();

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/blog', $data);
    $this->view('templates/footer', $data);
  }

  public function read(string $slug = ''): void
  {
    if (empty($slug)) {
      header('Location: ' . BASEURL . '/articles');
      exit;
    }

    $article = $this->model('ArticleModel')->getArticleBySlug($slug);

    if (!$article) {
      header('Location: ' . BASEURL . '/articles');
      exit;
    }

    $data['judul'] = $article['title'] . ' | TI MART';
    $data['article'] = $article;

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/blog_detail', $data);
    $this->view('templates/footer', $data);
  }
}
