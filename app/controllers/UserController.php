<?php

require_once __DIR__ . "/../dao/UserDAO.php";
require_once __DIR__ . "/../config/jwt.php";
require_once __DIR__ . "../config/DatabaseSingle.php";

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
    $pdo = DatabaseSingle::connect();

    $pdo->beginTransaction();
    try {
      $data = json_decode(file_get_contents('php://input'), true);

      $nameUser = $data['name_user'] ?? null;
      $email = $data['email'] ?? null;

      if (!$nameUser || !$email) {
        throw new Exception("Os campos 'name_user' e 'email' são obrigatórios.");
      }

      (new UserDao())->updateProfile($userId, $nameUser, $email);
      
      $pdo->commit();

      $dataResponse = [
        'success' => true,
        'message' => "Perfil atualizado com sucesso",
        'data' => null
      ];

      Utils::jsonResponse($dataResponse);
      exit;

    } catch (Exception $e) {

      $pdo->rollBack();

      Utils::jsonResponse([
        'success' => false,
        'message' => $e->getMessage(),
        'data' => null
      ], 400);
      exit;
    }
  }
}