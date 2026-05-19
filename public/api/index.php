<?php
require __DIR__ . "/../../vendor/autoload.php";

require "../../app/controllers/AuthController.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header("Content-Type: application/json; charset=UTF-8");

$uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$uri = str_replace("/api", "", $uri);
$method = $_SERVER["REQUEST_METHOD"];


if (($uri === "/" || $uri === "/index") && $method === 'GET') {
  die('sdsdc');
}

elseif ($uri === "/signup" && $method === 'POST') {
  (new AuthController())->signupApi();
}

else {
  $dataResponse = [
    'success' => false,
    'message' => 'Not found.',
    'data'    => []
  ];

  Utils::jsonResponse($dataResponse, 401);

  exit;
}