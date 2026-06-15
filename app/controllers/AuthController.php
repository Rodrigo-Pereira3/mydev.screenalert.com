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

    public static function requireAuth(): object
    {
        try {
            $headers = getallheaders();
            $authHeader = $headers['Authorization'] ?? $headers['authorization'] ?? null;

            if (!$authHeader) {
                throw new Exception("Token não enviado");
            }

            if (!preg_match('/Bearer\s+(\S+)/i', $authHeader, $matches)) {
                throw new Exception("Formato do token inválido");
            }

            $token = $matches[1];

            $decoded = JWT::decode(
                $token,
                new Key(JwtConfig::$secret, 'HS256')
            );

            return $decoded;

        } catch (ExpiredException $e) {
            $dataResponse = [
                'success' => false,
                'message' => "Token expirado" . $e->getMessage(),
                'data' => []
            ];

            Utils::jsonResponse($dataResponse, 401);

            exit;

        } catch (SignatureInvalidException $e) {
            $dataResponse = [
                'success' => false,
                'message' => "Assinatura do token inválida" . $e->getMessage(),
                'data' => []
            ];

            Utils::jsonResponse($dataResponse, 401);

            exit;

        } catch (BeforeValidException $e) {
            $dataResponse = [
                'success' => false,
                'message' => "Token ainda não é válido tem que validar o token." . $e->getMessage(),
                'data' => []
            ];

            Utils::jsonResponse($dataResponse, 401);

            exit;

        } catch (Exception $e) {
            $dataResponse = [
                'success' => false,
                'message' => "Assinatura do token inválida" . $e->getMessage(),
                'data' => []
            ];

            Utils::jsonResponse($dataResponse, 401);

            exit;
        }
    }
    //Este é o metodo que processa o login da nossa WEB.
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


    public function signupWeb()
    {
        /**
         * @TODO Validar se existe user logado
         */
        $username = trim($_POST['username']) ?? '';
        $email = trim($_POST['email']) ?? '';
        $password = trim($_POST['password']) ?? '';
        $birth_date = $_POST['birth_date'] ?? '';

        if ($username === '' || $email === '') {
            throw new Exception("Username e email são obrigatórios");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Dados inválidos");
        }

        // Verificar se email já existe
        $user = (new UserDAO())->findByEmail($email);

        var_dump($user);
        if ($user) {
            throw new Exception("Email já existe");
        }
        // User no estado pendente
        $userId = (new UserDAO())->createPending($username, $birth_date, $email, $password);

        // Criar token de verificação
        $verDAO = new EmailVerificationDAO();

        $token = $verDAO->createForUser($userId, 300);

        // 3) baseUrl dinâmico (vhosts)
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $baseUrl = $scheme . '://' . $host;

        // 6) redirect com toast
        $_SESSION['flash_success'] = "Conta criada. Enviámos um email para verificares (link expira em 5 min).";
        header("Location: /login");
        exit;

    }
    //Este é o metodo que processa o logout da nossa WEB.
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


    //Este é o metodo que processa o signup da nossa APP.
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


            $userId = $userDAO->createPending($username, $birth_date, $email, $password);

            $verifyDAO = new EmailVerificationDAO();
            $token = $verifyDAO->createForUser($userId, 600);

            $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $baseUrl = $scheme . '://' . $host;

            $link = $baseUrl . "/verify-email?token=" . urlencode($token);

           $subject = "Verifica o teu email (expira em 5 min)";

$html = '
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
</head>
<body style="margin:0; padding:0; background-color:#f5f5f7; font-family:Arial, Helvetica, sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f5f5f7; padding:40px 20px;">
<tr>
<td align="center">

<table width="600" cellpadding="0" cellspacing="0" border="0"
style="background-color:#ffffff; border-radius:20px; overflow:hidden;">

<tr>
<td align="center"
style="background:linear-gradient(135deg,#6C3BFF,#9B5CFF); padding:40px 20px;">
<h1 style="margin:0; color:#ffffff;">📺 Screen Alert!</h1>
<p style="margin-top:10px; color:#EDE8FF;">
Leve as suas mensagens para qualquer ecrã.
</p>
</td>
</tr>

<tr>
<td style="padding:45px 40px; text-align:center;">
<h2>Olá, '.htmlspecialchars($username).'!</h2>

<p style="color:#666666; font-size:16px;">
Obrigado por te juntares ao <strong>Screen Alert!</strong>.<br><br>
Para ativares a tua conta, clica no botão abaixo.
</p>

<table align="center" cellpadding="0" cellspacing="0" border="0" style="margin:35px auto;">
<tr>
<td align="center" style="background-color:#6C3BFF; border-radius:12px;">
<a href="'.$link.'"
style="display:inline-block; padding:16px 40px; color:#ffffff; text-decoration:none; font-weight:bold;">
Verificar Conta
</a>
</td>
</tr>
</table>

<p style="color:#888888; font-size:14px;">
Se o botão não funcionar:
</p>

<p>
<a href="'.$link.'" style="color:#FF5FA2;">
'.$link.'
</a>
</p>

<p style="color:#999999;">
Este link expira em <strong>5 minutos</strong>.
</p>

</td>
</tr>

<tr>
<td style="background-color:#fafafa; padding:30px; text-align:center;">
<p style="margin:0; color:#999999; font-size:13px;">
© '.date('Y').' Screen Alert! • Todos os direitos reservados.
</p>
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>';

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

    
    public function verifyEmailForm(): void
    {
        $token = $_GET['token'] ?? '';
        if ($token === '') {
            http_response_code(400);
            echo "Token em falta.";
            return;
        }

        (new WebController())->verifyEmail($token);
    }

    
    public function verifyEmailSubmit(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE)
            session_start();

        $token = (string) ($_POST['token'] ?? '');
        $password = (string) ($_POST['password'] ?? '');

        if ($token === '' || $password === '')
            throw new Exception("Token e password são obrigatórios.");
        if (strlen($password) < 6)
            throw new Exception("Password deve ter pelo menos 6 caracteres.");

        $verDao = new EmailVerificationDAO();
        $userId = $verDao->validate($token);

        if (!$userId) {
            throw new Exception("Link inválido ou expirado (5 min). Pede um novo.");
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $userDao = new UserDAO();
        $userDao->setPasswordAndVerify($userId, $hash);

        $verDao->markUsed($token);

        $_SESSION['flash_success'] = "Email verificado e password definida. Já podes fazer login.";
        header("Location: /sucesses");
        exit;
    }

    //Este é o metodo que processa o login da nossa APP.
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