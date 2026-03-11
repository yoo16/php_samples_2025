<?php

namespace App\Controllers;

use App\Models\AuthUser;
use App\Models\User;
use Lib\Request;

class LoginController
{
    public function index()
    {
        if (isset($_SESSION['signin'])) {
            unset($_SESSION['signin']);
        }
        header('Location: ' . BASE_URL . 'login/input');
        exit;
    }

    public function input()
    {
        $form  = $_SESSION['signin'] ?? null;
        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        Request::render('login/input', ['form' => $form, 'error' => $error]);
    }

    public function auth()
    {
        if (!Request::isPost()) {
            header('Location: ' . BASE_URL . 'login/input');
            exit;
        }

        $_SESSION['signin'] = $_POST;

        $account_name = $_POST['account_name'];
        $password     = $_POST['password'];

        $user      = new User();
        $auth_user = $user->auth($account_name, $password);

        if (empty($auth_user['id'])) {
            $_SESSION['error'] = 'アカウント名またはパスワードが間違っています。';
            header('Location: ' . BASE_URL . 'login/input');
            exit;
        }

        AuthUser::set($auth_user);
        header('Location: ' . BASE_URL . 'home/');
        exit;
    }
}
