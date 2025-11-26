<?php
class UsersController extends ApplicationController {
    public function indexAction() {
        if (session_start() === PHP_SESSION_NONE) {
            session_start();
        }
        $userId = $_SESSION['user_id'] ?? null;
        
        $userModel = new User();
        $this->view->users = $userModel->getAll();

        if ($userId) {
            $this->view->user = $userModel->getById($userId);
        } else {
            $this->view->user = null;
        }
    }
    public function createAction() {

    }
    public function storeAction() {
        if($_SERVER['REQUEST_METHOD']!=='POST') {
            throw new Exception("Method not allowed");
        }

        $name=trim($_POST['user_name']??'');
        $surname=trim($_POST['user_surname']??'');
        $username=trim($_POST['user_username']??'');
        $email=trim($_POST['user_email']??'');
        $password=trim($_POST['user_password']??'');

        if($name === '' || $surname === '' || $username === '' || $email === '' || $password === '') {
            header('Location: ' . WEB_ROOT . '/users/register');
            exit;
        }

        $userModel = new User();
        $userModel -> insertUser($name, $surname, $username, $email, $password);

        header('Location: ' . WEB_ROOT . '/users');
        exit;
    }
    public function editAction() {
        $id = $this->_getParam('id');

        if(!$id) {
            throw new Exception("ID not provided");
        }

        $userModel = new User();
        $user = $userModel->getById($id);

        if(!$user) {
            throw new Exception("User not found");
        }

        $this->view->user = $user;
    }
    public function updateAction() {
        $id = $this->_getParam('id');

        if($_SERVER['REQUEST_METHOD']!=='POST') {
            throw new Exception("Method not allowed");
        }

        $name=trim($_POST['user_name']??'');
        $surname=trim($_POST['user_surname']??'');
        $username=trim($_POST['user_username']??'');
        $email=trim($_POST['user_email']??'');
        $password=trim($_POST['user_password']??'');

        if($name === '') {
            header("Location: " . WEB_ROOT . "/users/edit/$id");
            exit;
        }

        $model = new User();
        $model->updateUser($id, $name, $surname, $username, $email, $password);

        header("Location: " . WEB_ROOT . "/users");
        exit;
    }
    public function deleteAction() {
        $id = $this->_getParam('id');

        if(!$id) {
            throw new Exception("ID not provided");
        }

        $model = new User();
        $model->deleteUser($id);

        header("Location: " . WEB_ROOT . "/users");
        exit;
    }

    public function loginAction() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['user_username'] ?? '');
            $password = trim($_POST['user_password'] ?? '');

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
            $_SESSION['user_username'] = $user->user_username;

            header("Location: " . WEB_ROOT . "/users/profile");
            exit;
        }
    }
    
    public function registerAction() {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $name = trim($_POST['user_name'] ?? '');
        $surname = trim($_POST['user_surname'] ?? '');
        $username = trim($_POST['user_username'] ?? '');
        $email = trim($_POST['user_email'] ?? '');
        $password = trim($_POST['user_password'] ?? '');

        if ($name === '' || $surname === '' || $username === '' || $email === '' || $password === '') {
            header("Location: " . WEB_ROOT . "/users/register");
            exit;
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $model = new User();
        $userId = $model->insertUser($name, $surname, $username, $email, $passwordHash);

        if (session_start() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['user_id'] = $userId;
        $_SESSION['user_username'] = $username;

        header("Location: " . WEB_ROOT . "/users/index");
        exit;
    }

    public function profileAction() {
        $this->view->setLayout('layout'); //'main'

        $userModel = new User();
        $this->view->users = $userModel->getAll();
    }

    public function logoutAction() {
        session_start();

        $_SESSION = [];
        session_destroy();

        header("Location: " . WEB_ROOT . "/users/login");
        exit;
    }
}