<?php
namespace Models;
error_reporting(E_ALL);
ini_set('display_errors',1);

class Users{
  public $id;
  public $name;
  public $surname;
  public $birth;
  public $town;
  public $sex;

  public function __construct($name, $surname, $birth, $town, $sex)
  {
    
    $this->name = $name;
    $this->surname = $surname;
    $this->birth = $birth;
    $this->town = $town;
    $this->sex = $sex;
    if(!$this->check_user()){
      $this->save();
    }
  }
  public function save()
  {
    
    $connect = mysqli_connect("localhost:8889","root","root","user");
    $sql='INSERT INTO user(name, surname, birth, town, sex) VALUES ("'.$this->name.'", "'.$this->surname.'", "'.$this->birth.'", "'.$this->town.'", "'.$this->sex.'")';
    $connect->query($sql);
  }
  public function delete($id)
  {
    $sql='DELETE FROM user WHERE id = "'. $id.'"';
    $connect = mysqli_connect("localhost:8889","root","root","user");
    $connect->query($sql);
  }

  public function check_user($name)
  {
    $connect = mysqli_connect("localhost:8889","root","root","user");
    $sql='SELECT * FROM user WHERE name = "'.$name.'"';
    $sql_result = $connect->query($sql);
    $check_name = mysqli_fetch_array($sql_result);
    return $check_name;
  }

  public function format_user($name, $new_birth){
   
    $check_user = $this->check_user($name);
        
    if($check_user)
    {
      $format_user = new Users($check_user['name'], $check_user['surname'], $new_birth, $check_user['town'], $check_user['sex']);
      return $format_user;
    }
  }

  static function age($birth)
  {
    $age_dif=date('Ymd')-date('ymd', strtotime($birth));
    return substr($age_dif,2, -4);
  }
      
  static function sextostring($sex){
    if($sex==0)
    {
      return 'man';
    }else{
      return 'woman';
    }
  }
} 
 
