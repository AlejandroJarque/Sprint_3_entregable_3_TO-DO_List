<?php
class UsersController extends ApplicationController {
    public function loginAction() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if($username === '' || $password === '') {
                $this->view->error = "You must fill in all fields.";
                return;
            }

            $model = new User();
            $user = $model->getByUsername($username);

            if (!$user) {
                $this->view->error = "User doesn't exist.";
                return;
            }
            if (!password_verify($password, $user->user_password)) {
                $this->view->error = "Incorrect password.";
                return;
            }

            session_start();
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->user_username;

            header("Location: " . WEB_ROOT . "/users/profile");
            exit;
        }
    }
    
    public function registerAction() {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception("Método no permitido");
        }

        $name = trim($_POST['user_name'] ?? '');
        $surname = trim($_POST['user_surname'] ?? '');
        $username = trim($_POST['user_username'] ?? '');
        $email = trim($_POST['user_email'] ?? '');
        $password = trim($_POST['user_password'] ?? '');

        if($name === '' || $surname === '' || $username === '' || $email === '' || $password === '') {
            header("Location: " . WEB_ROOT . "/users/register");
            exit;
        }
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $model = new User();
        $model ->insertUser($name, $surname, $username, $email, $passwordHash);

        header("Location: " . WEB_ROOT . "/users");
        exit;
    }

    public function profileAction() {
        $this->view->setLayout('main');

        $userModel = new User();
        $this->view->users = $userModel->getAll();
    }
}