<?php

require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Message.php';
require_once __DIR__ . '/../models/Device.php';

class UserDAO
{
    private $conn;

    public function __construct()
    {
        // Conectar á base de dados
        $this->conn = (new DataBase())->connect();
    }

    public function findByEmail(string $email): ?User
    {
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

    public function userCount(string $email): int
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email AND is_admin = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return (int) $stmt->fetchColumn();

    }

    public function getUsers(): array
    {
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

    public function getPacientesByCuidadorId($userId): array
    {
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

    public function findById(string $id): ?User
    {
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


    public function getUsersCount(): int
    {
        $sql = "SELECT COUNT(*) FROM users
                WHERE is_admin = 0 AND id_cuidador IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function getPacientesCount(): int
    {
        $sql = "SELECT COUNT(*) FROM users
                WHERE is_admin = 0 AND id_cuidador IS NOT NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function getDevicesCount(): int
    {
        $sql = "SELECT COUNT(*) FROM screen_alert_displays";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function getAlertsCount(): int
    {
        $sql = "SELECT COUNT(*) FROM alerts";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function getMessages(): array
{
    $sql = "SELECT 
        m.id AS id_message,
        m.id_user AS id_paciente,
        m.Status AS status,
        m.sent_at AS data_enviada,
        m.text_message AS texto_mensagem,
        u.name_user AS nome_paciente
    FROM messages m
    INNER JOIN users u ON m.id_user = u.id
    WHERE u.id_cuidador IS NOT NULL";
    
    $stmt = $this->conn->query($sql);
    $messages = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $messages[] = new Message(
            $row['id_message'],
            $row['id_paciente'],
            $row['status'],
            $row['data_enviada'],
            $row['texto_mensagem'],
            $row['nome_paciente']   // novo campo
        );
    }

    return $messages;
}
    public function getDevices(): array
{
    $sql = "SELECT 
        d.id AS id_device,
        d.id_user AS id_paciente,
        d.token_device AS token
    FROM screen_alert_displays d
    INNER JOIN users u ON d.id_user = u.id
    WHERE u.id_cuidador IS NOT NULL";
    
    $stmt = $this->conn->query($sql);
    $devices = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $devices[] = new Device(
            $row['id_device'],
            $row['id_paciente'],
            $row['token']
        );
    }

    return $devices;
}

}
