<?php

     require_once '..//session.php';

     if ($_SESSION['user_in']->isadmin != 1 || $_SESSION['user_in'] == false) {
           
           header("location: http://localhost/tasks/courses/userApi/admin.php");
      }

      if (!isset($_GET['id'])) {
        header("location: http://localhost/tasks/courses/userApi/admin.php"); 
      }

      $check_id = $_GET['id'];
      $check_id = (int) $check_id;
      if ($check_id <= 0) {
        
         header("location: http://localhost/tasks/courses/userApi/admin.php");  
      }

     require_once 'userApi.php';
     
     $obj_user = new userApi();

      
     $user_id = $obj_user->get_user_information_by_id($check_id);
     

     $error = '';

     if (is_null($user_id)) {
        
            header("location: http://localhost/tasks/courses/userApi/admin.php"); 
     }

    
     // require_once '..//files/tutorial.php';
     require_once '..//files/navbar.php';

     if (isset($_POST['type'])) {
        
           $input_type = $_POST['specific_type'];
           $obj_user->myTest($input_type);

           if ($input_type == 'Male') {
               
               $input_type = 1;
           }else{

              $input_type = 0;
           }

           if ($user_id->type != $input_type) {
                
                $update_type = $obj_user->update_user($check_id , NULL , NULL , NULL , $input_type , NULL,NULL , $user_id->phone , NULL , NULL , $user_id->isadmin);

             if (!$update_type) {
                 
                 $error = "failed update";
             }
           }
    
      }



      if (isset($_POST['country'])) {
        
           $input_country = $_POST['specific_country'];
           $obj_user->myTest($input_country);

           if ($user_id->country != $input_country) {
               
                $update_country = $obj_user->update_user($check_id, NULL , NULL , NULL , -1 , $input_country ,NULL , $user_id->phone , NULL , NULL , $user_id->isadmin);

             if (!$update_country) {
                 
                 $error = "failed update";
             }
           }


          
      }


      if (isset($_POST['city'])) {
        
           $input_city = $_POST['specific_city'];
           $obj_user->myTest($input_city);

           if ($user_id->city != $input_city) {
            
                 $update_city = $obj_user->update_user($check_id , NULL , NULL , NULL ,-1 ,NULL , $input_city ,          $user_id->phone , NULL , NULL ,$user_id->isadmin);
           

               if (!$update_city) {
                   
                   echo "failed update";
               }
            }
          
      }


       if (isset($_POST['phone'])) {
        
           $input_phone = $_POST['specific_phone'];
           $obj_user->myTest($input_phone);
           
           if ($user_id->phone != $input_phone) {

                $update_phone = $obj_user->update_user($check_id , NULL , NULL , NULL , -1 , NULL , NULL , 
                                $input_phone , NULL , NULL , $user_id->isadmin);

               if (!$update_phone) {
                   
                   echo "failed update";
               }
           }
          

          
      }

      // if (isset($_POST['image'])) {
      
      //     $path_of_database = $obj->upload_image('imageUser' , 'specific_image');
      //     $update_image = $obj->update_user($check_id , NULL , NULL , NULL , $get_user->type , NULL , NULL , $get_user->phone , 
      //                                       $path_of_database , NULL , $get_user->isadmin);
          
      // }

      if (isset($_POST['birth'])) {
        
           $input_birth = $_POST['specific_birth'];
           $obj_user->myTest($input_birth);
           
           if ($user_id->dateBirth != $input_birth) {
               $update_birth = $obj_user->update_user($check_id , NULL , NULL , NULL , -1 , NULL , NULL , 
                           $user_id->phone , NULL , $input_birth , $user_id->isadmin);

             if (!$update_birth) {
                 
                 echo "failed update";
             }
           }
           

          
      }

      if (isset($_POST['admin'])) {
        
           $input_admin = $_POST['specific_admin'];
           $obj_user->myTest($input_admin);

           if ($input_admin == 'Admin') {
            $input_admin = 1;
           }else{
              $input_admin = 0;
           }

           if ($user_id->isadmin != $input_admin) {
               $update_admin = $obj_user->update_user($check_id , NULL , NULL , NULL , -1 , NULL , NULL , 
                               $user_id->phone , NULL , NULL , $input_admin);

             if (!$update_admin) {
                 
                 echo "failed update";
             }
           }
           

          
      }





?>
<div class="error">
      <p><?php echo $error; ?></p>  
</div>

<div class="container">
   <div class="row padding">
        <section class="question_update">
                   
                 <div id='updateType'><P>Update<span> Type</span></P></div>
                 <div id='updateCountry'><P>Update<span> country</span></P></div>
                 <div id='updateTCity'><P>Update<span> City</span></P></div>
                 <div id='updatePhone'><P>Update<span> Phone</span></P></div>
                 <div id='updateImage'><P>Update<span> Image</span></P></div>
                 <div id='updateBirth'><P>Update<span> Birth</span></P></div>
                 <div id='updateAdmin'><P>Is<span> Admin?</span></P></div>
        </section>

                
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
                                   <input type="text" name="specific_phone">
                                   <input type="submit" name="phone" value="update">
                                </form>
         </div>

         <div id='Image' class='alll'>
                          <h1>Update Image</h1>
                          <span id="close5">&times;</span>
                          <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                                   <input type="file" name="specific_image">
                                   <input type="submit" name="image" value="update">
                                </form>
         </div>

         <div id='Birth' class='alll'>

                          <h1>Update Birth</h1>
                          <span id="close6">&times;</span>
                          <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>">
                                   <input type="date" name="specific_birth">
                                   <input type="submit" name="birth" value="update">
                                </form>
         </div>

         <div id='Admin' class='alll'>
                           <h1>Is Admin?</h1>
                           <span id="close7">&times;</span>
                          <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>">
                                    <select name="specific_admin">
                                     <option>Admin</option>
                                     <option>Not Admin</option>
                                   </select>
                                   <input type="submit" name="admin" value="update">
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
    .question_update{
        margin-top: 81px;
    left: 50%;
    transform: translateX(-50%);
    width: 410px;
    transition: all .2s;
    }

    .question_update div{
          
        width: 120px;
    height: 120px;
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

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="http://localhost/tasks/courses/js/html5shiv.min.js"></script>
<script src="..//js/jquer.js"></script>
<script type="text/javascript">
 

$(document).ready(function(){
    
        var modal = document.getElementById('Type');
        var btn1 = document.getElementById('updateType');
        var btn11 = document.getElementById('close');

        btn1.onclick = function() {
         modal.style.display = "block";
       } 
    
      btn11.onclick = function() {
         modal.style.display = "none";
       } 

      var modal2 = document.getElementById('Country');
        var btn2 = document.getElementById('updateCountry');
        var btn22 = document.getElementById('close2');

        btn2.onclick = function() {
         modal2.style.display = "block";
       } 
    
      btn22.onclick = function() {
         modal2.style.display = "none";
       } 

        var modal3 = document.getElementById('City');
        var btn3 = document.getElementById('updateTCity');
        var btn33 = document.getElementById('close3');

        btn3.onclick = function() {
         modal3.style.display = "block";
       } 
    
      btn33.onclick = function() {
         modal3.style.display = "none";
       } 

        var modal4 = document.getElementById('Phone');
        var btn4 = document.getElementById('updatePhone');
        var btn44 = document.getElementById('close4');

        btn4.onclick = function() {
         modal4.style.display = "block";
       } 
    
      btn44.onclick = function() {
         modal4.style.display = "none";
       } 

        var modal5 = document.getElementById('Image');
        var btn5 = document.getElementById('updateImage');
        var btn55 = document.getElementById('close5');

        btn5.onclick = function() {
         modal5.style.display = "block";
       } 
    
      btn55.onclick = function() {
         modal5.style.display = "none";
       } 

        var modal6 = document.getElementById('Birth');
        var btn6 = document.getElementById('updateBirth');
        var btn66 = document.getElementById('close6');

        btn6.onclick = function() {
         modal6.style.display = "block";
       } 
    
      btn66.onclick = function() {
         modal6.style.display = "none";
       } 

        var modal7 = document.getElementById('Admin');
        var btn7 = document.getElementById('updateAdmin');
        var btn77 = document.getElementById('close7');

        btn7.onclick = function() {
         modal7.style.display = "block";
       } 
    
      btn77.onclick = function() {
         modal7.style.display = "none";
       } 

     
  
});
</script>

</body>
</html>


