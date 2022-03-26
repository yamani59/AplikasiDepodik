<?php
class Database
{
  private $table;
  private $db;
  private $stmt;

  public function __construct(String $table)
  {
    $this->table = $table;
    try {
      $conn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
      $this->db = new PDO($conn, DB_USER, DB_PASS, [
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      ]);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public function query(String $query): object
  {
    $this->stmt = $this->db->prepare($query);
    return $this;
  }

  public function getTable(): string
  {
    return $this->table;
  }

  public function bind(String $param, String $value, String $type = null): object
  {
    switch ($type == null) {
      case is_int($value):
        $type = PDO::PARAM_INT;
        break;
      case is_bool($value):
        $type = PDO::PARAM_BOOL;
        break;
      case is_null($value):
        $type = PDO::PARAM_NULL;
        break;
      default:
        $type = PDO::PARAM_STR;
    }

    $this->stmt->bindValue($param, $value, $type);
    return $this;
  }

  public function resultSet(): array
  {
    $this->stmt->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function rowCount(): int
  {
    $this->stmt->execute();
    return $this->stmt->rowCount();
  }
}
