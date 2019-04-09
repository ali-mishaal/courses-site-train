<?php
   require_once 'userApi.php';
   require_once '..//connect_db.php';
   require_once '..//session.php';

   $obj_pass = new userApi();

  $message = '';
  $check = '';
  
   if (isset($_POST['check'])){
     $check = $_POST['check'];
     
   }

    if(empty($check)){
     	$message = '<p>please enter old password</p>';

     }else{

   $inform_pass = $obj_pass->get_user_information_by_id($_SESSION['user_in']->id);
   $old_pass = $inform_pass->password;
   
   $check = md5($check);
  
    if (strcmp($check, $old_pass) !== 0 ){
        $message = '<p>this password is wrong</p>';
    }else{
    	$message = '<input type="password" name="specific_password" required>'; 
    }}
   
echo $message;


?>
