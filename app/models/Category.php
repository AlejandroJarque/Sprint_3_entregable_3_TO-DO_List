<?php

class Category extends Model {

    protected $_table = 'categories';

    public function getAll() {

        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $statement = $this -> _dbh -> prepare($sql);
        $statement -> execute();
        return $statement -> fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($id) {

        return $this -> fetchOne($id);
    }

    public function insertCategory($name, $description) {

    }

    public function updateCategory($id, $name, $description) {

    }

    public function deleteCategory($id) {

    }
}
?>