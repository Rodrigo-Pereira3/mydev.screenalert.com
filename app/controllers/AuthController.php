<?php

require_once __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . "/../config/DatabaseSingle.php";
require_once __DIR__ . "/../utils/Utils.php";
require_once __DIR__ . '/../dao/EmailVerificationDAO.php';
require_once __DIR__ . "/../services/MyMailerService.php";
require_once __DIR__ . "/../config/jwt.php";


use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;

class AuthController
{

    private function view($name, $data = [])
    {
        extract($data, EXTR_SKIP);

        require __DIR__ . '/../../public/views/' . $name . '.php';
    }

    public function loginWeb()
    {
        //var_dump("Estou no login a validar os dados");
        // Apanhar os dados do formulário
        $email = trim($_POST['email']) ?? '';

        $password = trim($_POST['password']) ?? '';

        // Se não houver email ou password, mostrar erro
        // é preciso lançar exceção para o index.php apanhar e mostrar o erro via flash message
        if (empty($email) || empty($password)) {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Email e password são OBRIGATÓRIOS!'
            ];
            header("Location: /login");
            exit;
        }

        $user = (new UserDAO())->findByEmail($email);
        // var_dump(password_verify($password, $user->getPasswordEmail()));

        if (!$user) {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => 'Email ou password inválidos ou não existe conta com esse email'
            ];
            header("Location: /login");
            exit;
        }


        // Utilizador foi encontrado - verificar password
        if (password_verify($password, $user->getPassword())) {
            //var_dump("Password correta");
            $_SESSION['token'] = [
                'id' => $user->getId(),
                'username' => $user->getNameUser(),
                'email' => $user->getEmail(),
                'is_admin' => $user->getIsAdmin()
            ];

            $_SESSION['toast'] = [
                'type' => 'success',
                'message' => "Bem-vindo de volta, " . $user->getNameUser() . "!"
            ];

            header("Location: /dashboard");
            exit;

        } else {
            $_SESSION['toast'] = [
                'type' => 'error',
                'message' => "Dados de login inválidos"
            ];
            header("Location: /login");
            exit;
        }

    }

    public function logoutWeb()
    {
        unset($_SESSION['token']);

        $_SESSION['toast'] = [
            'type' => 'success',
            'message' => 'Sessão terminada com sucesso.'
        ];

        header("Location: /");
        exit;
    }


    // APP
    public function signupApi()
    {
        $pdo = DatabaseSingle::connect();

        $pdo->beginTransaction();

        try {
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

            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $userId = $userDAO->createPending($username, $birth_date, $email, $passwordHash);

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
                    <p>Se o link expirar, faz signup novamente (ou pede reenvio do link).</p>
                </div>
                ";

            (new MyMailerService())->send($email, $subject, $html);

            $responseData = [
                'success' => true,
                'message' => 'Signup realizado com sucesso',
                'data' => [],
            ];

            $pdo->commit();

            Utils::jsonResponse($responseData, 200);
        } catch (Exception $e) {
            $pdo->rollBack();

            $responseData = [
                'success' => false,
                'message' => 'Erro no signup: ' . $e->getMessage(),
                'data' => [],
            ];

            Utils::jsonResponse($responseData, 400);
        }
    }

    public function loginApi()
    {
        $pdo = DatabaseSingle::connect();

        $pdo->beginTransaction();
        try {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if ($email === '' || $password === '') {
                throw new Exception("Todos os campos são obrigatórios.");
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("Email inválido.");
            }

            $user = (new UserDAO())->findByEmailAPP($email);

            if (!$user || !password_verify($password, $user->getPassword())) {
                echo json_encode(["error" => "login inválido"]);
                return;
            }

            $payload = [
                "iat" => time(),
                "exp" => time() + 3600,
                "data" => [
                    "id" => $user->getId(),
                    "role" => $user->getIsAdmin()
                ]
            ];

            $jwt = JWT::encode($payload, JwtConfig::$secret, 'HS256');

            $responseData = [
                'success' => true,
                'message' => 'Login realizado com sucesso',
                'data' => [
                    'user' => $user->toArray(),
                    'jwt' => $jwt
                ],
            ];

            $pdo->commit();

            Utils::jsonResponse($responseData, 200);

        } catch (Exception $e) {
            $pdo->rollBack();

            $responseData = [
                'success' => false,
                'message' => 'Erro no login: ' . $e->getMessage(),
                'data' => [],
            ];

            Utils::jsonResponse($responseData, 400);
        }


    }
}