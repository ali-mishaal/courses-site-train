<?php


    //require_once('..//connect_db.php');

     
     class coursesApi{


                public function get_courses_information($where_From = ''){

                	            global $conn;
                	            try{

                	            	$get_corses = $conn->prepare("SELECT * FROM course " . $where_From);
                	            	$get_corses->execute();
                	            	$result = $get_corses->setFetchMode(PDO::FETCH_OBJ);
                                    
                                    $myarray = array();
                	            	foreach ($get_corses->fetchAll() as $key => $value) {
                	            	        
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


                public function get_courses_information_by_id($id){
                       
                       $id = (int) $id;

                       if ($id <= 0 ) {
                       	   
                       	   return NULL;
                       }

                	   $get_course_id = $this->get_courses_information('WHERE topicBelongTo = ' .$id);

                	   return $get_course_id;
                }


                public function get_courses_information_by_coursesBelong($id){
                       
                       $id = (int) $id;

                       if ($id <= 0 ) {
                           
                           return NULL;
                       }

                     $get_course_id = $this->get_courses_information('WHERE coursesBelongTo = ' .$id);

                     return $get_course_id;
                }
         
         
              public function get_courses_information_by_topic_id($id){
                       
                       $id = (int) $id;

                       if ($id <= 0 ) {
                       	   
                       	   return NULL;
                       }

                      	   $get_course_id = $this->get_courses_information('WHERE id = ' .$id)[0];

                      	   return $get_course_id;
                }


                public function get_courses_information_by_name($title){
                      global $conn;

                      $title = $this->myTest(filter_var($title , FILTER_SANITIZE_STRING));
                      $title = $conn->quote($title);
                	  $get_corses_name = $this->get_courses_information("WHERE title = ".$title)[0];

                	  return $get_corses_name;
                }


                public function get_courses_information_by_specilization($id){

                       $id = (int) $id;

                       if ($id <= 0 ) {
                       	   
                       	   return NULL;
                       }

                  	   $get_course_spec = $this->get_courses_information('WHERE specilization = ' .$id);

                  	   return $get_course_spec;
                }


                public function get_courses_information_by_popular($id){

                	    $id = (int) $id;

                       if ($id <= 0 ) {
                       	   
                       	   return NULL;
                       }

                	   $get_course_pop = $this->get_courses_information('WHERE popC = ' .$id);

                	   return $get_course_pop;
                }


                public function get_courses_information_by_topRated($id){

                	   $id = (int) $id;

                       if ($id <= 0 ) {
                       	   
                       	   return NULL;
                       }

                	   $get_course_top = $this->get_courses_information('WHERE topRated = ' .$id);

                	   return $get_course_top;
                }
         
         

                 public function get_courses_information_by_type($id){

                	   $id = (int) $id;

                       if ($id < 0 ) {
                       	   
                       	   return NULL;
                       }

                	   $get_course_top = $this->get_courses_information('WHERE type = ' .$id);

                	   return $get_course_top;
                }


                public function add_courses($title ,$desc , $image , $spec = 1 , $popC = 1 , $topRated = 0 , 
                                            $type = 0 , $topicBelongTo = 0,$coursesBelongTo = 0){

                      	 global $conn;
                           try{

                           	  if (empty($title) || empty($desc) || empty($image)) {
                           	  	 
                                    throw new Exception("must be fill the fields");
                           	  }

                           	  $title = $this->myTest(filter_var($title , FILTER_SANITIZE_STRING));
                           	  $desc = $this->myTest(filter_var($desc , FILTER_SANITIZE_STRING));

                           	  $spec = (int) $spec;
                           	  if ($spec <= 0) {
                           	  	  
                           	  	  throw new Exception("must be bigger than zero");  
                           	  }

                           	  $popC = (int) $popC;
                           	  if ($popC < 0) {
                           	  	throw new Exception("must be bigger than zero");  
                           	  }

                           	  $topRated = (int) $topRated;
                           	  if ($topRated < 0 || $topRated > 5) {
                           	  	 throw new Exception("must be bigger than zero");  
                           	  }

                           	  $type = (int) $type;
                           	  if ($type !== 0 && $type !== 1) {
                           	  	throw new Exception("must be bigger than zero");  
                           	  }

                           	  $topicBelongTo = (int) $topicBelongTo;
                           	  if ($topicBelongTo < 0) {
                           	  	 throw new Exception("must be bigger than zero");  
                           	  }

                           	  $coursesBelongTo = (int) $coursesBelongTo;
                           	  if ($coursesBelongTo < 0) {
                           	  	 throw new Exception("must be bigger than zero");  
                           	  }



                           	  $add_courses = $conn->prepare("INSERT INTO course(title , description , image , specilization , popC , topRated ,
                           	                                                     type , topicBelongTo , coursesBelongTo)VALUES(
                                                                                 :title , :description , :image ,:specilization , :popC , :topRated ,:type , :topicBelongTo ,:coursesBelongTo)");

                           	  $add_courses->bindparam(':title'           , $title);
                           	  $add_courses->bindparam(':description'     , $desc);
                           	  $add_courses->bindparam(':image'           , $image);
                           	  $add_courses->bindparam(':specilization'   , $spec);
                           	  $add_courses->bindparam(':popC'            , $popC);
                           	  $add_courses->bindparam(':topRated'        , $topRated);
                           	  $add_courses->bindparam(':type'            , $type);
                           	  $add_courses->bindparam(':topicBelongTo'   , $topicBelongTo);
                           	  $add_courses->bindparam(':coursesBelongTo' , $coursesBelongTo);
                                 
                           	  $add_courses->execute();
                              return true;

                           }catch(Exeption $e){

                               $conn = null;
                               return $e->getMessage();

                           }
                	 
                }


                public function update_courses($id , $title = NULL , $desc = NULL , $image = NULL , $spec = 0 , $popC = 0 , 
                	                           $topRated = 0 , $type = -1 , $topicBelongTo = -1 , $coursesBelongTo = -1){

						                	   global $conn;

						                	   try{

						                	   	   $id = (int) $id;
						                	   	   if ($id <= 0) {
						                	   	   	  return false;
						                	   	   }

						                	   	   $spec = (int) $spec;
						                	   	   $popC = (int) $popC;
						                	   	   $topRated = (int) $topRated;
						                	   	   $topicBelongTo = (int) $topicBelongTo;
						                	   	   $coursesBelongTo = (int) $coursesBelongTo;
                                                   
                                    $get_corses = $this->get_courses_information_by_topic_id($id);

						                	   	   if (empty($title) && $title == $get_corses->title && empty($desc) && 
						                	   	   	   $desc == $get_corses->description && empty($image) && $image == $get_corses->image &&
						                	   	   	   empty($spec) && $get_corses->specilization == $spec && empty($popc) && 
						                	   	   	   $get_corses->popC == $popC && empty($topRated) &&$get_corses->topRated == $topRated 
						                	   	   	   && $get_corses->type == $type && empty($topicBelongTo) && 
						                	   	   	   $get_corses->topicBelongTo == $topicBelongTo && empty($coursesBelongTo) && 
						                	   	   	   $get_corses->coursesBelongTo == $coursesBelongTo) {
						                	   	   	
                                                       throw new Exception("Maybe you entered something wrong");
                                                       
						                	   	   }

                                                   $myarray = array();

						                	   	   if ($title !== $get_corses->title && !empty($title)) {
						                	   	   	   
						                	   	   	   $title = $this->myTest(filter_var($title , FILTER_SANITIZE_STRING));
						                	   	   	   $myarray[count($myarray)] = "title = '$title'";
						                	   	   }

						                	   	   if (!empty($desc)) {
						                	   	   	   
						                	   	   	   $desc = $this->myTest(filter_var($desc , FILTER_SANITIZE_STRING));
						                	   	   	   $myarray[count($myarray)] = "description = '$desc'";
						                	   	   }

						                	   	   if (!empty($image)) {
						                	   	   	  
						                	   	   	  $myarray[count($myarray)] = "image = '$image'";
						                	   	   }

						                	   	   if (!empty($spec)) {
						                	   	      
						                	   	      $myarray[count($myarray)] = "specilization = '$spec'";
						                	   	   }

                                                   if (!empty($popC)) {
                                                   	   
                                                   	   $myarray[count($myarray)] = "popC = '$popC'";
                                                   }

                                                   if (!empty($topRated)) {
                                                      
                                                       $myarray[count($myarray)] = "topRated = '$topRated'";
                                                   }
                                                   
                                                   if ($type < 0) {
                                                   	   
                                                   	   $type = $get_corses->type;
                                                   }

                                                   if ($get_corses->type != $type) {
                                                   	   
                                                   	   $myarray[count($myarray)] = "type = '$type'";
                                                   }

                                                   if ($topicBelongTo >= 0){
                                                   	    
                                                          $myarray[count($myarray)] = "topicBelongTo = '$topicBelongTo'";
                                                       
                                                   	  
                                                   }

                                                   if($coursesBelongTo >= 0) {
                                                   	   
                                                   	   $myarray[count($myarray)] = "coursesBelongTo = '$coursesBelongTo'";
                                                     
                                                   }

                                                   
                                                   $update_courses = "UPDATE course SET ";

                                                   for ($i=0; $i <count($myarray) ; $i++) { 
                                                   	   
                                                   	   $update_courses .= $myarray[$i];
                                                   	   if ($i < (count($myarray)-1)) {
                                                   	   	   
                                                   	   	   $update_courses .= ' , ';
                                                   	   }
                                                   }

                                                   $update_courses .= "WHERE id = " . $id;
							                	   $update_courses_queryy = $conn->prepare($update_courses);
							                	   $update_courses_queryy->execute();
							                	   return true;

							                	}catch(Exception $e){

						                              $conn = null;
						                              return $e->getMessage();
							                	 }  
                }


                public function delete_courses($id){

                	     global $conn;
                	     $id = (int) $id;
                	     if ($id <= 0) {
                	     	
                	     	return false;
                	     }

                	     $delete_courses = "DELETE FROM course WHERE id = " . $id;
                	     $conn->exec($delete_courses);
                	     return true;
                }


                public function upload_image($directory_path , $name_of_input_image){
                           
                            $target_file = $directory_path . '/' . basename($_FILES[$name_of_input_image]['name']);
                            $image_extension = strtolower(pathinfo($target_file , PATHINFO_EXTENSION));
                            $uploadOk = 1;

                            $check = getimagesize($_FILES[$name_of_input_image]['tmp_name']);
                            if ($check !== false) {
                            	$uploadOk = 1;
                            }else{
                            	$uploadOk = 0;
                            	echo "<div class='is_not_image'> This Is Not Image</div>";
                            	return false;
                            }


                            if ($_FILES[$name_of_input_image]['size'] > 500000) {
                            	$uploadOk = 0;
                            	echo "<div class='is_not_image'> Sorry, Your Image Is Too Large</div>";
                                return false;
                            }

                            if(file_exists($target_file)){
                            	$uploadOk = 0;
		                        echo "<div class='is_not_image'> This Image Is Already Exists</div>";
		                        return false;
                            }

                            if ($image_extension !== 'jpg' && $image_extension !== 'jpeg' && $image_extension !== 'png' && 
                            	$image_extension !== 'gif' ) {
	                            	$uploadOk = 0;
			                        echo "<div class='is_not_image'> Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>";
			                        return false;
                            }

                            if ($uploadOk == 1) {
                            	
                            	move_uploaded_file($_FILES[$name_of_input_image]['tmp_name'] , $target_file);
                            }

                            return $target_file;

                }


                public function myTest($data){

                	   $data = htmlspecialchars($data);
                	   $data = trim($data);
                	   $data = strip_tags($data);
                	   $data = stripslashes($data);
                	   return $data;
                }
	                	
	   }


     

?>
