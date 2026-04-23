<?php
require "../app/controllers/WebController.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
 
// $uri = str_replace("mydevpiratas.com/public", "", $uri);
$method = $_SERVER['REQUEST_METHOD'];

if($uri === '/' || $uri === '/index' || $uri === '/home') {
    var_dump("Estou na home");
    (new WebController())->index();

} elseif($uri === '/about') {
    var_dump("Estou a tentar ver a página sobre");
    (new WebController())->about();

} elseif($uri === '/login' && $method === 'GET') {
    var_dump("Estou a tentar fazer login");
    (new WebController())->login();

} elseif($uri === '/login' && $method === 'POST') {
    var_dump("Estou a tentar validar o login");
    (new AuthController())->validateLogin();
    
} else {
    http_response_code(404);
    echo "Página não encontrada";
}