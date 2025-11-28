<?php
class UsersController extends ApplicationController {

    public function indexAction() {
        $this->ensureSession();

        $userId = $_SESSION['user_id'] ?? null;

        $userModel = new User();
        $user = $userModel->getById($_SESSION['user_id']);

        if(!$user) {
            header("Location: ".WEB_ROOT."/users/logaout");
            exit;
        }

        $this->view->user = $user;
        $this->view->setLayout('layout');
    }

    public function loginAction() {

        if(session_status()===PHP_SESSION_NONE) {
            session_start();
        }

        if(isset($_SESSION['user_id'])) {
            header("Location: ".WEB_ROOT."/users");
            exit;
        }

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

            header("Location: ".WEB_ROOT."/users");
            exit;
        }
        
        $this->view->setLayout('layout');
    }

    public function registerAction() {
        
        if(session_status()===PHP_SESSION_NONE) {
            session_start();
        }

        if(isset($_SESSION['user_id'])) {
            header("Location: ".WEB_ROOT."/users");
            exit;
        }

        if($_SERVER['REQUEST_METHOD'] !=='POST') {
            $this->view->setLayout('layout');
            return;
        }

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
            $this->view->errors = ["Unable to register user."];
            return;
        }

        $_SESSION['user_id'] = $userId;
        $_SESSION['user_username'] = $username;

        header("Location: ".WEB_ROOT."/users");
        exit;
    }

    public function logoutAction() {

        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();

        header("Location: ".WEB_ROOT."/users/login");
        exit;
    }
}