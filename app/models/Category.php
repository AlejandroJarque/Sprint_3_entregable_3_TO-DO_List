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

        $sql = "INSERT INTO categories
            (category_name, category_description, created_at, updated_at)
            VALUES
            (:name, :description, :created, :updated)";

        $stmt = $this -> _dbh -> prepare($sql);

        return $stmt -> execute([
            ':name' => $name,
            ':description' => $description,
            ':created' => date('Y-m-d H:i:s'),
            ':updated' => date('Y-m-d H:i:s')
        ]);
    }

    public function updateCategory($id, $name, $description) {

        $sql = "UPDATE categories
                SET
                    category_name = :name,
                    category_description = :description,
                    updated_at = :updated
                WHERE id = :id";
        
        $stmt = $this->_dbh->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':name' => $name,
            ':description' => $description,
            ':updated' => date('Y-m-d H:i:s')
        ]);

    }

    public function deleteCategory($id) {

        return $this -> delete($id);
    }
}
?>