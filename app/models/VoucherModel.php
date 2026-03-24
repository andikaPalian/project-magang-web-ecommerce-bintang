<?php

declare(strict_types=1);
class VoucherModel
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllVouchers(): array
  {
    $this->db->query("SELECT * FROM vouchers ORDER BY valid_until ASC");

    return $this->db->resultSet();
  }

  public function getVoucherById(int $voucher_id): array|false
  {
    $this->db->query("SELECT * FROM vouchers WHERE id = :voucher_id");
    $this->db->bind('voucher_id', $voucher_id);

    return $this->db->single();
  }

  public function getVoucherByCode(string $code_voucher): array|false
  {
    $this->db->query("SELECT * FROM vouchers WHERE code = :code_voucher");
    $this->db->bind('code_voucher', $code_voucher);

    return $this->db->single();
  }

  public function addVoucher(array $data): int
  {
    $this->db->query("INSERT INTO vouchers (code, discount_amount, discount_type, min_purchase, valid_until, is_active) VALUES (:code, :discount_amount, :discount_type, :min_purchase, :valid_until, :is_active)");

    $this->db->bind('code', strtoupper($data['code']));
    $this->db->bind('discount_amount', $data['discount_amount']);
    $this->db->bind('discount_type', $data['discount_type']);
    $this->db->bind('min_purchase', $data['min_purchase']);
    $this->db->bind('valid_until', $data['valid_until']);
    $this->db->bind('is_active', $data['is_active'] ?? 1);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function updateVoucher(array $data, int $voucher_id): int
  {
    $this->db->query("UPDATE vouchers SET code = :code, discount_amount = :discount_amount, discount_type = :discount_type, min_purchase = :min_purchase, valid_until = :valid_until, is_active = :is_active WHERE id = :voucher_id");

    $this->db->bind('code', strtoupper($data['code']));
    $this->db->bind('discount_amount', $data['discount_amount']);
    $this->db->bind('discount_type', $data['discount_type']);
    $this->db->bind('min_purchase', $data['min_purchase']);
    $this->db->bind('valid_until', $data['valid_until']);
    $this->db->bind('is_active', $data['is_active'] ?? 1);
    $this->db->bind('voucher_id', $voucher_id);

    $this->db->execute();

    return $this->db->rowCount();
  }

  public function deleteVoucher(int $voucher_id): int
  {
    $this->db->query("DELETE FROM vouchers WHERE id = :voucher_id");
    $this->db->bind('voucher_id', $voucher_id);

    $this->db->execute();

    return $this->db->rowCount();
  }
}
