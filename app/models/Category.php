<?php

class Category {

    private $file;
    private $tasks = [];

    public function __construct()
    {
        $this -> file = ROOT_PATH . '/app/data/categories.json';
    }

    private function load() {

        if(!file_exists($this -> file)) {

            return [];
        }

        $json = file_get_contents($this -> file);
        return json_decode($json, true) ?? [];
    }

    private function save($data) {

        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function getAll() {

        $categories = $this -> load();

        usort($categories, function ($a, $b) {
            return $b['id'] <=> $a['id'];
        });

        return array_map(function($cat) {
            return (object) $cat;
        }, $categories);
    }

    public function getById($id) {

        $categories = $this->load();

        foreach($categories as $cat) {
            if($cat['id'] == $id) {
                return (object)$cat;
            }
        }

        return null;
    }

    public function insertCategory($name, $description) {

        $categories = $this -> load();

        $id = empty($categories)
            ? 1
            : max(array_column($categories, 'id')) +1;

        $newCategory = [
            'id' => $id,
            'category_name' => $name,
            'category_description' => $description,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $categories[] = $newCategory;
        $this-> save($categories);
        return true;
    }

    public function updateCategory($id, $name, $description) {

        $categories = $this -> load();

        foreach($categories as &$cat) {
            if($cat['id'] == $id) {

                $cat['category_name'] = $name;
                $cat['category_description'] = $description;
                $cat['updated_at'] = date('Y-m-d H:i:s');
            }
        }

        $this -> save($categories);
        return true;
    }

    public function deleteCategory($id) {

        $categories = $this -> load();

        $categories = array_filter($categories, function($cat) use ($id) {
            return $cat['id'] != $id;
        });

        $categories = array_values($categories);
        $this->save($categories);
        return true;
    }
}
?>