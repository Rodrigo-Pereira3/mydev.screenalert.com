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
        $usersCount = (new UserDAO())->getUsersCount();
        $pacientesCount = (new UserDAO())->getPacientesCount();
        $devicesCount = (new UserDAO())->getDevicesCount();
        $alertsCount = (new UserDAO())->getAlertsCount();
        $this->view('dashboard', [
            'userCount' => $usersCount,
            'pacientesCount' => $pacientesCount,
            'devicesCount' => $devicesCount,
            'alertsCount' => $alertsCount
        ]);
    }

    public function users()
    {
        $users = (new UserDAO())->getUsers();

        $this->view('users', ['users' => $users]);
    }

    public function getPacientes($userId)
    {
        $user = (new UserDAO())->findById($userId);
        $pacientes = (new UserDAO())->getPacientesByUserId($userId);

        $this->view('pacientes', [
            'user' => $user,
            'pacientes' => $pacientes
        ]);
    }

    public function getUser($userId)
    {
        $user = (new UserDAO())->findById($userId);

        $cuidador = $user->getIdCuidador() ? (new UserDAO())->findById($user->getIdCuidador()) : null;

        var_dump($cuidador);
    }

    public function messages()
    {
        $user = (new UserDAO())->getMessages();
        $this->view('messages', [
            'messages' => $user
        ]);
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
