
 <?php
     
      
      if (file_exists('..//connect_db.php')) {
      	  require_once('..//connect_db.php');
      }else{

      	 echo 'you are not connect with database';
      }


      if (file_exists('..//session.php')) {
              require_once('..//session.php');
      }else{

             echo 'you are not start session';
      }

      if (file_exists('userApi.php')) {
      	   require_once('userApi.php');
      }else{
      	echo "we lost some data";
      }
      
     $error = '';
     $name = '';

     if ($_SERVER["REQUEST_METHOD"] != "POST") {
     	header("location:http://localhost/tasks/courses/" );
     }

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
     	
         	$input_name = $_POST['username'];
         	$input_password = $_POST['password'];
         	$input_email = $_POST['email'];
         

         
         $obj = new userApi();

         $check_name_found_database = $obj->get_user_information_by_name($input_name);
         $check_email_found_database = $obj->get_user_information_by_email($input_email);

        if (!empty($check_name_found_database)) {
         	$conn = null;
         	header( "refresh:5;url=http://localhost/tasks/courses/" );
         	$error="this user is already exists";
        }elseif (!empty($check_email_found_database)) {
         	$conn = null;
         	header( "refresh:5;url=http://localhost/tasks/courses/" );
         	$error="this user is already exists";
        }else{

         
	         $add_user_to_database = $obj->add_user($input_name , $input_password , $input_email);
	         
	         if (!$add_user_to_database) {
	         	
	         	$conn = null;
	         	header( "refresh:5;url=http://localhost/tasks/courses/" );
	         	$error="sorry : this are error happend";
	         }else{

		        $check_name_found_database = $obj->get_user_information_by_name($input_name);
		        $check_name_found_database->password = 0;
		        $_SESSION['user_in'] = $check_name_found_database;
		        $error = "welcome" . $_SESSION['user_in']->name . ": you will redirect to complete your profile if will not <a href='http://localhost/tasks/courses/userApi/edited.php'>click here</a>";
		        header( "refresh:10;url=http://localhost/tasks/courses/userApi/editedProfile.php" );
		        
		        $conn = null;
		    }
		}
        

     }   

require_once('..//files/navbar.php');      

?> 

<div class="$error">
	
</div>

<div class='form_user_edit'>
       <div class='title_of_edit'>
       	        <h2>
       	        	 <?php echo $error ?>
       	        </h2>
       	</div>

   
      
	 <!--  <form action="updateUser.php" method="post">

           <div>
           	      <input type="text" name="name" value="<?php //echo $input_name ?>" disabled>
           </div>
          
          <div class="personal_pic">
			  	   	     <span> edit your photo<p>+</p></span>
			  	   	     <div class="actually_pic"><img src="<?php //echo $_SESSION['user_in']->image; ?>"></div>
			  	   	     <div class="upload_pic" name='image'>
			  	   	     </div>
          </div>
            
            <div>
			  	      <label>type:</label>
			  	      <select name="type" required="required">
			  	      	 <option>Male</option>
			  	      	 <option>F

			  	      	 emal</option>
			  	      </select>
	  	    </div> 
	  	    
	  	    <div>
			  	      <label>country:</label>
			  	      <select name="country" required="required">
			  	      	 <option>egypt</option>
			  	      	 <option>tunnis</option>
			  	      	 <option>yemen</option>
			  	      	 <option>england</option>
			  	      	 <option>america</option>
			  	      	 <option>italia</option>
			  	      </select>
	  	    </div> 

	  	    <div>
	  	    	       <label>city</label>
	  	    	       <input type="text" name="city" required="required">
	  	    </div> 

	  	    <div>
	  	    	       <label>phone</label>
	  	    	       <input type="text" name="phone" required="required">
	  	    </div> 

	  	    <div>
	  	    	       <label>birth</label>
	  	    	       <input type="date" name="birth" required="required">
	  	    </div> 

	  	    <div class="save_edit">
	  	    	 
                 <input type="submit" name="Save" value="save">
	  	    </div>

	  </form> -->
    </div> 
    

<?php require_once '..//files/footer.php' ?>

<style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Oswald|Sunflower:300|Tajawal|Yanone+Kaffeesatz');
	                

	.user_name{

	        top: 8%;
            left: 44%       	
	    }

	.form_user_edit{

			position: absolute;
			background-color: #fff;
			/*top: 86%;*/
			top: 39%;
			left: 50%;
			transform: translate(-50%,-50%);
			width: 70%;
			/*height: 922px;*/
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}

		.form_user_edit h2{
			position: absolute;
			/*left: 50%;
			transform: translate(-50%);*/
			left: 4%;
			width: 100%;
			top: 28px;
			text-transform: uppercase;
			/*font-size: 2rem;*/
			font-size: 1.7rem;
			font-family: 'Sunflower', sans-serif;
		}

		.title_of_edit{

			width: 100%;
			height: 76px;
			background-color: rgba(205,224,54,.6);
		}

        /*.form_user_edit form{

		   margin-top:84px;
        }

	    .form_user_edit form div{
            width: 50%;
			height: 47px;
			box-sizing: border-box;
			margin-left: 52px;
			margin-bottom: 34px;
			transition: all .5s;
	    }


		.form_user_edit form div input{

	        width: 100%;
			height: 100%;
			outline: none;
			border: 1px solid #dfe6e9;
			font-size: 14px;
			font-family: 'Sunflower', sans-serif;
			color:rgba(33,33,33,.8);
			padding: 0 0 0 13px;
			transition: all .5s;
		}

		.form_user_edit form div input:focus,.form_user_edit form div select:focus{

               border:1px solid rgba(205,224,54,.6);
           }

		.form_user_edit form div select{
             
            width: 35%;
            height: 100%;
			-webkit-appearance: none; 
            -moz-appearance: none;
            appearance: none; 
			text-align: center;
			border: 1px solid #dfe6e9;
			background-color: transparent;
			outline: none;
			transition: all .5s;

		}


		.form_user_edit form div label{

			text-transform: capitalize;
			font-size: 13px;
			padding-right: 8px;
		}

		.personal_pic{

			position: absolute;
			top: 50%;
			right: -25%;
		}
		.personal_pic span{

			text-transform: capitalize;
			font-size: 13px;
			font-family: 'Sunflower', sans-serif;
		}

		.personal_pic span p{
			font-size: 14px;
			width: 25px;
			height: 25px;
			background-color: rgba(205,224,54,.6);
			margin-right: 5px;
			border-radius: 50%;
			float: left;
			text-align: center;
			line-height: 24px;
			cursor: pointer;
		}

		.actually_pic{

			position: absolute;
			bottom: 20px;
			right: 334px;
			width: 150px !important;
			height: 150px !important;
			border-radius: 50%;
			overflow: hidden;
			border: 1px solid #dfe6e9;
		}

		.actually_pic img{

            width: 150px;
            height: 150px;
		}

	    .save_edit{
           
            width: 24% !important;
			margin-top: 21px;
			margin-right: 232px;

	    }
        
        .save_edit input{

        	padding: 0;
			text-transform: uppercase;
			letter-spacing: 1px;
			background-color: rgba(205,224,54,.6);
			font-family: 'Sunflower', sans-serif;
			color: rgba(33,33,33,.8);
			padding: 0 0 0 0 !important;
        }*/
    footer{
        
        /*position: absolute;
        bottom: -727px;*/
        margin-top: 377px;
    }



</style>
