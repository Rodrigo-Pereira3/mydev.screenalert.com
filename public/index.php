<?php
require "../app/controllers/WebController.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// $uri = str_replace("mydevpiratas.com/public", "", $uri);
$method = $_SERVER['REQUEST_METHOD'];

if ($uri === '/' || $uri === '/index' || $uri === '/home') {

    (new WebController())->index();

} elseif ($uri === '/login' && $method === 'GET') {
    (new WebController())->login();

} elseif ($uri === '/dashboard' && $method === 'GET') {

    (new WebController())->dashboard();

} else {
    echo "Página não encontrada";
}