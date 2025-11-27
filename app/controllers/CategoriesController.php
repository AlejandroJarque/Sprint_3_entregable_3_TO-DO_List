<?php

class CategoriesController extends ApplicationController {

    public function indexAction() {

        $this->view->setLayout('layout');
        $categoryModel = new Category();
        $this->view->categories = $categoryModel->getAll();
    }

    public function createAction() {

        /*$catModel = new Category();
        $this->view->categories = $catModel->getAll();*/
    }

    public function storeAction() {

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
    }

    public function updateAction() {

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