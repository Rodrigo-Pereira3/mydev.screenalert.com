<?php

require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/User.php';

class UserDAO {
    private $conn;

    public function __construct() {
        // Conectar á base de dados
        $this->conn = (new DataBase())->connect();
    }

    public function findByEmail(string $email): ?User {
    $sql = "SELECT * FROM users WHERE email = :email AND is_admin = 1 LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
            return new User(
                $row['id'],
                $row['id_cuidador'],
                $row['is_admin'],
                $row['name_user'],
                $row['birth_date'],
                $row['email'],
                $row['password_email'],
                $row['status'],
                $row['created_at'],
                $row['last_updated']
            );
        }

        return null;
    }

    public function userCount(string $email): int {
    $sql = "SELECT COUNT(*) FROM users WHERE email = :email AND is_admin = 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    return (int) $stmt->fetchColumn();

    }

}