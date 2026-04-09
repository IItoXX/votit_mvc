<?php
namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;

class UserController extends Controller
{
    public function register()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $nickname = $_POST['nickname'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $repo = new UserRepository();

            if ($repo->findByNickname($nickname))
            {
                $errors[] = "Nom d'utilisateur déjà pris";
            }
            if ($repo->findByEmail($email))
            {
                $errors[] = "Email déjà utilisé";
            }

            if (!empty($errors))
            {
                $this->render('user/register', ['errors' => $errors]);
                return;
            }

            $user = new User(null, $nickname, password_hash($password, PASSWORD_DEFAULT), $email);
            $repo->create($user);
            header('Location: /login');
            exit;
        }

        $this->render('user/register', ['errors' => $errors]);
    }
}
