<?php


 
     
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

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      	   
          if($_POST['name'])
             $input_name = $_POST['name'];

          if($_POST['type'])
            $input_type = $_POST['type'];
          if ($input_type == 'Male') {
                $input_type = 1;
          }else{
            $input_type = 0;
          }

          if($_POST['country'])
            $input_country= $_POST['country'];

          if($_POST['city'])
            $input_city = $_POST['city'];

          if($_POST['phone'])
            $input_phone = $_POST['phone'];

          if($_POST['birth'])
            $input_birth = $_POST['birth'];

           $obj = new userApi();
           $check_user_name = $obj->get_user_information_by_name($input_name);
           if (empty($check_user_name)) {
               $conn = null;
               die('there user is not already exists');
           }

           $update_user_in_database = $obj->update_user($check_user_name->id ,'','' ,'', $input_type , $input_country , $input_city , 
                                                        $input_phone ,'', $input_birth , '');
           

           if (!$update_user_in_database) {
              die('fill the fields correctly'); 
           }
           
           $get_user_information_after_edit = $obj->get_user_information_by_id($check_user_name->id);
            $conn = null;
            $get_user_information_after_edit->password = 0;
            $_SESSION['user_in'] = $get_user_information_after_edit;
            echo 'Done : Enjoy';
        

      }
