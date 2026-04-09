<?php
namespace App\Controller;

use App\Repository\UserRepository;

class AuthController extends Controller
{
    public function login()
    {
        if (isset($_POST['nickname']) && isset($_POST['password']))
        {
            $this->loginPost();
            return;
        }
        $this->render('auth/login');
    }

    public function loginPost()
    {
        $nickname = $_POST['nickname'] ?? '';
        $password = $_POST['password'] ?? '';
        $repo = new UserRepository();
        $user = $repo->findByNickname($nickname);

        if ($user && password_verify($password, $user->getPassword()))
        {
            $_SESSION['user'] = $user;
            header('Location: /');
            exit;
        }

        $error = 'Identifiants invalides';
        $this->render('auth/login', compact('error'));
    }

    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
