<?php

require_once __DIR__ . "/../dao/UserDAO.php";
require_once __DIR__ . "/../config/jwt.php";

use Firebase\JWT\JWT;

class PacienteController
{
    private function view(string $name, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        require __DIR__ . "/../../public/views/{$name}.php";
    }

    public function addPacienteApi(object $tokenDecoded): void
    {
        $pdo = DatabaseSingle::connect();
        $pdo->beginTransaction();

        try {
            $cuidadorId = (int) $tokenDecoded->data->id;


            $username = trim($_POST["username"] ?? '');
            $birth_date = trim($_POST["birth_date"] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($username === '' || $birth_date === '' || $email === '' || $password === '') {
                throw new Exception("Todos os campos são obrigatórios.");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Email inválido.");
            }

            $userDAO = new UserDAO();

            if ($userDAO->findByEmailAPP($email)) {
                throw new Exception("Já existe uma conta com esse email.");
            }


            $userId = $userDAO->createPendingWithCuidador($username, $birth_date, $email, $password, $cuidadorId);


            $verifyDAO = new EmailVerificationDAO();
            $token = $verifyDAO->createForUser($userId, 600);

            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $baseUrl = $scheme . '://' . $host;
            $link = $baseUrl . "/verify-email?token=" . urlencode($token);

            $subject = "Verifica o teu email (expira em 5 min)";
            $html = "
            <div style='font-family: Arial, sans-serif;'>
                <h2>Olá, " . htmlspecialchars($username) . "!</h2>
                <p>Para ativares a tua conta e definires a tua password, clica no link abaixo (válido por <b>5 minutos</b>):</p>
                <p><a href='{$link}'>{$link}</a></p>
                <p>Se o link expirar, pede um novo.</p>
            </div>
        ";

            (new MyMailerService())->send($email, $subject, $html);

            $pdo->commit();

            Utils::jsonResponse([
                'success' => true,
                'message' => 'Paciente criado e associado com sucesso',
                'data' => [
                    'user' => [
                        'name' => $username,
                        'email' => $email,
                        'birthdate' => $birth_date
                    ]
                ]
            ], 201);

        } catch (Exception $e) {
            $pdo->rollBack();

            Utils::jsonResponse([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    public function getPacientesApi(int $userId): void
    {
        try {
            $user = (new UserDAO())->findById($userId);
            $pacientes = (new UserDAO())->getPacientesByCuidadorId($userId);


            $pacientesArray = [];
            foreach ($pacientes as $p) {
                $pacientesArray[] = $p->toArray();
            }

            $responseData = [
                'success' => true,
                'message' => 'Pacientes encontrados',
                'data' => [
                    'user' => [
                        'name' => $user->getNameUser(),
                        'email' => $user->getEmail(),
                        'birth_date' => $user->getBirthDate()
                    ],
                    'pacientes' => $pacientesArray
                ]
            ];


            Utils::jsonResponse($responseData, 200);

        } catch (Exception $e) {


            $responseData = [
                'success' => false,
                'message' => 'Erro ao carregar pacientes. ' . $e->getMessage(),
                'data' => [],
            ];

            Utils::jsonResponse($responseData, 400);
        }
    }

    public function getPacienteHome($cuidadorId, int $pacienteId): void
    {
        try {
            $paciente = (new UserDAO())->getPacienteById($cuidadorId, $pacienteId);

            if (!$paciente) {
                Utils::jsonResponse([
                    'success' => false, 
                    'message' => 'Paciente não encontrado.', 
                    'data' => []
                ], 404);
                return;
            }

            if (!$paciente->getIsVerified()) {
                Utils::jsonResponse([
                    'success' => false, 
                    'message' => 'Paciente ainda não verificou o email.', 
                    'data' => []
                ], 403);
                return;
            }

            Utils::jsonResponse([
                'success' => true,
                'message' => 'Paciente encontrado',
                'data' => $paciente->toArray()
            ], 200);

        } catch (Exception $e) {
            Utils::jsonResponse(['success' => false, 'message' => 'Erro ao carregar paciente', 'data' => []], 400);
        }
    }

    public function enviarMensagens(object $tokenDecoded, int $id): void
    {
        $pdo = DatabaseSingle::connect();
        $pdo->beginTransaction();

        try {
            $cuidadorId = (int) $tokenDecoded->data->id;
            $pacienteId = $id;

            $text = trim($_POST["text"] ?? '');

            if ($text === '') {
                throw new Exception("Não é possível enviar uma mensagem vazia.");
            }

            $userDAO = new UserDAO();

            $paciente = $userDAO->findById($pacienteId);

            if (!$paciente) {
                throw new Exception("Paciente não encontrado.");
            }

            if ($paciente->getIdCuidador() !== $cuidadorId) {
                throw new Exception("Sem permissão para enviar mensagem a este paciente.");
            }

            if (!$paciente->getIsVerified()) {
                throw new Exception("Paciente ainda não verificou o email. Não é possível enviar mensagens.");
            }

            $userDAO->enviarMensagem($text, $pacienteId);

            $pdo->commit();

            Utils::jsonResponse([
                'success' => true,
                'message' => 'Mensagem enviada com sucesso',
                'data' => [
                    'user' => [
                        'name' => $paciente->getNameUser(),
                        'email' => $paciente->getEmail(),
                        'is_admin' => $paciente->getIsAdmin(),
                        'is_verified' => $paciente->getIsVerified()
                    ]
                ]
            ], 201);

        } catch (Exception $e) {
            $pdo->rollBack();

            Utils::jsonResponse([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    public function historicoMensagens(object $tokenDecoded, int $id): void
    {
        try {
            $cuidadorId = (int) $tokenDecoded->data->id;
            $pacienteId = $id;

            $userDAO = new UserDAO();
            $paciente = $userDAO->findById($pacienteId);

            if (!$paciente) {
                throw new Exception("Paciente não encontrado.");
            }

            if ($paciente->getIdCuidador() !== $cuidadorId) {
                throw new Exception("Sem permissão para acessar mensagens deste paciente.");
            }

            if (!$paciente->getIsVerified()) {
                throw new Exception("Paciente ainda não verificou o email. Não é possível acessar mensagens.");
            }

            $historicoMensagens = $userDAO->getMensagensByPacienteId($pacienteId);

            $mensagensArray = [];
            foreach ($historicoMensagens as $m) {
                $mensagensArray[] = $m->toArray();
            }

            $responseData = [
                'success' => true,
                'message' => 'Mensagens encontradas',
                'data' => [
                    'user' => [
                        'name' => $paciente->getNameUser(),
                        'email' => $paciente->getEmail(),
                        'birthdate' => $paciente->getBirthDate()
                    ],
                    'mensagens' => $mensagensArray
                ]
            ];


            Utils::jsonResponse($responseData, 200);

        } catch (Exception $e) {


            $responseData = [
                'success' => false,
                'message' => 'Erro ao carregar mensagens: ' . $e->getMessage(),
                'data' => [],
            ];

            Utils::jsonResponse($responseData, 400);
        }
    }

    public function gerirHorario(object $tokenDecoded, int $id): void
    {
        $pdo = DatabaseSingle::connect();
        $pdo->beginTransaction();

        try {
            $cuidadorId = (int) $tokenDecoded->data->id;
            $pacienteId = $id;

            $body = json_decode(file_get_contents('php://input'), true);

            $name_medication = trim($body['name_medication'] ?? '');
            $description_medication = trim($body['description_medication'] ?? '');
            $days = $body['days'] ?? [];

            if ($name_medication === '') {
                throw new Exception("Nome do medicamento é obrigatório.");
            }

            if (empty($days)) {
                throw new Exception("Pelo menos um dia é obrigatório.");
            }

            $userDAO = new UserDAO();

            $paciente = $userDAO->findById($pacienteId);

            if (!$paciente) {
                throw new Exception("Paciente não encontrado.");
            }

            if ($paciente->getIdCuidador() !== $cuidadorId) {
                throw new Exception("Sem permissão para gerir horário deste paciente.");
            }

            if (!$paciente->getIsVerified()) {
                throw new Exception("Paciente ainda não verificou o email.");
            }

            $scheduleId = $userDAO->insertScheduleMedication($pacienteId, $name_medication, $description_medication);

            foreach ($days as $day) {
                $day_of_week = (int) ($day['day_of_week'] ?? 0);
                $doce = (int) ($day['doce'] ?? 0);

                $userDAO->insertDayForMedication($scheduleId, $day_of_week, $doce);
            }

            $pdo->commit();

            Utils::jsonResponse([
                'success' => true,
                'message' => 'Horário criado com sucesso',
                'data' => []
            ], 201);

        } catch (Exception $e) {
            $pdo->rollBack();

            Utils::jsonResponse([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

    public function temperaturas(object $tokenDecoded, int $id): void
    {
        try {
            $cuidadorId = (int) $tokenDecoded->data->id;
            $pacienteId = $id;


            $userDAO = new UserDAO();

            $paciente = $userDAO->findById($pacienteId);

            if (!$paciente) {
                throw new Exception("Paciente não encontrado.");
            }

            if ($paciente->getIdCuidador() !== $cuidadorId) {
                throw new Exception("Sem permissão para gerir horário deste paciente.");
            }

            if (!$paciente->getIsVerified()) {
                throw new Exception("Paciente ainda não verificou o email.");
            }

            $temperatures = $userDAO->getTemperatures($pacienteId);

            $data = [];

            foreach ($temperatures as $temperature) {
                $data[] = [
                    'temperature' => $temperature->getTemperature(),
                    'time' => $temperature->getTemperatureTime()
                ];
            }

            Utils::jsonResponse([
                'success' => true,
                'message' => 'Temperaturas obtidas com sucesso',
                'data' => $data
            ], 200);

        } catch (Exception $e) {

            Utils::jsonResponse([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], 400);
        }
    }

}