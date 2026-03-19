<?php

declare(strict_types=1);
class NotificationController extends Controller
{
  public function __construct()
  {
    if (!isset($_SESSION['user_id'])) {
      $this->sendResponse('error', 'Silahkan login terlebih dahulu!', '/auth', 401);
    }
  }

  public function index(): void
  {
    $data['judul'] = 'Notifikasi | TI MART';

    $notifikasiModel = $this->model('NotificationModel');

    $data['notifications'] = $notifikasiModel->getNotificationByUserId($_SESSION['user_id']);
    $data['unread_count'] = $notifikasiModel->getUnreadCount($_SESSION['user_id']);

    $this->view('templates/header', $data);
    $this->view('templates/navbar', $data);
    $this->view('home/notification', $data);
    $this->view('templates/footer', $data);
  }

  public function read(string $id): void
  {
    $notif_id = (int) $id;
    $user_id = (int) $_SESSION['user_id'];

    if ($notif_id <= 0) {
      $this->sendResponse('error', 'ID notifikasi tidak valid.', '', 400);
    }

    $this->model('NotificationModel')->markAsRead($notif_id, $user_id);

    $this->sendResponse('success', 'Notifikasi berhasil dibaca!', '', 200, [
      'unread_count' => $this->model('NotificationModel')->getUnreadCount($user_id)
    ]);
  }

  public function readAll(): void
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $this->model('NotificationModel')->markAllAsRead($_SESSION['user_id']);

      $this->sendResponse('success', 'Semua notifikasi berhasil dibaca!', '', 200, [
        'unread_count' => 0
      ]);
    }
  }
}
