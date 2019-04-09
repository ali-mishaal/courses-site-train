<?php

    //header("location: admin.php");
    if (file_exists('..//session.php')) {
        require_once('..//session.php');
      }

      require_once('userApi.php');

      if ($_SESSION['user_in']->isadmin != 1 || $_SESSION['user_in'] == false) {
        
           header("location: http://localhost/tasks/courses/");
      }

      if(!isset($_GET['id']))
	     header("location: http://localhost/tasks/courses/");

    
    $check_id = $_GET['id'];
    $check_id = (int) $check_id;
    if ($check_id <= 0 ) {
    	
    	header("location: http://localhost/tasks/courses/");
    }

    if(!isset($_GET['c']) || $_GET['c'] != 1){
       
		die("<a href = 'deleteUser.php?id= ". $check_id ." &c=1'>YES</a> "." <a href = 'http://localhost/tasks/courses/userApi/admin.php'>NO</a>"); 
	}

    $obj = new userApi();
    $obj->delete_user($check_id);
    











?>