<?php

declare(strict_types=1);
class NotificationModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getNotificationByUserId(int $user_id): array
  {
    $this->db->query("SELECT * FROM notifications WHERE user_id = :user_id ORDER BY created_at DESC");
    $this->db->bind("user_id", $user_id);

    return $this->db->resultSet();
  }

  public function getUnreadCount(int $user_id): int
  {
    $this->db->query("SELECT COUNT(*) AS count FROM notifications WHERE user_id = :user_id AND is_read = 0");
    $this->db->bind("user_id", $user_id);

    $result = $this->db->single();

    return (int) $result['count'];
  }

  public function markAsRead(int $notification_id, int $user_id): bool
  {
    $this->db->query("UPDATE notifications SET is_read = 1 WHERE id = :notification_id AND user_id = :user_id");
    $this->db->bind("notification_id", $notification_id);
    $this->db->bind("user_id", $user_id);

    return $this->db->execute();
  }

  public function markAllAsRead(int $user_id): bool
  {
    $this->db->query("UPDATE notifications SET is_read = 1 WHERE user_id = :user_id");
    $this->db->bind("user_id", $user_id);

    return $this->db->execute();
  }
}
