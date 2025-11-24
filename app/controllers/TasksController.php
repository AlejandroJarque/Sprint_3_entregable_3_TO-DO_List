<?php
class TasksController extends ApplicationController {

    public function indexAction(){
       // $this->view->setLayout('main');
       $tasksModel = new Task();
       $this->view->tasks = $tasksModel->getAll();

    }
    public function createAction(){


    }
    public function storeAction(){

    }
    public function updateAction(){
        $id = $this->_getParam('id');
        if($_SERVER['REQUEST_METHOD'] !== 'POST'){
            throw new Exception('Metodo no permitido');

        }
        $name = trim($_POST['tasks_name'] ?? '');
        $description = trim($_POST['tasks_description'] ?? '');

        if($name === ''){
            header("Location: " . WEB_ROOT . "/tasks/edit/$id");
            exit;
        }
        $model = new Task();
        $model ->updateTask($id,$name,$description);

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

    }

}
?>