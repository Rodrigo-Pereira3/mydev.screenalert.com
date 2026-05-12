<?php
session_start();
require "../app/controllers/WebController.php";
require "../app/controllers/AuthController.php";
require "../app/middleware/AuthMiddlewareWeb.php"; // <- faltava isto

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];
$isLogin = AuthMiddlewareWeb::isLogin();

if ($uri === '/' || $uri === '/index' || $uri === '/home') {
    (new WebController())->index();

} elseif ($uri === '/login' && $method === 'GET') {
    (new WebController())->login();

} elseif ($uri === '/login' && $method === 'POST') {
    (new AuthController())->loginWeb();

} elseif ($uri === '/dashboard' && $method === 'GET') {
    //$isLogin = AuthMiddlewareWeb::isLogin();
    // Se utilizador não estiver logado, redirecionar para a página de login
    if (!$isLogin) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Não tem acesso a esta página. 
        Por favor, faça login primeiro.'
        ];
        header("Location: /login");
        exit;
    } else {
        (new WebController())->dashboard();
    }


} elseif ($uri === '/users' && $method === 'GET') {
    if (!$isLogin) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Não tem acesso a esta página. 
        Por favor, faça login primeiro.'
        ];  
        header("Location: /login");
        exit;
    } else {
        (new WebController())->users();
    }

} elseif (preg_match('/\/users\/(\d+)\/pacientes/', $uri, $matches) && $method === 'GET') {
    if (!$isLogin) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Não tem acesso a esta página. 
        Por favor, faça login primeiro.'
        ];  
        header("Location: /login");
        exit;
    } else {

        (new WebController())->getPacientes($matches[1]);
    }

} 

elseif (preg_match('/\/users\/(\d+)\/edit/', $uri, $matches) && $method === 'GET') {
    if (!$isLogin) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Não tem acesso a esta página. 
        Por favor, faça login primeiro.'
        ];  
        header("Location: /login");
        exit;
    } else {

        (new WebController())->getUser($matches[1]);
    }

} 





elseif ($uri === '/patients' && $method === 'GET') {
    if (!$isLogin) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Não tem acesso a esta página. 
        Por favor, faça login primeiro.'
        ];
        header("Location: /login");
        exit;
    } else {
        (new WebController())->patients();
    }

} elseif ($uri === '/messages' && $method === 'GET') {
    if (!$isLogin) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Não tem acesso a esta página. 
        Por favor, faça login primeiro.'
        ];
        header("Location: /login");
        exit;
    } else {
        (new WebController())->messages();
    }

} elseif ($uri === '/devices' && $method === 'GET') {
    if (!$isLogin) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Não tem acesso a esta página. 
        Por favor, faça login primeiro.'
        ];
        header("Location: /login");
        exit;
    } else {
        (new WebController())->devices();
    }

} elseif ($uri === '/create-employee' && $method === "GET") {
    if (!$isLogin) {
        $_SESSION['toast'] = [
            'type' => 'error',
            'message' => 'Não tem acesso a esta página. 
        Por favor, faça login primeiro.'
        ];
        header("Location: /login");
        exit;
    } else {
        (new WebController())->createEmployee();
    }


}elseif ($uri === '/logout' && $method === 'POST') {
    (new AuthController())->logoutWeb();

}



else {
    echo "Página não encontrada";
}