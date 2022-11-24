<?php
namespace Models;
error_reporting(E_ALL);
ini_set('display_errors',1);

class Users{
public $id;
public $name;
public $surname;
public $birth;
public $sex;
public $town;
public function __construct($name, $surname, $birth, $town, $sex)
   {
    
        $this->name = $name;
        $this->surname = $surname;
        $this->birth = $birth;
        $this->town = $town;
        $this->sex = $sex;
        
        $this->save();
   }
   public function save(){
       $connect = mysqli_connect("localhost:8889","root","root","user");
       $sql='INSERT INTO user(name, surname, birth, town, sex) VALUES ("'.$this->name.'", "'.$this->surname.'", "'.$this->birth.'", "'.$this->town.'", "'.$this->sex.'")';
       $connect->query($sql);
   }
   public function delete($id){
    
        $sql='DELETE FROM user WHERE id = "'. $id.'"';
        $connect = mysqli_connect("localhost:8889","root","root","user");
        $connect->query($sql);
      }

      public function update($name, $birth){
        $connect = mysqli_connect("localhost:8889","root","root","user");
        $sql='SELECT * FROM user WHERE name = "'.$name.'"';
        
        $sql_result = $connect->query($sql);
        $check_name = mysqli_fetch_array($sql_result);
        
        if($check_name){
            $format_user = new Users($check_name['name'], $check_name['surname'], $birth, $check_name['town'], $check_name['sex']);
        return $format_user;
        }

        $this->id= $id;
        $sql='DELETE FROM user WHERE id = "'. $this->id.'"';
        $connect = mysqli_connect("localhost:8889","root","root","user");
        $connect->query($sql);
      }

      static function age($birth){
        $age_dif=date('Ymd')-date('ymd', strtotime($birth));
        return substr($age_dif,2, -4);
      }
      static function sextostring($sex){
        if($sex==0){
            return 'man';
        }else{
            return 'woman';
        }
      }
} 
 
