<?php
class Task {
private $file;

public function __construct(){
    $this->file = ROOT_PATH . 'app/data/tasks.json';
}

    private function load(){
        if(!file_exists($this->file)){
            return [];
        }
        $json = file_get_contents($this->file);
        return json_decode($json,true)??[];
    }
    private function save($data){
        file_put_contents($this->file,json_encode($data,JSON_PRETTY_PRINT));
        
    }
    
    public function getAll(){

    }
    public function getById(){

    }
    public function insertTask(){

    }
    public function updateTask(){

        }
    public function deleteTask(){

    }

}
?>