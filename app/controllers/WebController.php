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
        $this->view('dashboard');
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
