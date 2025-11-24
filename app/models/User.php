<?php
class User {
    private $file;

    public function __construct() {
        $this->file = ROOT_PATH.'/app/data/users.json';
    }

    private function load() {
        if(!file_exists($this->file)) {
            return [];
        }
        $json = file_get_contents($this->file);
        return json_decode($json, true)??[];
    }

     private function save($data) {

            file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
        }

    public function getAll() {
        $users = $this->load();

        usort($users, function($a, $b) {
            return $b['id']<=>$a['id'];
        });

        return array_map(function($user) {
            return(object)$user;
        },$users);
    }
    
    public function getById($id) {
        $users = $this->load();

        foreach($users as $user){
            if($user['id']==$id){
                return(object)$user;
            }
        }
        return null;
    }
    public function getByUsername($username) {
        $users = $this->load();

        foreach($users as $user) {
            if($user['user_username'] === $username) {
                return (object)$user;
            }
        }
        return null;
    }

    public function insertUser($name, $surname, $username, $email, $password) { //$user_password ??
        $users = $this->load();

        $ids = array_column($users, 'id');
        $id = empty($ids) ? 1 : max($ids) + 1;

        $newUser = [
            'id'=>$id,
            'user_name'=>$name,
            'user_surname'=>$surname,
            'user_username'=>$username,
            'user_email'=>$email,
            'user_password'=>$password
        ];

        $users[]=$newUser;
        $this->save($users);
        return true;
    }
    
    public function deleteUser($id) {
        $users = $this->load();

        $users=array_filter($users, function($user)use($id){
            return $user['id']!=$id;
        });

        $users=array_values($users);
        $this->save($users);
        return true;
    }
}