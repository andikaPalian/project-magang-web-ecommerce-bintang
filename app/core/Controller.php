<?php

declare(strict_types=1);
class Controller
{
  public function view(string $view, array $data = []): void
  {
    if (file_exists('../app/views/' . $view . '.php')) {
      extract($data);

      require_once '../app/views/' . $view . '.php';
    } else {
      die("Error: View '{$view}' tidak ditemukan!");
    }
  }

  public function model(string $model): object
  {
    require_once '../app/models/' . $model . '.php';
    return new $model();
  }
}
