<?php
class TasksController extends ApplicationController {

    private function requireLogin() {

        if(session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if(!isset($_SESSION['user_id'])) {
            header("Location: ".WEB_ROOT."/users/login");
            exit;
        }
    }

    public function indexAction() {

        $this->requireLogin();
        $this->view->setLayout('layout');

        $tasksModel = new Task();
        $userModel = new User();
        $categoryModel = new Category();

        $tasks= $tasksModel->getAll();

        foreach($tasks as &$t) {
            $user = $userModel->getById($t->user);
            $t->user_name = $user ? $user->user_username : "Unknown";

            $names = [];
            if(!empty($t->categories) && is_array($t->categories)) {
                foreach($t->categories as $catId) {
                    $cat = $categoryModel->getById($catId);
                    if($cat) {
                        $names[] = $cat->category_name;
                    }
                }
            }

            $t->category_names = $names;
        }

        $this->view->tasks = $tasks;
    }

    public function createAction() {

        $this->requireLogin();
        $categoryModel = new Category();
        $this->view->categories = $categoryModel->getAll();
        $this->view->setLayout('layout');
    }

    public function storeAction() {

        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('Method not allowed');
        }

        $name = trim($_POST['task_name'] ?? '');
        $description = trim($_POST['task_description'] ?? '');
        $status = trim($_POST['status'] ?? '');
        $start = ($_POST['start_time'] ?? '');
        $end = ($_POST['end_time'] ?? '');
        $categories = $_POST['categories'] ?? [];
        $user = ($_POST['user'] ?? '');

        if ($name === '') {
            header("Location: " . WEB_ROOT . "/tasks/create");
            exit;
        }

        $model = new Task();
        $model->insertTask($name, $description, $status, $start, $end, $categories, $user);

        header("Location: " . WEB_ROOT . "/tasks");
        exit;
    }

    public function updateAction() {

        $this->requireLogin();

        $id = $this->_getParam('id');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception('Method not allowed');
        }

        $name = trim($_POST['task_name'] ?? '');
        $description = trim($_POST['task_description'] ?? '');
        $status = trim($_POST['status'] ?? '');
        $start = ($_POST['start_time'] ?? '');
        $end = ($_POST['end_time'] ?? '');
        $categories = $_POST['categories'] ?? [];
        $user = ($_POST['user'] ?? '');

        if ($name === '') {
            header("Location: " . WEB_ROOT . "/tasks/edit/$id");
            exit;
        }

        $model = new Task();
        $model->updateTask($id, $name, $description, $status, $start, $end, $categories, $user);

        header("Location: " . WEB_ROOT . "/tasks");
        exit;
    }

    public function deleteAction() {

        $this->requireLogin();

        $id = $this->_getParam('id');

        if (!$id) {
            throw new Exception("ID not provided");
        }

        $model = new Task();
        $model->deleteTask($id);

        header("Location: " . WEB_ROOT . "/tasks");
        exit;
    }

    public function editAction() {

        $this->requireLogin();

        $id = $this->_getParam('id');

        if (!$id) {
            throw new Exception("ID not provided");
        }

        $model = new Task();
        $task = $model->getById($id);

        if (!$task) {
            throw new Exception("Task not found");
        }

        $categoryModel = new Category();
        $this->view->categories = $categoryModel->getAll();
        $this->view->task = $task;
        $this->view->setLayout('layout');
    }
}
?>
