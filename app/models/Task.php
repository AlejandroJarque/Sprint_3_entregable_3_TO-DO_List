<?php
class Task {
private $file;

public function __construct(){
    $this->file = ROOT_PATH . '/app/data/tasks.json';
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

        public function insertTask(string $name, string $description,$status,$start,$end,$categories,$user){
            $tasks = $this->load();
            $id = empty($tasks) ? 1 : max(array_column($tasks,'id')) + 1;
            $newTask = ['id' => $id,
            'task_name' => $name,
            'task_description' => $description,
            "status" => $status,
            "start_time" => $start,
            "end_time" => $end,
            "categories" => $categories,
            "user" => $user,
            'create_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')];

            $tasks[] = $newTask;
            $this->save($tasks);
            return true;
        }

        public function updateTask(int $id,string $name, string $description,$status,$start,$end,$categories,$user){
            $tasks = $this->load();
            foreach($tasks as $tas){
                if($tas['id'] == $id){
                    $tas['tasks_name'] = $name;
                    $tas['tasks_description'] = $description;
                    $tas['status'] = $status;
                    $tas['start_time'] = $start;
                    $tas['end_time'] = $end;
                    $tas['categories'] = $categories;
                    $tas['user'] = $user;


                    $tas['task_at'] = date('Y-m-d H:i:s');
                }
            }
            $this -> save($tasks);
            return true;
        }
    
        public function deleteTask($id){
            $tasks = $this->load();

            $tasks = array_filter($tasks,function ($tas) use($id) {
                return $tas['id'] != $id;});

                $tasks = array_values($tasks);
                $this->save($tasks);
                return true;

        }

}
?>