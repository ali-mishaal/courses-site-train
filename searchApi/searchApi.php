


<?php

   function getSearch($data){
 
            global $conn;

            try{ 


                $data =  myTest($data);


                $get_search = $conn->prepare("SELECT * FROM course WHERE title LIKE '%{$data}%'");
                $get_search->execute();

                $result = $get_search->setFetchMode(PDO::FETCH_ASSOC);

                $myarray = array();
                foreach ($get_search as $key => $value) {

                    $myarray[count($myarray)] = $value;
                }

                

            }catch(Exception $e){

                $conn = null;
                $error_search = $e->getMessage();
                return $error_search;
                
            }

            return $myarray;

   }

   

function myTest($data){


	$data = trim($data);
	$data = htmlspecialchars($data);
	$data = stripslashes($data);
    $data = strip_tags($data);

	return $data;
}


?>