<?php

declare(strict_types=1);
class NotificationController extends Controller
{
  private function isAjax(): bool
  {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') || (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false);
  }


  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $is_ajax = $this->isAjax();
      if ($is_ajax) {
        http_response_code(401);
        header('Content-Type: application/json');
        echo json_encode([
          'status' => 'error',
          'message' => 'Silahkan login terlebih dahulu!',
          'redirect' => BASEURL . '/auth'
        ]);
        exit;
      }

      $_SESSION['flash_error'] = 'Silahkan login terlebih dahulu!';
      header('Location: ' . BASEURL . '/auth');
      exit;
    }
  }

  public function index(): void
  {
    $user_id = $_SESSION['user_id'];

    $data['judul'] = 'Notifikasi | TI MART';

    $notifikasiModel = $this->model('NotificationModel');

    $data['notifications'] = $notifikasiModel->getNotificationByUserId($user_id);
    $data['unread_count'] = $notifikasiModel->getUnreadCount($user_id);

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/notification', $data);
    $this->view('templates/footer', $data);
  }

  public function read(string $id): void
  {
    $notif_id = (int) $id;
    $user_id = (int) $_SESSION['user_id'];

    $is_ajax = $this->isAjax();
    if ($is_ajax) {
      header('Content-Type: application/json');
    }

    if ($notif_id <= 0) {
      if ($is_ajax) {
        http_response_code(400);
        echo json_encode(['message' => 'ID notifikasi tidak valid.']);
        exit;
      }

      header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? BASEURL . '/notification'));
      exit;
    }

    $this->model('NotificationModel')->markAsRead($notif_id, $user_id);

    if ($is_ajax) {
      http_response_code(200);
      echo json_encode([
        'status' => 'success',
        'message' => 'Notifikasi berhasil dibaca!',
        'unread_count' => $this->model('NotificationModel')->getUnreadCount($user_id)
      ]);
      exit;
    }

    header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? BASEURL . '/notification'));
    exit;
  }

  public function readAll(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $is_ajax = $this->isAjax();
      if ($is_ajax) {
        header('Content-Type: application/json');
      }

      $user_id = $_SESSION['user_id'];

      $this->model('NotificationModel')->markAllAsRead($user_id);

      if ($is_ajax) {
        http_response_code(200);
        echo json_encode([
          'status' => 'success',
          'message' => 'Semua notifikasi berhasil dibaca!',
          'unread_count' => 0
        ]);
        exit;
      }

      $_SESSION['flash_success'] = 'Semua notifikasi berhasil dibaca!';
      header('Location: ' . BASEURL . '/notification');
      exit;
    }
  }
}
