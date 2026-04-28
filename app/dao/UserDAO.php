<?php

require_once __DIR__ . '/../config/DataBase.php';
require_once __DIR__ . '/../models/User.php';

class UserDAO {
    private $conn;

    public function __construct() {
        // Conectar á base de dados
        $this->conn = (new DataBase())->connect();
    }

    public function findByEmail($email) {
        // Lógica para encontrar um utilizador pelo email
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        // Preparar e executar a query usando PDO
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':email', $email);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        var_dump($row);

        if($row) {
            $user = new User(
            $row['id'],
            $row['username'],
            $row['email'],
            $row['created_at'],
            $row['updated_at'],
            $row['deleted_at']
        );
            var_dump($user);
            return $row; // Retorna os dados do utilizador
        } else {
            return null; // Utilizador não encontrado
        }
    }
}