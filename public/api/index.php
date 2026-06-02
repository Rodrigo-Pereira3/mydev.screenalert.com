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
  //var_dump($tokenDecoded);

  (new UserController())->listProfileApi($tokenDecoded->data->id);

} elseif ($uri === '/cuidador/pacientes' && $method === 'GET') {

  $tokenDecoded = AuthController::requireAuth();

  (new PacienteController())->getPacientesApi($tokenDecoded->data->id);
  
} elseif ($uri === '/paciente/add' && $method === 'POST') {
    AuthMiddleware::check();
    $tokenDecoded = AuthController::requireAuth();
    
    (new PacienteController())->addPacienteApi($tokenDecoded);

  
}  

elseif ($uri === '/cuidador/pacientes/(+d)' && $method === 'GET') {
// pagina details do paciente por id
  $tokenDecoded = AuthController::requireAuth();
  (new PacienteController())->getPacienteHome($tokenDecoded->data->id, $uri);
  
}

elseif (preg_match('/\/cuidador\/pacientes\/(\d+)\/gerirHorario/', $uri, $m) && $method === 'GET') {
  $id = (int)$m[1];
  $tokenDecoded = AuthController::requireAuth();
  (new PacienteController())->gerirHorario($tokenDecoded->data->id, $m[1]);
}

elseif (preg_match('/\/cuidador\/pacientes\/(\d+)\/enviarMensagens/', $uri, $m) && $method === 'POST') {
  $id = (int)$m[1];
  $tokenDecoded = AuthController::requireAuth();
  (new PacienteController())->enviarMensagens($tokenDecoded, $id);
}

elseif (preg_match('/\/cuidador\/pacientes\/(\d+)\/historicoMensagens/', $uri, $m) && $method === 'GET') {
  $id = (int)$m[1];
  $tokenDecoded = AuthController::requireAuth();
  (new PacienteController())->historicoMensagens($tokenDecoded, $id);
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