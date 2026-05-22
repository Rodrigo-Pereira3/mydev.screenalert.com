<?php

require_once __DIR__ . "/../config/DatabaseSingle.php";

class EmailVerificationDAO
{
  private $conn;

  public function __construct()
  {
    $this->conn = DatabaseSingle::connect();
  }


  public function createForUser(int $userId, int $ttlSeconds = 300): string
  {
    $token = bin2hex(random_bytes(32));     
    $tokenHash = hash('sha256', $token);    

    $sql = "
      INSERT INTO email_verifications (id_user, token_hash, expires_at, used_at, created_at)
      VALUES (?, ?, DATE_ADD(NOW(), INTERVAL ? SECOND), NULL, NOW())
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$userId, $tokenHash, $ttlSeconds]);

    return $token;
  }

}