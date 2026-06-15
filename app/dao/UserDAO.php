<?php

require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Message.php';
require_once __DIR__ . '/../models/Device.php';
require_once __DIR__ . '/../models/Temperature.php';

class UserDAO
{
    private $conn;

    public function __construct()
    {
        $this->conn = (new DataBase())->connect();
    }

    public function findByEmail(string $email): ?User
    {
        $sql = "SELECT id, id_cuidador, is_admin, name_user, birth_date, email, password, status, is_verified, verified_at, created_at, deleted_at, updated_at
        FROM users 
        WHERE email = :email AND is_admin = 1 LIMIT 1";
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
                $row['password'],
                $row['status'],
                $row['is_verified'],
                $row['verified_at'] ?? '',
                $row['created_at'],
                $row['deleted_at'] ?? '',
                $row['updated_at'] ?? ''
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
                $row['password'],
                $row['status'],
                $row['is_verified'],
                $row['verified_at'] ?? '',
                $row['created_at'],
                $row['deleted_at'] ?? '',
                $row['updated_at'] ?? ''
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
                $row['password'],
                $row['status'],
                $row['is_verified'],
                $row['verified_at'] ?? '',
                $row['created_at'],
                $row['deleted_at'] ?? '',
                $row['updated_at'] ?? ''
            );
        }

        return $users;
    }

    public function findById(int $id): ?User
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
                $row['password'],
                $row['status'],
                $row['is_verified'],
                $row['verified_at'] ?? '',
                $row['created_at'],
                $row['deleted_at'] ?? '',
                $row['updated_at'] ?? ''
            );
        }

        return null;
    }

    public function getUsersCount(): int
    {
        $sql = "SELECT COUNT(*) FROM users WHERE is_admin = 0 AND id_cuidador IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function getPacientesCount(): int
    {
        $sql = "SELECT COUNT(*) FROM users WHERE is_admin = 0 AND id_cuidador IS NOT NULL";
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

    public function getTempCount(): int
    {
        $sql = "SELECT COUNT(*) FROM temperature";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return (int) $stmt->fetchColumn();
    }

    public function getMessages(): array
    {
        $sql = "SELECT 
        m.id AS id_message,
        m.id_user AS id_user,
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
                $row['id_user'],
                $row['data_enviada'],
                $row['texto_mensagem'],
                $row['nome_paciente']
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

    public function findByEmailAPP(string $email): ?User
    {
        $sql = "SELECT id, id_cuidador, is_admin, name_user, birth_date, email, password, status, is_verified, verified_at, created_at, deleted_at, updated_at
        FROM users 
        WHERE email = :email AND is_admin = 0 LIMIT 1";
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
                $row['password'],
                $row['status'],
                $row['is_verified'] ?? false,
                $row['verified_at'] ?? '',
                $row['created_at'],
                $row['deleted_at'] ?? '',
                $row['updated_at'] ?? ''
            );
        }

        return null;
    }

    public function createPending(string $username, string $birth_date, string $email, string $password): int
    {
        $sql = "INSERT INTO users (id_cuidador, is_admin, name_user, birth_date, email, password, status, is_verified, verified_at, created_at, deleted_at, updated_at)
        VALUES (NULL, 0, ?, ?, ?, ?, 'Active', 0, NULL, NOW(), NULL, NULL)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username, $birth_date, $email, $password]);

        return (int) $this->conn->lastInsertId();
    }

    public function setPasswordAndVerify(int $userId, string $hashedPassword): void
    {
        $sql = "UPDATE users SET password = ?, is_verified = 1, verified_at = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$hashedPassword, $userId]);
    }

    public function createPendingWithCuidador(
        string $username,
        string $birth_date,
        string $email,
        string $password,
        int $cuidadorId
    ): int {
        $sql = "INSERT INTO users (id_cuidador, is_admin, name_user, birth_date, email, password, status, is_verified, verified_at, created_at, deleted_at, updated_at)
        VALUES (?, 0, ?, ?, ?, ?, 'Active', 0, NULL, NOW(), NULL, NULL)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$cuidadorId, $username, $birth_date, $email, $password]);

        return (int) $this->conn->lastInsertId();
    }

    public function updateProfileById(int $id, string $username, string $email, ?string $password = null): ?User
    {
        if ($password !== null && $password !== "") {
            $sql = "UPDATE users SET name_user = ?, email = ?, password = ?, updated_at = NOW() WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$username, $email, $password, $id]);
        } else {
            $sql = "UPDATE users SET name_user = ?, email = ?, updated_at = NOW() WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$username, $email, $id]);
        }

        return $this->findById($id);
    }

    public function getPacienteById(int $cuidadorId, int $pacienteId): ?User
    {
        $sql = "SELECT * FROM users WHERE id = :paciente_id AND id_cuidador = :cuidador_id AND deleted_at IS NULL";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':paciente_id', $pacienteId);
        $stmt->bindParam(':cuidador_id', $cuidadorId);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row)
            return null;

        return new User(
            $row['id'],
            $row['id_cuidador'],
            $row['is_admin'],
            $row['name_user'],
            $row['birth_date'],
            $row['email'],
            $row['password'],
            $row['status'],
            $row['is_verified'],
            $row['verified_at'] ?? '',
            $row['created_at'],
            $row['deleted_at'] ?? '',
            $row['updated_at'] ?? ''
        );
    }

    public function enviarMensagem(string $text, int $pacienteId): void
    {
        $sql = "INSERT INTO messages (id_user, sent_at, text_message) VALUES (?, NOW(), ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$pacienteId, $text]);
    }

    public function getMensagensByPacienteId(int $pacienteId): array
    {
        $sql = "SELECT m.id, m.id_user, m.sent_at, m.text_message, u.name_user AS nome_paciente
            FROM messages m
            INNER JOIN users u ON u.id = m.id_user
            WHERE m.id_user = ?
            ORDER BY m.sent_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$pacienteId]);
        $messages = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = new Message(
                $row['id'],
                $row['id_user'],
                $row['sent_at'],
                $row['text_message'],
                $row['nome_paciente']
            );
        }

        return $messages;
    }

    public function getHorarioByPacienteId(int $pacienteId): array
    {
        $sql = "SELECT id, name_medication, description_medication 
                FROM schedule_medications 
                WHERE id_user = ? 
                ORDER BY id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$pacienteId]);
        $schedules = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($schedules as &$schedule) {
            $sql2 = "SELECT day_of_doce, doce FROM day_for_medications WHERE id_schedule_medication = ?";
            $stmt2 = $this->conn->prepare($sql2);
            $stmt2->execute([$schedule['id']]);
            $schedule['days'] = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        }

        return $schedules;
    }

    public function insertScheduleMedication(int $userId, string $name, string $description): int
    {
        $sql = "INSERT INTO schedule_medications (id_user, name_medication, description_medication) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$userId, $name, $description]);
        return (int) $this->conn->lastInsertId();
    }

    public function insertDayForMedication(int $scheduleId, int $dayOfWeek, int $doce): void
    {
        $sql = "INSERT INTO day_for_medications (id_schedule_medication, day_of_doce, doce) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$scheduleId, $dayOfWeek, $doce]);
    }

    public function getTemperatures(int $pacienteId): array
    {
        $sql = "SELECT id, id_user, temperature, temperature_time FROM temperatures WHERE id_user = ? ORDER BY temperature_time DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$pacienteId]);
        $temperatures = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $temperatures[] = new Temperature(
                $row['id'],
                $row['id_user'],
                $row['temperature'],
                $row['temperature_time']
            );
        }

        return $temperatures;
    }
}