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
        $tasks = $this->load();
        usort($tasks,function ($a, $b) {return $b['id'] <=> $a['id']; } );
        return array_map(function ($tas) {return(object) $tas;}, $tasks);
    }
    public function getById(int $id){
        $tasks = $this->load();
        foreach($tasks as $tas){
            if($tas['id'] == $id){
                return (object)$tas;
            }
        }
        return null;

    }
    public function insertTask(){

    }
    public function updateTask(){

        }
    public function deleteTask(){

    }

}
?>