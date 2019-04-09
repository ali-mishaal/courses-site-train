<?php

if (file_exists('..//connect_db.php')) {
	
	require_once('..//connect_db.php');
}else{

	die('THe COnnection TO DAtaBAse IS LOst');
}







class userApi{
        
	    function get_user_information($where_what = ''){
	         
	          global $conn;

	          try{
	             
	              $user_select = $conn->prepare("SELECT * FROM users ". $where_what);
	              $user_select->execute();

	              $result = $user_select->setFetchMode(PDO::FETCH_OBJ);

	              $myarray = array();
	              foreach ($user_select->fetchAll() as $key => $value) {
	              	
	                  $myarray[count($myarray)] = $value;
	              }
                  
	              
	              if (empty($myarray)) {
	              	return NULL;
	              }

                  
	              }catch(Exception $e){

	              $conn = null;
	    	      return NULL;
	              }

	              return $myarray;

	        
	      }   

	    function get_user_information_by_id($id){
	       
	       $id = (int) $id;

	       if ($id <= 0) {
	       	 
	          return NULL;
	       }

	      $user_select_id = $this->get_user_information('WHERE id =' . $id)[0];

	       return $user_select_id;
	    

	    }  
	   
	    function get_user_information_by_name($name){
                global $conn;
			   	$name = $this->myTest(filter_var($name , FILTER_SANITIZE_STRING));
			    
			    if (empty($name) ) {
			    	
			    	return NULL;
			    }
                
                $name = $conn->quote($name);
			    $user_select_name = $this->get_user_information("WHERE name = ".$name)[0];

			    return $user_select_name;


	     }

	   function get_user_information_by_email($email){
	        global $conn;
	        $email = $this->myTest(filter_var($email , FILTER_SANITIZE_STRING));
	        if(filter_var($email , FILTER_VALIDATE_EMAIL) == false){
	           echo 'please enter valid email';
	           return NULL;
	        }
            
            $email = $conn->quote($email);
	        $select_user_email = $this->get_user_information('WHERE email = ' . $email)[0];

	        return $select_user_email;

	   	
	   }

	   function add_user($name , $password , $email , $isadmin=0 , $type=1 , $country='' , $city='' , $phone='' , 
	   	                 $image='imageUser/defaultPic.png', $dat_of_birth =''){
	     
						      global $conn;

						      try {

						      	   if (empty($name) || empty($password) || empty($email)) {

						               throw new Exception("must be fill the fields");
						             
						      	   }

						      	   $name = $this->myTest(filter_var($name , FILTER_SANITIZE_STRING));
						      	   $password = md5($this->myTest($password));
						      	   $email = $this->myTest(filter_var($email , FILTER_SANITIZE_EMAIL));
						      	   if (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
						      	   	   
						      	   	   throw new Exception("must be enter validate email");
						      	   }
						          

						           $isadmin = (int) $isadmin;
						           if ($isadmin != 0 && $isadmin != 1 ) {

						           	 throw new Exception("must be fill isadmin accurately");
						           }

                                   $add_user = $conn->prepare("INSERT INTO users(name , password , email , type , 
                                   	                           country , city , phone , image , dateBirth ,isadmin)
                                   	                           VALUES (:name ,:password ,:email , :type , :country , 
                                   	                                   :city ,:phone , :image , :dateBirth , 
                                   	                                   :isadmin ) ");

						            $add_user->bindParam(':name'     , $name);
						            $add_user->bindParam(':password' , $password);
						            $add_user->bindParam(':email'    , $email);
						            $add_user->bindParam(':type'     , $type);
						            $add_user->bindParam(':country'  , $country);
						            $add_user->bindParam(':city'     , $city);
						            $add_user->bindParam(':phone'    , $phone);
						            $add_user->bindParam(':image'    , $image);
						            $add_user->bindParam(':dateBirth', $dat_of_birth);
						            $add_user->bindParam(':isadmin'  , $isadmin);


						            $add_user->execute();

						      } catch (Exception $e) {
						      	  $conn = null;
						          return $e->getMessage();

						      }
						       
						      return true;

	   }

	    function upload_image($directory_path , $name_of_input_image){

			   
			 
			        $target_file = $directory_path.'/'.basename($_FILES[$name_of_input_image]['name']);
			        $imageFileType = strtolower(pathinfo($target_file , PATHINFO_EXTENSION));
			  	    $uploadOk = 1;

			  	    $check = getimagesize($_FILES[$name_of_input_image]['tmp_name']);
                    if ($check !== false) {
                    	$uploadOk = 1;
                    }else{
                    	$uploadOk = 0;
                    	echo "<div class='is_not_image'> This Is Not Image</div>";
                    	return false;
                    }

                    if (file_exists($target_file)) {
                    	$uploadOk = 0;
                    	echo "<div class='is_not_image'> This Image Is Already Exists</div>";
                    	return false;
                    }

                    if ($_FILES[$name_of_input_image]['size'] > 500000) {
                    	$uploadOk = 0;
                    	echo "<div class='is_not_image'> Sorry, Your Image Is Too Large</div>";
                    	return false;
                    }

                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                    	$uploadOk = 0;
                        echo "<div class='is_not_image'> Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
                        return false;
                    }

                    if ($uploadOk == 1) {
                    	
                    	move_uploaded_file($_FILES[$name_of_input_image]['tmp_name'] , $target_file );
                    }

                    return $target_file;
			            
	                     
	    }

	   function delete_user($user_delete){
           try {
                  global $conn;

	           	  if (!filter_var($user_delete, FILTER_VALIDATE_INT) === false) {
                     
		                $get_user_to_delete_query = "DELETE FROM users WHERE id = ". $user_delete;
	                    if($conn->exec($get_user_to_delete_query) == 0){
	                       
		                      $get_user_to_delete_query = "DELETE FROM users WHERE phone = ". $user_delete;
			                  if ($conn->exec($get_user_to_delete_query) == 0) {
			                  	throw new Exception("this user is already not exists");
			                  	 
			                  }

	                    }
	                
	              }


               if (!filter_var($user_delete , FILTER_VALIDATE_EMAIL) === false) {
              	
		                 $get_user_to_delete_query = "DELETE FROM users WHERE email = '" . $user_delete."'";

		                 if ($conn->exec($get_user_to_delete_query) == 0){

		                 	throw new Exception("this user is already not exists");
		                 }
               
 
               }


	              echo "USer deleted successfully";
           	
           } catch (Exception $e) {
           	  
           	  $conn = null;
           	  echo $e->getMessage();
              return false;
           }
           
           return true;


	   }


	   function update_user($id ,$name =NULL ,$password =NULL ,$email =NULL , $type = -1 ,$country =NULL ,$city =NULL , $phone = NULL , 
	   	                   $image = 'imageUser/defaultPic.png' , $birth = NULL , $isadmin = -1 ){

						            global $conn;


						            try{
								            $id = (int) $id;
								            if ($id <= 0) {
								            	
								            	throw new Exception('this user is not found to update');
								            	
								            }
								            
								            $check_user_to_update = $this->get_user_information_by_id($id);
								            if (!$check_user_to_update) {
								            	
								            	throw new Exception('this user is not found to update');
								            	
								            }

								            if (empty($name) && empty($password) && empty($email) && $check_user_to_update->type == $type 
								            	&&empty($country) && empty($city) && empty($phone) && empty($image) && empty($birth) && 
								            	$check_user_to_update->isadmin == $isadmin ) {
								            	
								            	  throw new Exception('you do not update every thing');
								            	  
								            }
								           
								            $update_array = array();
								            if (!empty($email)) {
								            	
								            	$email = $this->myTest(filter_var($email , FILTER_SANITIZE_STRING));
								            	if (!filter_var($email , FILTER_VALIDATE_EMAIL)) {
											          throw new Exception("not valid email");
											            
											       }
								            	$update_array[count($update_array)] = "email = '$email'";

								            }

								            if (!empty($name)) {
								            	
								            	$name = $this->myTest(filter_var($name , FILTER_SANITIZE_STRING));
								            	$update_array[count($update_array)] = "name = '$name'";

								            }

								            if (!empty($password)) {
								            	
								            	$password = md5($this->myTest($password));
								            	$update_array[count($update_array)] = "password = '$password'";

								            }

								            if (!empty($country)) {
								            	
								            	$country = $this->myTest(filter_var($country, FILTER_SANITIZE_STRING));
								            	$update_array[count($update_array)] = "country= '$country'";

								            }

								            if (!empty($city)) {
								            	
								            	$city = $this->myTest(filter_var($city , FILTER_SANITIZE_STRING));
								            	$update_array[count($update_array)] = "city = '$city'";

								            }


								            $type = (int) $type;
								            if ($type == -1) {
								            	$type = $check_user_to_update->type;
								            }
								            $update_array[count($update_array)] = "type = '$type'";

								            $phone = (int) $phone;
								            $update_array[count($update_array)] = "phone = '$phone'";

								            if (!empty($image)) {
								    
								            	$update_array[count($update_array)] = "image = '$image'";

								            }

								            if(!empty($birth))
								                $update_array[count($update_array)] = "dateBirth = '$birth'";

                                            $isadmin = (int) $isadmin;
                                            if ($isadmin < 0 || $isadmin > 1) {
                                            	
                                            	$isadmin = 0;
                                            }
                                            $update_array[count($update_array)] = "isadmin = '$isadmin'";
                                              
                                             
								            $update_user = "UPDATE users SET ";

								            $fcount = count($update_array);

								            for ($i=0; $i < $fcount ; $i++) { 

								                  $update_user .= $update_array[$i];
								                  if ($i < $fcount-1) {
								                                     	
								                      $update_user .= ' , ';               		
								                   }                   	
								                  
								            }
                                             
								            $update_user .= 'WHERE id= '. $id;
								            $update_user_query = $conn->prepare($update_user);
								            $update_user_query->execute();
								            return true;

						            }catch(Exception $e){
                                        $conn = null;
						            	echo $e->getMessage();
						            	return false;
						            }

		            
 
	   }

	    function myTest($data){

	    	$data = trim($data);
	    	$data = htmlspecialchars($data);
	    	$data = stripslashes($data);
	    	$data = strip_tags($data);

	    	return $data;
    }

}

   

?>

