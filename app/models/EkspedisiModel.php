<?php

declare(strict_types=1);
class EkspedisiModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAvailablePickups(): array
  {
    $this->db->query("SELECT o.*, u.name AS customer_name, l.address AS origin_address FROM orders o JOIN users u ON o.user_id = u.id JOIN locations l ON o.fulfilled_by_location_id = l.id WHERE o.order_status = 'shipped' AND o.id NOT IN (SELECT order_id FROM deliveries WHERE courier_id IS NOT NULL)");

    return $this->db->resultSet();
  }

  public function getMyActiveDeliveries(int $courier_id): array
  {
    $this->db->query("SELECT d.*, o.invoice_number, o.recipient_name, o.recipient_phone, o.shipping_address FROM deliveries d JOIN orders o ON d.order_id = o.id WHERE d.courier_id = :courier_id AND d.delivery_status = 'on_delivery'");
    $this->db->bind('courier_id', $courier_id);

    return $this->db->resultSet();
  }

  public function takePackage(int $order_id, int $courier_id): int
  {
    $tracking_number = 'TRK-' . strtoupper(substr(md5((string)time()), 0, 8));

    $this->db->query("INSERT INTO deliveries (order_id, courier_id, tracking_number, delivery_status) VALUES (:order_id, :courier_id, :tracking_number, 'on_delivery')");

    $this->db->bind('order_id', $order_id);
    $this->db->bind('courier_id', $courier_id);
    $this->db->bind('tracking_number', $tracking_number);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function completeDelivery(int $order_id): int
  {
    $this->db->query("UPDATE deliveries SET delivery_status = 'completed' WHERE order_id = :order_id");
    $this->db->bind('order_id', $order_id);
    $this->db->execute();

    $this->db->query("UPDATE orders SET order_status = 'delivered' WHERE id = :order_id");
    $this->db->bind('order_id', $order_id);
    $this->db->execute();

    return $this->db->rowCount();
  }
}
