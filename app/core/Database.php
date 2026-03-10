<?php

declare(strict_types=1);
class Database
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $pass = DB_PASS;
  private $db_name = DB_NAME;

  private PDO $dbh;
  private PDOStatement $stmt;

  public function __construct()
  {
    $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
    $options = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    try {
      $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
    } catch (PDOException $e) {
      // Jika masih development dan debugging gunakan ini
      die($e->getMessage());
      // Jika production gunakan ini
      // die('Koneksi Database gagal. Sialahkan cek konfigurasi anda.');
    }
  }

  public function query(string $sql): void
  {
    $this->stmt = $this->dbh->prepare($sql);
  }

  public function bind(string|int $param, mixed $value, ?int $type = null): void
  {
    if (is_null($type)) {
      $type = match (true) {
        is_int($value) => PDO::PARAM_INT,
        is_bool($value) => PDO::PARAM_BOOL,
        is_null($value) => PDO::PARAM_NULL,
        default => PDO::PARAM_STR
      };
    }
    $this->stmt->bindValue($param, $value, $type);
  }

  public function execute(): bool
  {
    return $this->stmt->execute();
  }

  public function resultSet(): array
  {
    $this->stmt->execute();
    return $this->stmt->fetchAll();
  }

  public function single(): array|false
  {
    $this->execute();
    return $this->stmt->fetch();
  }

  public function rowCount(): int
  {
    return $this->stmt->rowCount();
  }

  public function beginTransaction(): bool
  {
    return $this->dbh->beginTransaction();
  }

  public function commit(): bool
  {
    return $this->dbh->commit();
  }

  public function rollBack(): bool
  {
    return $this->dbh->rollBack();
  }

  public function lastInsertId(): string|false
  {
    return $this->dbh->lastInsertId();
  }
}
