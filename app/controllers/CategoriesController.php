<?php

class CategoriesController extends ApplicationController {

    public function indexAction() {

        $categoryModel = new Category();
        $this->view->categories = $categoryModel->getAll();
    }

    public function createAction() {

    }

    public function storeAction() {

        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception("Metodo no permitido");
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
            throw new Exception("ID no proporcionado");
        }

        $categoryModel = new Category();
        $category = $categoryModel -> getBYId($id);

        if(!$id) {
            throw new Exception("Categoria no encontrada");
            
        }

        $this -> view -> category = $category;
    }

    public function updateAction() {

        $id = $this->_getParam('id');

        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            throw new Exception("Metodo no permitido");
            
        }

        $name = trim($_POST['category_name'] ?? '');
        $description = trim($_POST['categort_description'] ?? '');

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
            throw new Exception("ID no proporcionado");
        }

        $model = new Category();
        $model->deleteCategory($id);

        header("Location: ". WEB_ROOT . "/categories");
        exit;
    
    }
}
?>