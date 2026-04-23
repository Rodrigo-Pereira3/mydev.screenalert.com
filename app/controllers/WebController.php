<?php

class WebController {

    private function view($name) {
            require __DIR__ . '/../../public/views/' . $name . '.php';
    }

    public function index() {
        $this->view('home');
    }

    public function about() {
        $this->view('about');
    }

    public function login() {
        $this->view('login');
    }

    public function validateLogin() {
        $this->view('validateLogin');
    }

}
