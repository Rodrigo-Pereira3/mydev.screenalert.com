<?php

class WebController
{
    private function view($viewName)
    {
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
        session_start();

        if (empty($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $this->view('dashboard');
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
