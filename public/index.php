<?php
session_start();
require "../app/controllers/WebController.php";
require "../app/controllers/AuthController.php"; // <- faltava isto

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/' || $uri === '/index' || $uri === '/home') {
    (new WebController())->index();

} elseif ($uri === '/login' && $method === 'GET') {
    (new WebController())->login();

} elseif ($uri === '/login' && $method === 'POST') {
    (new AuthController())->loginWeb();

} elseif ($uri === '/dashboard' && $method === 'GET') {
    (new WebController())->dashboard();

} elseif ($uri === '/users' && $method === 'GET') {
    (new WebController())->users();

} elseif ($uri === '/patients' && $method === 'GET') {
    (new WebController())->patients();

} elseif ($uri === '/messages' && $method === 'GET') {
    (new WebController())->messages();

} elseif ($uri === '/devices' && $method === 'GET') {
    (new WebController())->devices();

} elseif ($uri === '/logout' && $method === 'POST') {
    (new AuthController())->logoutWeb();

} else {
    echo "Página não encontrada";
}