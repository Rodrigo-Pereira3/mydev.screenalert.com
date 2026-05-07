<?php
class WebController
{
    private function view($viewName, $data = [])
    {
        extract($data, EXTR_SKIP);
        require_once __DIR__ . "/../../public/views/{$viewName}.php";
    }

    public function index()
    {
        $this->view('home');
    }

    public function login()
    {
        $this->view('login');
    }

    public function dashboard()
    {
        if (!isset($_SESSION['token'])) {
            header('Location: /login');
            exit;
        }

        $dados = [
            'users_count' => 42, // Exemplo de dado para o dashboard
            'patients_count' => 128, // Exemplo de dado para o dashboard
            'devices_count' => 256, // Exemplo de dado para o dashboard
            'alerts_count' => 64, // Exemplo de dado para o dashboard
        ];


        $this->view('dashboard', $dados);
    }

    public function users()
    {
        $this->view('users');
    }

    public function patients()
    {
        $this->view('patients');
    }

    public function messages()
    {
        $this->view('messages');
    }

    public function devices()
    {
        $this->view('devices');
    }

    public function signup()
    {
        $this->view('signup');
    }

    public function badRequest()
    {
        http_response_code(400);
        echo "Bad Request: A requisição não pôde ser processada.";
    }
}
