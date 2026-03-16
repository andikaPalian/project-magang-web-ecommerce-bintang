<?php

declare(strict_types=1);
class Usermodel
{
  private $db;
  public function __construct()
  {
    $this->db = new Database();
  }

  public function getUserByEmail(string $email): array|false
  {
    $this->db->query('SELECT * FROM users WHERE email = :email');
    $this->db->bind('email', $email);

    return $this->db->single();
  }

  public function getUserById(int $id): array|false
  {
    $this->db->query("SELECT id, name, email, role, phone, address FROM users WHERE id = :id");
    $this->db->bind('id', $id);

    return $this->db->single();
  }

  public function registerUser(array $data): int
  {
    $this->db->query("INSERT INTO users (name, email, password, phone, role) VALUES (:name, :email, :password, :phone, :role)");
    $this->db->bind('name', $data['name']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', $data['password']);
    $this->db->bind('phone', $data['phone']);
    $this->db->bind('role', 'pembeli');

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function updateProfile(array $data): int
  {
    $this->db->query("UPDATE users SET name = :name, email = :email, phone = :phone, address = :address WHERE id = :id");
    $this->db->bind('name', $data['name']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('phone', $data['phone']);
    $this->db->bind('address', $data['address']);
    $this->db->bind('id', $data['id']);

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function getAllUsers(int $user_id): array|false
  {
    $this->db->query("SELECT * FROM users WHERE id != :user_id ORDER BY created_at DESC");
    $this->db->bind('user_id', $user_id);

    return $this->db->resultSet();
  }

  public function addUserByAdmin(array $data): int
  {
    $this->db->query("INSERT INTO users (name, email, password, phone, role, address) VALUES (:name, :email, :password, :phone, :role, :address)");

    $this->db->bind('name', $data['name']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
    $this->db->bind('phone', $data['phone']);
    $this->db->bind('role', $data['role']);
    $this->db->bind('address', $data['address']);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function updateUserByAdmin(array $data, int $id): int
  {
    if (!empty($data['password'])) {
      $this->db->query("UPDATE users SET name = :name, email = :email, password = :password, phone = :phone, role = :role, address = :address WHERE id = :id");

      $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
    } else {
      $this->db->query("UPDATE users SET name = :name, email = :email, phone = :phone, role = :role, address = :address WHERE id = :id");
    }

    $this->db->bind('name', $data['name']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('phone', $data['phone']);
    $this->db->bind('role', $data['role']);
    $this->db->bind('address', $data['address']);
    $this->db->bind('id', $id);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteUser(int $id): int
  {
    $this->db->query("DELETE FROM users WHERE id = :id");
    $this->db->bind('id', $id);
    $this->db->execute();

    return $this->db->rowCount();
  }
}
