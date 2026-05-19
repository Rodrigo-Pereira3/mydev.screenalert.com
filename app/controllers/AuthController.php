<?php

require __DIR__ . '/../dao/UserDAO.php';
require_once __DIR__ . "/../config/DatabaseSingle.php";


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
        if (password_verify($password, $user->getPasswordEmail())) {
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

    public function signupApi() {
        
       die("ggggggg");

    }


}