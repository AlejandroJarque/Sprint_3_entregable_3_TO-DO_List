<?php
class TasksController extends ApplicationController {

    public function indexAction(){
       // $this->view->setLayout('layout');
       $tasksModel = new Task();
       $this->view->tasks = $tasksModel->getAll();

    }
    public function createAction(){


    }
    public function storeAction(){
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            throw new Exception('Metodo no permitido');

        }
        $name = trim($_POST['tasks_name'] ?? '');
        $description = trim($_POST['tasks_description'] ?? '');
        $status = trim($_POST['status'] ?? '');
        $start = ($_POST['start_time'] ?? '');
        $end = ($_POST['end_time'] ?? '');
        $categories = ($_POST['categories'] ?? '');
        $user = ($_POST['user'] ?? '');

        if($name === ''){
            header("Location: " . WEB_ROOT . "/tasks/create");
            exit;
        }
        $model = new Task();
        $model ->insertTask($name,$description,$status,$start,$end,$categories,$user);

        header("Location: " . WEB_ROOT . "/tasks");
        exit;

    }
    public function updateAction(){
        $id = $this->_getParam('id');
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            throw new Exception('Metodo no permitido');

        }
        $name = trim($_POST['tasks_name'] ?? '');
        $description = trim($_POST['tasks_description'] ?? '');
        $status = trim($_POST['status'] ?? '');
        $start = ($_POST['start_time'] ?? '');      
        $end = ($_POST['end_time'] ?? '');
        $categories = ($_POST['categories'] ?? '');
        $user = ($_POST['user'] ?? '');
    

        if($name === ''){
            header("Location: " . WEB_ROOT . "/tasks/edit/$id");
            exit;
        }
        $model = new Task();
        $model ->updateTask($id,$name,$description,$status,$start,$end,$categories,$user);

        header("Location: " . WEB_ROOT . "/tasks");
        exit;
    }

    public function deleteAction(){
        $id = $this->_getParam('id');
        if(!$id){
            throw new Exception("ID no proporcionado");
        }
        $model = new Task();
        $model ->deleteTask($id);

        header("Location: " . WEB_ROOT . "/tasks");
        exit;
    }
    
    public function editAction(){
        $id = $this->_getParam('id');
        if(!$id){
            throw new Exception("ID no proporcionado");
        }
        $model = new Task();
        $task = $model->getById($id);
        if(!$task){
            throw new Exception("Tarea no encontrada");
        }
        $this->view->task = $task;
    }

}
?>