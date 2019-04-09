<?php

     require_once '..//session.php';

     if ($_SESSION['user_in'] == false) {

     	header("location: http://localhost/tasks/courses/");
     }

     
     require_once 'userApi.php';
     
     $obj_user = new userApi();
    

     
      
     $user_id = $_SESSION['user_in']->id;
     $error = '';
  
     if (isset($_POST['name'])) {
      	
      	   $input_name = $_POST['specific_name'];
      	   $obj_user->myTest($input_name);
      	   $get_user_by_name = $obj_user->get_user_information_by_name($input_name);

      	   if (!empty($get_user_by_name) && $input_name != $_SESSION['user_in']->name) {
      	   	   
      	   	   $error = "this name is already exists";
      	   }elseif($input_name == $_SESSION['user_in']->name){
                  
               $error = "you already have this name";
      	   }else{

	      	   $update_name = $obj_user->update_user($user_id , $input_name , NULL , NULL ,-1 , NULL ,NULL , 
	      	   	              $_SESSION['user_in']->phone , NULL , NULL , $_SESSION['user_in']->isadmin);


	      	   if (!$update_name) {
	      	   	   
	      	   	   $error = "failed update name";
	      	   }else{

	      	   	    $_SESSION['user_in']->name = $input_name;
	      	   }
	       }

      	  
      }


      if (isset($_POST['email'])) {
      	
      	   $input_email = $_POST['specific_email'];
      	   $obj_user->myTest($input_email);

      	   $get_user_by_email = $obj_user->get_user_information_by_email($iput_email);

      	   if (!empty($get_user_by_email) && $input_email != $_SESSION['user_in']->email) {
      	   	   
      	   	   $error = "this email is already exists";
      	   }elseif ($input_email == $_SESSION['user_in']->email) {
      	           
      	           $error = "you already have this email";
      	   }else{

	      	   $update_email = $obj_user->update_user($user_id , NULL , NULL , $input_email , -1 , NULL , NULL ,$_SESSION['user_in']->phone , NULL , NULL , $_SESSION['user_in']->isadmin);

	      	   if (!$update_email) {
	      	   	   
	      	   	   $error = "failed update";
	      	   }else{

	      	   	$_SESSION['user_in']->email = $input_email;
	      	   }
	       }

      	  
      }

       if (isset($_POST['password'])) {
      	
      	   $input_pass = $_POST['specific_password'];

      	   $get_pass = $obj_user->get_user_information_by_id($_SESSION['user_in']->id);
           $get_pass = $get_pass->password;

      	   if (strcmp($input_pass, $get_pass) !== 0  ) {

      	           $update_pass = $obj_user->update_user($user_id , NULL , $input_pass , NULL , -1 , NULL , NULL ,$_SESSION['user_in']->phone , NULL , NULL , $_SESSION['user_in']->isadmin);


		      	   
		      	   if (!$update_pass) {
		      	   	   
		      	   	   $error = "failed update";
		      	   }else{

		      	   	  header("location: http://localhost/tasks/courses/userApi/loggedOut.php"); 
		      	   }
      	           
      	   }else{
                   $error = "you already have this password";
	      	   

      	  }
       }

     if (isset($_POST['type'])) {
      	
      	   $input_type = $_POST['specific_type'];
      	   $obj_user->myTest($input_type);

      	   if ($input_type == 'Male') {
      	   	   
      	   	   $input_type = 1;
      	   }else{

      	   	  $input_type = 0;
      	   }

      	   if ($_SESSION['user_in']->type != $input_type) {
      	   	    
      	   	    $update_type = $obj_user->update_user($user_id , NULL , NULL , NULL , $input_type , NULL,NULL , $_SESSION['user_in']->phone , NULL , NULL , $_SESSION['user_in']->isadmin);

	      	   if (!$update_type) {
	      	   	   
	      	   	  $error =  "failed update";
	      	   }else{
	      	   	$_SESSION['user_in']->type = $input_type;
	      	   }
      	   }
	  
      }

      if (isset($_POST['country'])) {
      	
      	   $input_country = $_POST['specific_country'];
      	   $obj_user->myTest($input_country);

           if ($_SESSION['user_in']->country != $input_country) {
           	   
           	    $update_country = $obj_user->update_user($user_id , NULL , NULL , NULL , -1 , $input_country ,NULL , $_SESSION['user_in']->phone , NULL , NULL , $_SESSION['user_in']->isadmin);

	      	   if (!$update_country) {
	      	   	   
	      	   	 $error = "failed update";
	      	   }else{

	      	   	$_SESSION['user_in']->country = $input_country;
	      	   }
           }


      	  
      }


      if (isset($_POST['city'])) {
      	
      	   $input_city = $_POST['specific_city'];
      	   $obj_user->myTest($input_city);

           if ($_SESSION['user_in']->city != $input_city) {
           	
      	         $update_city = $obj_user->update_user($user_id , NULL , NULL , NULL ,-1 ,NULL , $input_city ,          $_SESSION['user_in']->phone , NULL , NULL , $_SESSION['user_in']->isadmin);
           

		      	   if (!$update_city) {
		      	   	   
		      	   	   $error =  "failed update";
		      	   }else{
		      	   	$_SESSION['user_in']->city = $input_city;
		      	   }
            }
      	  
      }

       if (isset($_POST['phone'])) {
      	
      	   $input_phone = $_POST['specific_phone'];
      	   $obj_user->myTest($input_phone);
           
           if ($_SESSION['user_in']->phone != $input_phone) {

                $update_phone = $obj_user->update_user($user_id , NULL , NULL , NULL , -1 , NULL , NULL , 
      	   	                    $input_phone , NULL , NULL , $_SESSION['user_in']->isadmin);

		      	   if (!$update_phone) {
		      	   	   
		      	   	   $error =  "failed update";
		      	   }else{
		      	   	$_SESSION['user_in']->phone = $input_phone;
		      	   }
           }
      	  

      	  
      }

      // if (isset($_POST['image'])) {
      
      // 	   $path_of_database = $obj->upload_image('imageUser' , 'specific_image');
      // 	   $update_image = $obj->update_user($check_id , NULL , NULL , NULL , $get_user->type , NULL , NULL , $get_user->phone , 
      // 	   	                                 $path_of_database , NULL , $get_user->isadmin);
      	  
      // }

      if (isset($_POST['birth'])) {
      	
      	   $input_birth = $_POST['specific_birth'];
      	   $obj_user->myTest($input_birth);
           
           if ($_SESSION['user_in']->dateBirth != $input_birth) {
           	   $update_birth = $obj_user->update_user($user_id , NULL , NULL , NULL , -1 , NULL , NULL , 
      	   	               $_SESSION['user_in']->phone , NULL , $input_birth , $_SESSION['user_in']->isadmin);

	      	   if (!$update_birth) {
	      	   	   
	      	   	   $error = "failed update";
	      	   }else{
	      	   	$_SESSION['user_in']->dateBirth = $input_birth;
	      	   }
           }
      	   

      	  
      }
$empty_message ='';
      

require_once '..//files/tutorial.php';
     require_once '..//files/navbar.php';



?>
<div class="error">
      <p><?php echo $error; ?></p>	
</div>

<div class="container">
	   <div class="row padding">
	   	    <div class="col-8 profile-information">
	   	       <img src="<?php echo $_SESSION['user_in']->image; ?>" class="img-thumbnail image-fluid">
	   	       <h4><?php echo $_SESSION['user_in']->name; ?></h4>
	   	       <hr class="col-8">
	   	       <p id="profile-email"><span>Email</span> : <?php echo $_SESSION['user_in']->email; ?></p>
	   	       <hr class="col-8">
	   	        <p id="profile-country"><span>Country</span> : <?php echo $_SESSION['user_in']->country; ?></p>
	   	       <p id="profile-city"><span>City</span> : <?php echo $_SESSION['user_in']->city; ?></p>
	   	       
	   	       <hr class="col-8">
	   	       <p id="profile-birth"><span>Birth</span> : <?php echo $_SESSION['user_in']->dateBirth; ?></p>
	   	       <hr class="col-8">
	   	       <p class="profile-type"><span>Type</span> : <?php echo $_SESSION['user_in']->type; ?></p>
	   	       <hr class="col-8">

	   	       <p id="profile-phone"><span>Phone</span> : <?php echo $_SESSION['user_in']->phone; ?></p>
	   	      
	   	    </div>
	   </div>
</div>

<div class="container">
	 <div class="row padding">
				<section class="question_update">
					           <div id='updateName'><P>Update<span> Name</span></P></div>
					           <div id='updateEmail'><P>Update<span> Email</span></P></div>
					           <div id='updatePassword'><P>Update<span> Password</span></P></div>
							   <div id='updateType'><P>Update<span> Type</span></P></div>
							   <div id='updateCountry'><P>Update<span> country</span></P></div>
							   <div id='updateTCity'><P>Update<span> City</span></P></div>
							   <div id='updatePhone'><P>Update<span> Phone</span></P></div>
							   <div id='updateImage'><P>Update<span> Image</span></P></div>
							   <div id='updateBirth'><P>Update<span> Birth</span></P></div>
				</section>

                <div id='Name' class='alll'>
                	          
			   	                <h1>Update name</h1>
			   	                <span id="close8">&times;</span>
			   	                <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>">
       	       	                	 <input type="text" name="specific_name" 
       	       	                	        placeholder="<?php echo $_SESSION['user_in']->name ?>" required>
       	       	                	 <input type="submit" name="name" value="update">
       	       	                </form>
			    </div>

			    <div id="Email" class='alll'>
			   	                <h1>Update email</h1>
			   	                <span id="close9">&times;</span>
			   	                <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>">
       	       	                	 <input type="email" name="specific_email" 
       	       	                	        value="<?php echo $_SESSION['user_in']->email ?> " required>
       	       	                	 <input type="submit" name="email" value="update">
       	       	          </form>
			    </div>

			   <div id='Password' class='alll'>
			   	                <h1>Update password</h1>
			   	                <span id="close10">&times;</span>
			   	                <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>" name='form'>
       	       	                	 <input type="password" name="check" id="input-password">
       	       	                	 <div id="feedback-pass">
       	       	                	     
       	       	                	
                                    </div>

       	       	                	 <input type="submit" name="password" value="update">
       	       	          </form>
			   </div>
       	     
       	       <div id='Type' class='alll'>
       	       	                <h1>UpdateType</h1>
       	       	                <span id="close">&times;</span>
       	       	                <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>">
       	       	                	 <select name="specific_type">
       	       	                	 	 <option>Male</option>
       	       	                	 	 <option>Female</option>
       	       	                	 </select>
       	       	                	 <input type="submit" name="type" value="update">
       	       	                </form>
       	       </div>

			   <div id='Country' class='alll'>
			   	                   <h1>Update country</h1>
			   	                   <span id="close2">&times;</span>
			   	                   <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>">
       	       	                	 <select name="specific_country">
       	       	                	 	 <option>Egypt</option>
       	       	                	 	 <option>France</option>
       	       	                	 	 <option>Italy</option>
       	       	                	 </select>
       	       	                	 <input type="submit" name="country" value="update">
       	       	                </form>
			   </div>

			   <div id='City' class='alll'>
			   	                <h1>Update City</h1>
			   	                <span id="close3">&times;</span>
			   	                <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>">
       	       	                	 <select name="specific_city">
       	       	                	 	 <option>cairo</option>
       	       	                	 	 <option>alex</option>
       	       	                	 	 <option>menouf</option>
       	       	                	 </select>
       	       	                	 <input type="submit" name="city" value="update">
       	       	                </form>
			   </div>

			   <div id='Phone' class='alll'>
			   	                <h1>Update Phone</h1>
			   	                <span id="close4">&times;</span>
			   	                <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>">
       	       	                	 <input type="text" name="specific_phone" required="">
       	       	                	 <input type="submit" name="phone" value="update">
       	       	                </form>
			   </div>

			   <div id='Image' class='alll'>
   	                <h1>Update Image</h1>
   	                <span id="close5">&times;</span>
   	                <div class="user-box">
   	                	  <div class="image-relative">
   	                	  	    <div class="overlay uploadProcess" style="display: none;">
   	                	  	    	  <div class="overlay-content">
   	                	  	    	  	    <img src="imageUser/loading.gif">
   	                	  	    	  </div>
   	                	  	    </div>

   	                	  	    <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>"       enctype="multipart/form-data" id="picUploadForm" 
   	                	  	    	   target="uploadTarget">
       	                	       <input type="file" name="specific_image" id="upload-demo" style="display: none;">
       	                	       <!-- <input type="submit" name="image" value="update"> -->
       	                        </form>

                                <iframe src="#" id="uploadTarget" name="uploadTarget" style="width: 0;height: 0; border: 0px solid #fff;"></iframe>
       	                        <a class="editLink" href="javascript:void(0);">edit</a>
       	                        <img src="<?php echo $_SESSION['user_in']->image; ?>" id="imagePreview">


   	                	  </div>
   	                </div>
   	                
			   </div>

			   <div id='Birth' class='alll'>

			   	                <h1>Update Birth</h1>
			   	                <span id="close6">&times;</span>
			   	                <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>">
       	       	                	 <input type="date" name="specific_birth" style="top: 23% !important;" required>
       	       	                	 
       	       	                	 <input type="submit" name="birth" value="update">
       	       	                </form>
			   </div>

     </div>
     </div>  



<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Skranji');
    @import url('https://fonts.googleapis.com/css?family=Exo+2|Sunflower:300');
    .main{
    	position: absolute;
    	height: 693px;
    }

    .profile-information{
         
         position: absolute;
         left: 35%;
         top: 23%;
    }

    .profile-information img{
    	width: 150px;
    	height: 150px;
    }

    .profile-information h4{
    	position: absolute;
		left: 22%;
		top: 6%;
		font-size: 27px;
		text-transform: capitalize;
		font-family: sunflower;
    }

    .profile-information p{
    	margin: 23px;
        font-size: 13px;
    }

    .profile-information p>span{

    	font-weight: 800;

    }

    #profile-city{
    	position: absolute;
        top: 229px;
		left: 28%;
    }
	  .question_update{
        margin-top: 26px;
		left:11%;
		transform: translateX(-50%);
		width: 273px;
		transition: all .2s;
	  }

	  .question_update div{
          
        width: 120px;
		height: 106px;
		background-color: #E6EE9C;
		border-radius: 5px;
        display: inline-block;
		box-sizing: border-box;
		margin: 5px;
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);

	  }

	.question_update div p{

		font-family: 'Exo 2', sans-serif;
		font-size: 16px;
		padding: 25px 10px 10px 10px;
		text-align: center;
		box-sizing: border-box;
		cursor: pointer;
		line-height: 44px;
	} 

	.question_update div p span{

		display: block;
	} 

	.alll{

		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0,0,0,.7);
		display: none;
		transition: all .2s
	}

	.alll h1{
           
        position: absolute;
		font-family: 'ZCOOL QingKe HuangYou', cursive;
		left: 50%;
		transform: translateX(-50%);
		top: 23%;
		background-color: #757575;
		padding: 16px;
		border-radius: 5px 5px 0 0;
		font-size: 26px;
		width: 32%;
        text-align: center;

	}

	.alll span{
		position: absolute;
	    top: 24%;
	    left: 62%;
	    font-size: 24px;
	    color: #3f3939;
	    transition: all .5s;
	}

	.alll span:hover{
		cursor: pointer;
		color: #0e0c0c;
	}

	.alll form{
		position: absolute;
		font-family: 'ZCOOL QingKe HuangYou', cursive;
		left: 50%;
		transform: translateX(-50%);
		top: 32%;
		background-color: #212121;
		width: 32%;
		height: 25%;
		border-radius: 0 0 5px 5px;
	}

	.alll form input , .alll form select{

        width: 64%;
		position: absolute;
		top: 38%;
		left: 50%;
		transform: translate(-50%,-50%);
		height: 45px;
		background-color: transparent;
		border: 1px solid rgba(70, 71, 70, 0.5);
		padding-left: 10px;
		font-size: 16px;
        color: #99978a;
	}

	.alll form input[type="submit"]{

		position: absolute;
		top: 74%;
		left: 50%;
		background-color: #AFB42B;
		height: 30px;
		width: 84px;
		border: transparent;
		transform: translateX(-50%);
		font-family: sans-serif;
		font-size: 11px;
		border-radius: 2px;
		color: #212121;
        padding-left: 0;
		transition: all .5s;

	}

	#Password form input:first-of-type{
		top: 22%;
	}

	

	#feedback-pass{
		position: absolute;
		top: 51%;
		left: 0;
		color: #fff;
		width: 100%;
	}

	#feedback-pass p {
		position: absolute;
		left: 50%;
		transform: translate(-50%);
		color: #a59b9b
    }

	.alll form input[type="submit"]:hover{
		cursor: pointer;
		background-color: #D4E157;
	}

	.error{
		position: absolute;
		left: 50%;
		transform: translateX(-50%);
		color: #EF5350;
        top: 17%;
	}
	.error p{
		font-size: 13px;
	}

	
</style>




<?php 
      require_once '..//files/footer.php';
?>

<script type="text/javascript">
	$(document).ready(function(){
	 $('#feedback-pass').load('checkpassword.php');

	 $('#input-password').keyup(function(){
        
        $.post('checkpassword.php', { check: form.check.value },
        	function(result){

                  $('#feedback-pass').html(result).show();

        	});

    });


	 $(".editLink").on('click'function(e){
        e.preventDefault();
        $("#upload-demo:hidden").trigger('click');
	 });

	 $("#upload-demo").on('change',function(){
          var image = $("#upload-demo").val();
          var img_ex = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

          if(!img_ex.exxec(image)){
          	 alert('please upload only .jpg/.jpeg/.png/.gif file.');
          	 $('#upload-demo').val('');
          	 return false;
          }else{
          	$('.uploadProcess').show();
          	$('#uploadForm').hide();
          	$("picUploadForm").submit();
          }
	 });



	});

	function completeUpload(success, filename){
	 	if (success == 1) {

	 		$('#imagePreview').attr("src","");
	 		$('#imagePreview').attr("src",filename);
	 		$('#upload-demo').attr("value",filename);
	 		$('.uploadProcess').hide();
	 	}else{
	 		$('.uploadProcess').hide();
	 		alert('there as an error during ile upload');
	 	}
	 	return true;
	 }
</script>

  
                  
       
        