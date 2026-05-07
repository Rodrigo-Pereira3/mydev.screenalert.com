<?php

require __DIR__ . '/../dao/UserDAO.php';

class AuthController
{
    public function loginWeb()
    {
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($email) || empty($password)) {
            die("Email e password são obrigatórios");
        }

        $user = (new UserDAO())->findByEmail($email);

        // Utilizador não existe ou não é admin
        if (!$user) {
            die("Este user não existe ou não tem permissão de acesso");
        }

        // Verificar password contra o hash guardado na BD
        if (!password_verify($password, $user->getPasswordEmail())) {
            die("Email ou password incorretos");
        }

        // Login OK — guardar sessão e redirecionar
        session_start();
        $_SESSION['user_id']    = $user->getId();
        $_SESSION['user_name']  = $user->getNameUser();
        $_SESSION['is_admin']   = $user->getIsAdmin();

        header('Location: /dashboard');
        exit;
    }


    public function logout()
    {
        session_destroy();
        header("Location: /");
        exit;
    }
    
    /**public function validateSignup()
    {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');



        if ($username == '' || $email == '') {
            throw new Exception("Username e email são obrigatórios");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email inválido");
        }
        // Verificar se o email já existe
        $user = (new UserDAO())->findByEmail($email);
        if ($user) {
            throw new Exception("Já existe um usuário com esse email");
        }


        // Criar um utilizador em estado pendente
        $userDAO = new UserDAO();
        $userId = $userDAO->createPending($username, $email);

        //Enviar email de verificação
        $verDAO = new EmailVerificationDAO();

        $token = $verDAO->createForUser($userId, 300);

        // 3) baseUrl dinâmico (vhosts)
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $baseUrl = $scheme . '://' . $host;

        // 4) link para clicar no email
        $link = $baseUrl . "/verify-email?token=" . urlencode($token);

        // 5) envia email via Mailer (PHPMailer/Mailtrap)
        $subject = "Verifica o teu email (expira em 5 min)";
        $html = "
        <div style='font-family: Arial, sans-serif;'>
        <h2>Olá, " . htmlspecialchars($username) . "!</h2>
        <p>Para ativares a tua conta e definires a tua password, clica no link abaixo (válido por <b>5 minutos</b>):</p>
        <p><a href='{$link}'>{$link}</a></p>
        <p>Se o link expirar, faz signup novamente (ou pede reenvio do link).</p>
        </div>
        ";

        (new Mailer())->send($email, $subject, $html);

        // 6) redirect com toast
        $_SESSION['flash_success'] = "Conta criada. Enviámos um email para verificares (link expira em 5 min).";
        header("Location: /login");
        exit;
    }

    public function verifyEmailForm($token)
    {
        $token = $_GET['token'] ?? '';
        if (empty($token)) {
            header("Location: /bad-request");

            exit();
        }

        // Token válido

        $this->view('verify-email', ['token' => $token]);
    }**/
}