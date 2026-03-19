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
      $this->sendResponse('error', 'Slug tidak valid.', '/article', 400);
    }

    $article = $this->model('ArticleModel')->getArticleBySlug($slug);

    if (!$article) {
      $this->sendResponse('error', 'Artikel tidak ditemukan.', '/article', 404);
    }

    $data['judul'] = $article['title'] . ' | TI MART';
    $data['article'] = $article;

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/blog_detail', $data);
    $this->view('templates/footer', $data);
  }
}
