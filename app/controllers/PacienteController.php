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

    public function getPacientesApi(int $userId): void
    {
        $pdo = DatabaseSingle::connect();

        $pdo->beginTransaction();
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
                        $user->getNameUser(),
                        $user->getEmail(),
                        $user->getBirthDate()
                    ],
                    'pacientes' => $pacientesArray
                ]
            ];

            $pdo->commit();
            Utils::jsonResponse($responseData, 200);

        } catch (Exception $e) {
            $pdo->rollBack();

            $responseData = [
                'success' => false,
                'message' => 'Erro ao carregar pacientes',
                'data' => [],
            ];

            Utils::jsonResponse($responseData, 400);
        }
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
                        $paciente->getNameUser(),
                        $paciente->getEmail(),
                        $paciente->getIsAdmin(),
                        $paciente->getIsVerified()

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

    public function gerirHorario(object $tokenDecoded, int $id): void
    {
        $pdo = DatabaseSingle::connect();
        $pdo->beginTransaction();

        try {
            $cuidadorId = (int) $tokenDecoded->data->id;
            $pacienteId = $id;

            $name = trim($_POST["name"] ?? '');

            if ($name === '') {
                throw new Exception("Nome do paciente é obrigatório.");
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

            $userDAO->enviarMensagem($name, $pacienteId);

            $pdo->commit();

            Utils::jsonResponse([
                'success' => true,
                'message' => 'Mensagem enviada com sucesso',
                'data' => [
                    'user' => [
                        $paciente->getNameUser(),
                        $paciente->getEmail(),
                        $paciente->getIsAdmin(),
                        $paciente->getIsVerified()

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
}