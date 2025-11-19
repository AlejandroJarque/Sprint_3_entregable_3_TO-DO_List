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

        $name = trim($_POST['categori_name'] ?? '');
        $description = trim($_POST['categori_description'] ?? '');

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

    }

    public function updateAction() {

    }

    public function deleteAction() {

    }
}
?>