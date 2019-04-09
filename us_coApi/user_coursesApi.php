<?php


    function get_all_information($where_what = ''){
	         
	          global $conn;

	          try{
	             
	              $all_select = $conn->prepare("SELECT * FROM users_and_courses ". $where_what);
	              $all_select->execute();

	              $result = $all_select->setFetchMode(PDO::FETCH_OBJ);

	              $myarray = array();
	              foreach ($all_select->fetchAll() as $key => $value) {
	              	
	                  $myarray[count($myarray)] = $value;
	              }
                  
	              
	              if (empty($myarray)) {
                      echo 'empty';
	              	return NULL;
	              }

                  
	              }catch(Exception $e){

	              $conn = null;
	    	      return NULL;
	              }

	              return $myarray;

	        
 }   

    function get_courses_id_by_user_id($id){
        
        $id = (int) $id;

	       if ($id <= 0) {
	       	 
	          return NULL;
	       }

	      $course_id_select= get_all_information('WHERE uid =' . $id);

	       return $course_id_select;
    }











?>