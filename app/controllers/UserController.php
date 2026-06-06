<?php

require_once __DIR__ . "/../dao/UserDAO.php";
require_once __DIR__ . "/../config/jwt.php";

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
}