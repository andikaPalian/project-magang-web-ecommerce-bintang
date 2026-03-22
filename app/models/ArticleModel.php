<?php

declare(strict_types=1);
class ArticleModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getPublishedArticles(): array
  {
    $this->db->query("SELECT a.*, u.name AS author_name FROM articles a JOIN users u ON a.author_id = u.id WHERE a.status = 'published' ORDER BY a.created_at DESC");

    return $this->db->resultSet();
  }

  public function getArticleBySlug(string $slug): array|false
  {
    $this->db->query("SELECT a.*, u.name AS author_name FROM articles a JOIN users u ON a.author_id = u.id WHERE a.slug = :slug AND a.status = 'published'");
    $this->db->bind("slug", $slug);

    return $this->db->single();
  }

  public function getAllArticles(): array
  {
    $this->db->query("SELECT a.*, u.name AS author_name FROM articles a JOIN users u ON a.author_id = u.id ORDER BY a.created_at DESC");

    return $this->db->resultSet();
  }

  public function getArticleById(int $article_id): array|false
  {
    $this->db->query("SELECT a.*, u.name AS author_name FROM articles a JOIN users u ON a.author_id = u.id WHERE a.id = :article_id");
    $this->db->bind("article_id", $article_id);

    return $this->db->single();
  }

  public function addArticle(array $data, ?string $image_url = null): int
  {
    $this->db->query("INSERT INTO articles (title, slug, excerpt, content, image_url, author_id, status) VALUES (:title, :slug, :excerpt, :content, :image_url, :author_id, :status)");

    $this->db->bind('title', $data['title']);
    $this->db->bind('slug', $data['slug']);
    $this->db->bind('excerpt', $data['excerpt']);
    $this->db->bind('content', $data['content']);
    $this->db->bind('image_url', $image_url);
    $this->db->bind('author_id', $data['author_id']);
    $this->db->bind('status', $data['status']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function updateArticle(int $article_id, array $data, ?string $image_url = null): int
  {
    $this->db->query("UPDATE articles SET title = :title, slug = :slug, excerpt = :excerpt, content = :content, image_url = :image_url, status = :status WHERE id = :article_id");

    $this->db->bind('title', $data['title']);
    $this->db->bind('slug', $data['slug']);
    $this->db->bind('excerpt', $data['excerpt']);
    $this->db->bind('content', $data['content']);
    $this->db->bind('image_url', $image_url);
    $this->db->bind('status', $data['status']);
    $this->db->bind('article_id', $article_id);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteArticle(int $article_id): int
  {
    $this->db->query("DELETE FROM articles WHERE id = :article_id");
    $this->db->bind("article_id", $article_id);

    $this->db->execute();

    return $this->db->rowCount();
  }
}
