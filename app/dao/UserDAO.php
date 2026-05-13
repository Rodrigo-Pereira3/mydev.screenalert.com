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

    public function getUsers(): array {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->query($sql);
        $users = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User(
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

        return $users;
    }

    public function getPacientesByUserId($userId): array {
        $sql = "SELECT * FROM users WHERE id_cuidador = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        $users = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User(
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
        
        return $users;
    }

    public function findById(string $id): ?User {
    $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':id', $id);
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


    public function getUsersCount(): int {
        $sql = "SELECT COUNT(*) FROM users
                WHERE is_admin = 0 AND id_cuidador IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function getPacientesCount(): int {
        $sql = "SELECT COUNT(*) FROM users
                WHERE is_admin = 0 AND id_cuidador IS NOT NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function getDevicesCount(): int {
        $sql = "SELECT COUNT(*) FROM screen_alert_displays";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function getAlertsCount(): int {
        $sql = "SELECT COUNT(*) FROM alerts";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

}
       