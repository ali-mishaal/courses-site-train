<?php


    if (file_exists('..//session.php')) {
              require_once('..//session.php');
      }else{

             echo 'you are not start session';
      }
      
      if (file_exists('..//connect_db.php')) {
      	  require_once('..//connect_db.php');
      }else{

      	 echo 'you are not connect with database';
      }

      if (file_exists('userApi.php')) {
      	   require_once('userApi.php');
      }else{
      	echo "we lost some data";
      }


     if (isset($_POST['login_user'])) {

     	  if (!isset($_POST['username']) || !isset($_POST['password'])) 
       	      die('there is no data to handle it');

     	  $input_name = $_POST['username'];
     	  $input_password = $_POST['password'];
     }

      $obj = new userApi();

      $chek_user_name = $obj->get_user_information_by_name($input_name);

      if (empty($chek_user_name)) {
      	   
      	   $chek_user_name = $obj->get_user_information_by_email($input_name);
           if (empty($chek_user_name)) {
           	
               $conn = null;
               die('maybe you write name or password wrong');
           }
      }

      $input_password = md5($obj->myTest($input_password));
      $conn = null;

      if (strcmp($input_password, $chek_user_name->password) != 0 ) {
      	
      	 die('maybe you write name or password wrong');
      }


      $chek_user_name->password = 0;
      $_SESSION['user_in'] = $chek_user_name;
      header("location: //localhost/tasks/courses/");
     

?>