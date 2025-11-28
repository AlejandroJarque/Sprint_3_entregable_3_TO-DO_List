<?php
class UsersController extends ApplicationController {

    public function indexAction() {
        $this->ensureSession();

        $userId = $_SESSION['user_id'] ?? null;

        $userModel = new User();

        if(!$userId) {
            $this->view->user = $userModel->getById($userId);
        } else {
            $this->view->user = null;
        }
    }

    public function loginAction() {
        $this->ensureSession();

        if($_SERVER['REQUEST_METHOD']==='POST') {

            $username = trim($_POST['user_username'] ?? '');
            $password = trim($_POST['user_password'] ?? '');

            if($username === '' || $password === '') {
                $this->view->error = "All fields are required.";
                return;
            }

            $model = new User();
            $user = $model->getByUsername($username);

            if(!$user) {
                $this->view->error = "User does not exist.";
                return;
            }

            if(!password_verify($password, $user->user_password)) {
                $this->view->error = "Invalid password.";
                return;
            }

            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_username'] = $user->user_username;

            header("Location: ".WEB_ROOT. "/users/index");
            exit;
        }
    }

    public function registerAction() {
        $this->ensureSession();

        if($_SERVER['REQUEST_METHOD'] !=='POST') return;

        $name = trim($_POST['user_name'] ?? '');
        $surname = trim($_POST['user_surname'] ?? '');
        $username = trim($_POST['user_username'] ?? '');
        $email = trim($_POST['user_email'] ?? '');
        $password = trim($_POST['user_password'] ?? '');

        if($name === ''|| $surname === ''|| $username === ''|| $email === ''|| $password === '') {
            $this->view->errors = ["All fields are required."];
            return;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $model = new User();
        $userId = $model->insertUser($name, $surname, $username, $email, $passwordHash);

        if(!$userId) {
            header("Location: " . WEB_ROOT . "/users/register");
            exit;
        }

        $_SESSION['user_id'] = $userId;
        $_SESSION['user_username'] = $username;

        header("Location: ".WEB_ROOT."/users/index");
        exit;
    }

    public function logoutAction() {
        $this->ensureSession();

        $_SESSION = [];
        session_destroy();

        header("Location: " .WEB_ROOT. "/users/login");
        exit;
    }
}