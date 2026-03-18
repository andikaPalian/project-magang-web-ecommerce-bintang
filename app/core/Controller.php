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

  protected function isAjax(): bool
  {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);
  }

  protected function sendResponse(string $status, string $message, string $redirectUrl = '', int $httpCode = 200, array $extraData = []): void
  {
    if ($this->isAjax()) {
      http_response_code($httpCode);
      header('Content-Type: application/json');
      $response = [
        'status' => $status,
        'message' => $message
      ];

      if (!empty($extraData)) {
        $response = array_merge($response, $extraData);
      }

      echo json_encode($response);
      exit;
    } else {
      $_SESSION['flash_' . $status] = $message;

      if ($redirectUrl !== '') {
        header('Location: ' . BASEURL . $redirectUrl);
      } else {
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? BASEURL));
      }
      exit;
    }
  }

  protected function sendData(array $data, int $httpCode = 200): void
  {
    if ($this->isAjax()) {
      http_response_code($httpCode);
      header('Content-Type: application/json');
      echo json_encode([
        'status' => 'success',
        'data' => $data
      ]);
      exit;
    }
  }
}
