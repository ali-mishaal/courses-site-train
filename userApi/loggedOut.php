
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


      $_SESSION['user_in'] = false;
      header("location: //localhost/tasks/courses/");






?>