<?php

require_once __DIR__ . "/../dao/UserDAO.php";
require_once __DIR__ . "/../config/jwt.php";
require_once __DIR__ . "/../config/DatabaseSingle.php";

use Firebase\JWT\JWT;

class UserController
{
  public function listProfileApi($userId)
  {
    try {
      $user = (new UserDao())->findById($userId);

      $dataResponse = [
        'success' => true,
        'message' => "Operação realizada com sucesso",
        'data' => [
          'user' => [
            'name_user' => $user->getNameUser(),
            'email' => $user->getEmail(),
            'created_at' => $user->getCreatedAt()
          ]
        ]
      ];

      Utils::jsonResponse($dataResponse);
      exit;

    } catch (Exception $e) {
      Utils::jsonResponse([
        'success' => false,
        'message' => $e->getMessage(),
        'data' => null
      ], 401);
      exit;
    }
  }

  public function updateProfileApi($userId)
  {
    try {
      $raw = file_get_contents("php://input");
      $data = json_decode($raw, true);

      if (!is_array($data)) {
        throw new Exception("JSON inválido");
      }

      $userDao = new UserDao();
      $user = $userDao->findById((int)$userId);

      if (!$user) {
        throw new Exception("Utilizador não encontrado");
      }

      $username = trim($data["username"] ?? $user->getNameUser());
      $email = trim($data["email"] ?? $user->getEmail());
      $password = trim($data["password"] ?? "");

      if ($email !== $user->getEmail()) {
        $existingUser = $userDao->findByEmailAPP($email);

        if ($existingUser && $existingUser->getId() !== $user->getId()) {
          throw new Exception("Esse email já está em uso");
        }
      }

      $hashedPassword = null;

      if ($password !== "") {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      }

      $updatedUser = $userDao->updateProfileById(
        (int)$userId,
        $username,
        $email,
        $hashedPassword
      );

      $dataResponse = [
        "success" => true,
        "message" => "Perfil atualizado com sucesso",
        "data" => [
          "user" => $updatedUser->toArray()
        ]
      ];

      Utils::jsonResponse($dataResponse);
      exit;
    } catch (Exception $e) {
      $dataResponse = [
        "success" => false,
        "message" => $e->getMessage(),
        "data" => []
      ];

      Utils::jsonResponse($dataResponse, 401);
      exit;
    }
  }
}