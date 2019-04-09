
<?php
     
     // if (file_exists('..//connect_db.php')) {
     	
     // 	 require_once('..//connect_db.php');
     // }else{

     // 	die('you are not connect with database');
     // }


     class topicApi{

               

              public function get_topic_information($where_from = '' ){

                   global $conn;

                   try{

                        $get_topic = $conn->prepare("SELECT * FROM topic " . $where_from);
                        $get_topic->execute();

                        $result = $get_topic->setFetchMode(PDO::FETCH_OBJ);

                        $myarray = array();
                        foreach ($get_topic->fetchAll() as $key => $value) {
                        	
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

              public function get_topic_information_by_id($id){

              	    $id = (int) $id;

              	    if ($id <= 0 ) {
              	    	
              	    	return NULL;
              	    }

              	    $get_topic_id = $this->get_topic_information(' WHERE id = ' . $id)[0];
                    
                    return $get_topic_id;

              }

              public function get_topic_information_by_name($name){
                  
                  global $conn;

                  $name = $this->myTest(filter_var($name , FILTER_SANITIZE_STRING ));
                  $name = $conn->quote($name);

                  $get_topic_name = $this->get_topic_information("WHERE title = ".$name)[0];

                  return $get_topic_name;

              }

            public function get_topic_information_by_popid($id){

                 global $conn;

                 $id = (int) $id;
                 if ($id < 0) {
                   
                   return NULL;
                 }

                 $get_popid = $this->get_topic_information("WHERE popid = " .$id);
                 return $get_popid;

            }  

              public function add_topic($title , $description , $imagetopic, $popid = 0){
                   global $conn;

                   try{
                   	       if (empty($title) || empty($description) || empty($imagetopic)) {

                   	       	   throw new Exception("must be fill the fields");
                   	       	}   

		                   $title = $this->myTest(filter_var($title , FILTER_SANITIZE_STRING));
		                   $description = $this->myTest(filter_var($description , FILTER_SANITIZE_STRING));

		                   $popid = (int) $popid;
		                   if ($popid < 0 || empty($popid) || is_null($popid)) {
		                   	   
		                       $popid = 0;
		                   }

		              	   $add_topic = $conn->prepare("INSERT INTO topic(title , description , imagetopic , popid)
		              	   	                            VALUES(:title , :description , :imagetopic , :popid)") ;

		              	   $add_topic->bindparam(':title'       , $title);
		              	   $add_topic->bindparam(':description' , $description);
		              	   $add_topic->bindparam(':imagetopic'  , $imagetopic);
		              	   $add_topic->bindparam(':popid'       , $popid);

		              	   $add_topic->execute();
		              	   return true;
    		            }catch(Exception $e){

    		            	$conn = null;
    		            	return $e->getMessage();
    		            }
     
              }

              public function delete_topic($topic_delete){
                 
                 global $conn;
                 try{
                        if (!filter_var($topic_delete ,  FILTER_VALIDATE_INT) === false) {
                        	 $delete_topic = "DELETE FROM topic WHERE id = " . $topic_delete;
                        	if($conn->exec($delete_topic) == 0)
                        		throw new Exception("this topic is already not exists");
                        		
                        }else{

                        	$topic_delete = $this->myTest(filter_var($topic_delete , FILTER_SANITIZE_STRING));
                        	$delete_topic = "DELETE FROM topic WHERE title = '" .$topic_delete."'";
                            
                            if ($conn->exec($delete_topic) == 0) {
                            	
                            	throw new Exception("this topic is already not exists");
                            }

                        }
              	        

                     return true;
              	    }catch(Exception $e){

                        $conn = null;
                        echo $e->getMessage();
                        return NULL;
              	    } 


              }

              public function update_topic($id , $title = NULL , $description = NULL , $image = NULL , $popid = -1){
                 
		                 global $conn;
		                 try{

		                 	     $id = (int) $id;
		                 	     if ($id <= 0) {
		                 	     	throw new Exception("must be more than zero");
		                 	     }


		                 	     $check_topic_found = $this->get_topic_information_by_id($id);
		                 	     if (!$check_topic_found) {
		                 	     	throw new Exception("this topic is not found to update");
		                 	     }

                                 if (empty($title) && empty($description) && empty($image) && $check_topic_found->popid == $popid) {
                                 	
                                 	throw new Exception("must be update");
                                 	
                                 }

                                 $update_array = array();
                                 if (!empty($title)) {
                                 	
                                 	$title = $this->myTest(filter_var($title , FILTER_SANITIZE_STRING));
                                    $update_array[count($update_array)] = "title = '$title'";
                                 }

                                 if (!empty($description)) {
                                 	
                                 	 $description = $this->myTest(filter_var($description , FILTER_SANITIZE_STRING));
                                 	 $update_array[count($update_array)] = "description = '$description'";
                                 }

                                 if (!empty($image)) {
                                 	$update_array[count($update_array)] = "imagetopic = '$image'"; 
                                 }

                                 $popid = (int) $popid;
                                 if ($popid < 0) {
                                 	
                                 	$popid = $check_topic_found->popid;
                                 }
                                 $update_array[count($update_array)] = "popid = '$popid'";


				                 $update_topic = "UPDATE topic SET ";

				                 $fcount = count($update_array);
				                 for ($i=0; $i < $fcount ; $i++) { 
				                 	
				                 	  $update_topic .= $update_array[$i];
				                 	  if ($i < $fcount-1) {
				                 	  	$update_topic .= ' , ';
				                 	  }
				                 }

				                 $update_topic .= "WHERE id = " . $id;
				                 $update_topic_query = $conn->prepare($update_topic);
				                 $update_topic_query->execute();
				                 return true;

		                   }catch(Exception $e){

			                	 $conn = null;
				            	 echo $e->getMessage();
				            	 return false;
		                    }

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

              function myTest($data){

			    	$data = trim($data);
			    	$data = htmlspecialchars($data);
			    	$data = stripslashes($data);
			    	$data = strip_tags($data);

			    	return $data;
               }
     }


?>

