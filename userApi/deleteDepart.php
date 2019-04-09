<?php

          if (file_exists('..//session.php')) {
            require_once('..//session.php');
          }
          require_once('..//connect_db.php');
          require_once('../topicApi/topicApi.php');

          if ($_SESSION['user_in']->isadmin != 1 || $_SESSION['user_in'] == false) {
            
               header("location: http://localhost/tasks/courses/");
          }

          if(!isset($_GET['id']))
    	     die('this user is not found');

        
        $check_id = $_GET['id'];
        $check_id = (int) $check_id;
        if ($check_id <= 0 ) {
        	
        	die('this id is not valid');
        }

        if(!isset($_GET['c']) || $_GET['c'] != 1){
           
    		die("<a href = 'deleteDepart.php?id= ". $check_id ." &c=1'>YES</a> "." <a href = 'http://localhost/tasks/courses/userApi/admin.php'>NO</a>"); 
    	}

        $obj = new topicApi();
        $obj->delete_topic($check_id);

    ?>