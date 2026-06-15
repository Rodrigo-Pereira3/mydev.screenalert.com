<?php
class WebController
{
    private function view($viewName, $data = [])
    {
        extract($data, EXTR_SKIP);
        require_once __DIR__ . "/../../public/views/{$viewName}.php";
    }

    //Isso nos dirige para a página Home.
    public function index()
    {
        $this->view('home');
    }

    //Isso nos dirige para a página de Login.
    public function login()
    {
        $this->view('login');
    }

    //Isso nos dirige para a página de Dashboard e mostra os dados de contagem de users, pacientes, devices e alerts.
    public function dashboard()
    {
        $usersCount = (new UserDAO())->getUsersCount();
        $pacientesCount = (new UserDAO())->getPacientesCount();
        $devicesCount = (new UserDAO())->getDevicesCount();
        $tempCount = (new UserDAO())->getTempCount();
        $this->view('dashboard', [
            'userCount' => $usersCount,
            'pacientesCount' => $pacientesCount,
            'devicesCount' => $devicesCount,
            'tempCount' => $tempCount
        ]);
    }

    //Isso nos dirige para a página de Users e mostra a lista de users.
    public function users()
    {
        $users = (new UserDAO())->getUsers();

        $this->view('users', ['users' => $users]);
    }

    //Isso nos dirige para a página de Pacientes e mostra a lista de pacientes associados ao cuidador.
    public function getPacientes($userId)
    {
        $user = (new UserDAO())->findById($userId);
        $pacientes = (new UserDAO())->getPacientesByCuidadorId($userId);

        $this->view('pacientes', [
            'user' => $user,
            'pacientes' => $pacientes
        ]);
    }

    //Isso nos dirige para a página de Cuidador e mostra os dados do cuidador associado ao paciente.
    public function getCuidador($userId)
    {
        $user = (new UserDAO())->findById($userId);

        $cuidador = $user->getIdCuidador() ? (new UserDAO())->findById($user->getIdCuidador()) : null;

        $this->view('cuidador', [
            'user' => $user,
            'cuidador' => $cuidador
        ]);
    }

    public function messages()
    {
        $message = (new UserDAO())->getMessages();
        $this->view('messages', [
            'messages' => $message
        ]);
    }

    public function devices()
    {
        $devices = (new UserDAO())->getDevices();
        $this->view('devices', [
            'devices' => $devices
        ]);
    }

    public function signup()
    {
        $this->view('signup');
    }

    public function verifyEmail(string $token): void
    {
        $this->view("verify-email", ["token" => $token]);
    }
    
    public function badRequest()
    {
        http_response_code(400);
        echo "Bad Request: A requisição não pôde ser processada.";
    }
}
