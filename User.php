<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

class User{
  private $name;
  private $surname;
  private $birth;
  private $town;
  private $sex;
  const DB_HOST = "localhost:8889";
  const DB_USER = "root";
  const DB_PASS = "root";
  const DB_NAME = "user";
  private $connect;

  public function __construct($name, $surname, $birth, $town, $sex)
  {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $this->connect=mysqli_connect(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME );
    
    $this->name = $name;
    $this->surname = $surname;
    $this->birth = $birth;
    $this->town = $town;
    $this->sex = $sex;
    if(!$this->check_user($this->name)){
      $this->save();
    }
  }
  public function save()
  {
   $sql='INSERT INTO user(name, surname, birth, town, sex) VALUES ("'.$this->name.'", "'.$this->surname.'", "'.$this->birth.'", "'.$this->town.'", "'.$this->sex.'")';
   $this->connect->query($sql);
  }
  public function delete(int $id)
  {
    $sql='DELETE FROM user WHERE id = "'. $id.'"';
    $this->connect->query($sql);
  }

  public function check_user($name)
  {
    $sql='SELECT * FROM user WHERE name = "'.$name.'"';
    $sql_result = $this->connect->query($sql);
    $check_name = mysqli_fetch_array($sql_result);
    return $check_name;
  }

  public function format_user($name, $new_birth){
   
    $check_user = $this->check_user($name);
        
    if($check_user)
    {
      $format_user = new User($check_user['name'], $check_user['surname'], $new_birth, $check_user['town'], $check_user['sex']);
      return $format_user;
    }
  }

  public static function age($birth)
  {
    $age_dif=date('Ymd')-date('ymd', strtotime($birth));
    return substr($age_dif,2, -4);
  }
      
  public static function sextostring($sex){
    if($sex==0)
    {
      return 'man';
    }else{
      return 'woman';
    }
  }
} 
 
