<?php
class Usermodel
{
  private $db;
  public function __construct()
  {
    $this->db = new Database;
  }

  public function getUserByEmail(string $email): array|false
  {
    $this->db->query('SELECT * FROM users WHERE email = :email');
    $this->db->bind('email', $email);

    return $this->db->single();
  }

  public function getUserById(int $id): array|false
  {
    $this->db->query("SELECT id, nama, email, role FROM users WHERE id = :id");
    $this->db->bind('id', $id);

    return $this->db->single();
  }

  public function registerUser(array $data): int
  {
    $this->db->query("INSERT INTO users (nama, email, password, phone, role) VALUES (:nama, :email, :password, :phone, :role)");
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', $data['password']);
    $this->db->bind('phone', $data['phone']);
    $this->db->bind('role', 'pembeli');

    $this->db->execute();
    return $this->db->rowCount();
  }

  public function updateProfile(array $data): int
  {
    $this->db->query("UPDATE users SET nama = :nama, email = :email, phone = :phone, address = :address WHERE id = :id");
    $this->db->bind('nama', $data['nama']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('phone', $data['phone']);
    $this->db->bind('address', $data['address']);
    $this->db->bind('id', $data['id']);

    $this->db->execute();
    return $this->db->rowCount();
  }
}
