<?php

class CategoriesController extends ApplicationController {

    public function indexAction() {

        $categoryModel = new Category();
        $this->view->categories = $categoryModel->getAll();
    }

    public function createAction() {

    }

    public function storeAction() {

    }

    public function editAction() {

    }

    public function updateAction() {

    }

    public function deleteAction() {

    }
}
?>