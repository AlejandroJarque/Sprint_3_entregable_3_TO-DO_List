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

    }
    public function deleteAction(){
        
    }
    public function editAction(){

    }

}
?>