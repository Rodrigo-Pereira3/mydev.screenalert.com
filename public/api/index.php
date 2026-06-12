<?php
require __DIR__ . "/../../vendor/autoload.php";

require "../../app/controllers/AuthController.php";
require "../../app/controllers/WebController.php";
require "../../app/controllers/UserController.php";
require "../../app/controllers/PacienteController.php";
require "../../app/middleware/AuthMiddleware.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header("Content-Type: application/json; charset=UTF-8");

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri = str_replace("/api", "", $uri);
$method = $_SERVER["REQUEST_METHOD"];


if (($uri === "/" || $uri === "/index") && $method === 'GET') {

  die('sdsdc');

} elseif ($uri === "/signup" && $method === 'POST') {

  (new AuthController())->signupApi();

} elseif ($uri === "/login" && $method === 'POST') {

  (new AuthController())->loginApi();

} elseif ($uri === "/users/profile" && $method === 'GET') {

  $tokenDecoded = AuthController::requireAuth();

  (new UserController())->listProfileApi($tokenDecoded->data->id);

}elseif ($uri === "/users/profile/update" && $method === 'POST') {

  $tokenDecoded = AuthController::requireAuth();

  (new UserController())->updateProfileApi($tokenDecoded->data->id);

} elseif ($uri === '/paciente/add' && $method === 'POST') {

    $tokenDecoded = AuthController::requireAuth();
    
    (new PacienteController())->addPacienteApi($tokenDecoded);

} elseif ($uri === '/cuidador/pacientes' && $method === 'GET') {

  $tokenDecoded = AuthController::requireAuth();

  (new PacienteController())->getPacientesApi($tokenDecoded->data->id);
  
} elseif (preg_match('/\/cuidador\/paciente\/(\d+)$/', $uri, $m) && $method === 'GET') {

  $pacienteId = (int)$m[1];
  $tokenDecoded = AuthController::requireAuth();
  (new PacienteController())->getPacienteHome($tokenDecoded->data->id, $pacienteId);

  
} elseif (preg_match('/\/cuidador\/paciente\/(\d+)\/enviarMensagens/', $uri, $m) && $method === 'POST') {

  $id = (int)$m[1];

  $tokenDecoded = AuthController::requireAuth();
  (new PacienteController())->enviarMensagens($tokenDecoded, $id);
} elseif (preg_match('/\/cuidador\/paciente\/(\d+)\/historicoMensagens/', $uri, $m) && $method === 'GET') {

  $id = (int)$m[1];

  $tokenDecoded = AuthController::requireAuth();
  (new PacienteController())->historicoMensagens($tokenDecoded, $id);

}elseif (preg_match('/\/cuidador\/paciente\/(\d+)\/gerirHorario/', $uri, $m) && $method === 'POST') {

  $id = (int)$m[1];

  $tokenDecoded = AuthController::requireAuth();
  (new PacienteController())->gerirHorario($tokenDecoded, (int)$m[1]);
  
}elseif (preg_match('/\/cuidador\/paciente\/(\d+)\/gerirHorarioHistorico/', $uri, $m) && $method === 'GET') {

  $id = (int)$m[1];

  $tokenDecoded = AuthController::requireAuth();
  (new PacienteController())->gerirHorarioHistorico($tokenDecoded, (int)$m[1]);
  
}
  
elseif (preg_match('/\/cuidador\/paciente\/(\d+)\/temperatura/', $uri, $m) && $method === 'GET') {

  $id = (int)$m[1];

  $tokenDecoded = AuthController::requireAuth();
  (new PacienteController())->temperaturas($tokenDecoded, $id);
  
}

else {
  $dataResponse = [
    'success' => false,
    'message' => 'Not found.',
    'data' => []
  ];

  Utils::jsonResponse($dataResponse, 401);

  exit;
}