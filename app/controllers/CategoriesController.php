<?php

class CategoriesController extends ApplicationController {

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
        $categoryModel = new Category();
        $this->view->categories = $categoryModel->getAll();
    }

    public function createAction() {

        $this->requireLogin();
        $this->view->setLayout('layout');
    }

    public function storeAction() {

        $this->requireLogin();

        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception("Method not allowed");
        }

        $name = trim($_POST['category_name'] ?? '');
        $description = trim($_POST['category_description'] ?? '');

        if($name === '' || $description === '') {
             
            header('Location: ' . WEB_ROOT . '/categories/create');
            exit;
        }

        $categoryModel = new Category();
        $categoryModel -> insertCategory($name, $description);

        header('Location: ' . WEB_ROOT . '/categories');
        exit;
    }

    public function editAction() {

        $this->requireLogin();

        $id = $this -> _getParam('id');

        if(!$id) {
            throw new Exception("ID not provided");
        }

        $categoryModel = new Category();
        $category = $categoryModel -> getById($id);

        if(!$category) {
            throw new Exception("Category not found");
            
        }

        $this -> view -> category = $category;
        $this -> view -> setLayout('layout');
    }

    public function updateAction() {

        $this->requireLogin();

        $id = $this->_getParam('id');

        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception("Method not allowed");
            
        }

        $name = trim($_POST['category_name'] ?? '');
        $description = trim($_POST['category_description'] ?? '');

        if($name === '') {
            header("Location: ". WEB_ROOT . "/categories/edit/$id");
            exit;
        }

        $model = new Category();
        $model ->updateCategory($id, $name, $description);

        header("Location: ". WEB_ROOT . "/categories");
        exit;
    }

    public function deleteAction() {

        $this->requireLogin();
        
        $id = $this->_getParam('id');

        if(!$id) {
            throw new Exception("ID not provided");
        }

        $model = new Category();
        $model->deleteCategory($id);

        header("Location: ". WEB_ROOT . "/categories");
        exit;
    
    }
}
?>