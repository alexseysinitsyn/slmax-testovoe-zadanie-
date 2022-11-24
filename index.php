<?php
    require 'People.php';
    if($_POST){
     $user = new Users($_POST['name'], $_POST['surname'], $_POST['birth'], $_POST['town'], $_POST['sex']);
     $list = new People('>=', 214);
    echo'<pre>';
    print_r($list);
    echo'</pre>';
    echo'<pre>';
    print_r($user);
    echo'</pre>';
    echo'<pre>';
    print_r(Users::age($user->birth));
    echo'</pre>';
    echo'<pre>';
    print_r(Users::sextostring($user->sex));
    echo'</pre>';
    echo'<pre>';
    print_r($model->format_user($user->name, '2000-11-01'));
    echo'</pre>';
      die;

    }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
  </head>

  <body>

    <div class="container">

      <form class="form-signin" method="post" action="/">
        <div class="main-error alert alert-error hide"></div>
        <h2 class="form-signin-heading">Please sign up</h2>
        <input name="name" type="text" class="input-block-level" placeholder="name" autofocus>
        <input name="surname" type="text" class="input-block-level" placeholder="Surname">
        <input name="birth" type="date" class="input-block-level" placeholder="Birth">
        <input name="town" type="text" class="input-block-level" placeholder="Town">
        <select name="sex" size="1" class="select-block-level" required >
                <option value=0>Man</option>
                <option value="1">Woman</option>      
        </select>
        <button class="btn btn-large btn-primary" type="submit">Register it</button>
      </form>
   </div> <!-- /container -->
  </body>
</html>
