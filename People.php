<?php
require 'Users.php';
error_reporting(E_ALL);
ini_set('display_errors',1);


Class People{
    public $users;
    
    public function __construct($operator, $id){
       
       $this->users = [];
       $list = $this->select($operator, $id);
       foreach($list as $one){
        $person = new Users($one['name'], $one['surname'], $one['birth'], $one['town'], $one['sex']);
        $this->addUser($person);
        }
        return $this->users;
    }

    public function addUser(Users $person){
        $this->users[] = $person;
    }

    public function select($operator, $id){
        $connect = mysqli_connect("localhost:8889","root","root","user");
        $sql='SELECT * FROM user WHERE id '.$operator.' '. $id.'';
        $result = $connect->query($sql);
        return $result;
    }

    public function delete_person(Users $person){
         $delete_person = array_filter($this->users, function($user) use ($person){
        return $user == $person;});
        $sql='DELETE FROM user WHERE name = "'. $person->name.'"';
        $connect = mysqli_connect("localhost:8889","root","root","user");
        $connect->query($sql);

        }

        
    }