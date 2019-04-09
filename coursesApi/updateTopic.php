<?php

      require_once('..//session.php');
      require_once('..//connect_db.php');
      require_once('coursesApi.php');
      require_once('..//topicApi/topicApi.php');


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

      $obj = new coursesApi();
      $obj1 = new topicApi();
      $get_topic = $obj->get_courses_information_by_topic_id($check_id);
      $get_all_topic = $obj->get_courses_information_by_type(1);
      $get_depart = $obj1->get_topic_information();
      $error = '';

      if (is_null($get_topic)) {
         
          header("location: http://localhost/tasks/courses/userApi/admin.php");  
      }



      if (isset($_POST['title'])) {
      	  
      	  $input_title = $_POST['specific_title'];
      	  $input_title = $obj->myTest($input_title);

          if ($get_topic->title != $input_title) {
            $update_title = $obj->update_courses($check_id , $input_title , NULL , NULL , 0 , 0 ,  0 , 1 , 
              -1 , -1);

            if (!$update_title) {
                
                $error = "failed update";
            }
          }

      	  
      }

      if (isset($_POST['desc'])) {
      	  
      	  $input_desc = $_POST['specific_description'];
      	  $input_desc = $obj->myTest($input_desc);

          if ($get_topic->description != $input_desc)
      	  $update_desc = $obj->update_courses($check_id , NULL , $input_desc , NULL , 0 , 0 , 0 , 1 , -1 ,-1);

           if (isset($update_desc) && !$update_desc) {
                
                $error = "failed update";
            }
      }


      if (isset($_POST['image'])) {
      
      	   $path_of_database = $obj->upload_image('courseImage' , 'specific_image');
      	   $update_image = $obj->update_courses($check_id , NULL , NULL , $path_of_database , 0 ,  0 , 0 , -1 , 0 , 0);
      	  
      }

      if (isset($_POST['type'])) {
      
          $input_type = $_POST['specific_type'];
          $input_type = $obj->myTest($input_type);
          $input_topic = $_POST['specific_course_belong'];
          $input_topic = $obj->myTest($input_topic);
          $get_topic_id = $obj->get_courses_information_by_name($input_topic);

          if ($input_type == 'Courses' || $input_type == 'courses') {
              $input_type = 0 ;
              $update_type = $obj->update_courses($check_id , NULL , NULL , NULL , 0 ,  0 , 0 , $input_type , 0 , $get_topic_id->id);

              if (!$update_type) {
                $error = 'update failed';
              }
          }else{
            $error = "must be field equal Topic or topic";
          }    
         
      }


      if (isset($_POST['topicBelong'])) {
      	  
      	  $input_toicBelong = $_POST['specific_topic_belong'];
      	  $input_toicBelong = $obj->myTest($input_toicBelong);
      	  $get_depart_id = $obj1->get_topic_information_by_name($input_toicBelong);
          
          if ($get_topic->topicBelongTo != $get_depart_id->id) {

              $update_desc = $obj->update_courses($check_id , NULL , NULL , NULL , 0 ,  0 , 0 , 1 , 
                                                 $get_depart_id->id , -1);
              if (!$update_desc) {
                  
                  $error = "failed update";
              }
          }
      	 
      }



      require_once '..//files/tutorial.php';
      require_once '..//files/navbar.php';

    

   ?>
<div class="error">
            <p><?php echo $error; ?></p>  
      </div>

<div class='pop pop1'>
              <img src='<?php echo $get_topic->image ?>'>
              <div class='cover_image'></div>

              <div class='word_web_de'>
                <h1><?php echo $get_topic->title; ?></h1>
              </div>
                
              <div class='slide_web_de'>
                     <p> <?php echo $get_topic->description ?></p>
                      <div class='button_slide_web_de'>
                            <a href='#'>ENTRY</a>  
                      </div>
              </div>   
                 
</div>


	  
	  <section class="question_update">
			   <div id='updateTitle'><P>Update<span> Title</span></P></div>
			   <div id='updateDesc'><P>Update<span> Description</span></P></div>
			   <div id='updateImage'><P>Update<span> Image</span></P></div>
         <div id='updateType'><P>Update<span> Type</span></P></div>
			   <div id='updateTopicBelong'><P>Update<span>Topic Belong</span></P></div>
			  
      </section>

      <div id='Title' class='alll'>
       	       	                <h1>UpdateTitle</h1>
       	       	                <span id="close">&times;</span>
       	       	                <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>">
       	       	                	 <input type="text" name="specific_title" 
                                          value="<?php echo $get_topic->title ?>">
       	       	                	 <input type="submit" name="title" value="update">
       	       	                </form>
       	       </div>

			   <div id='Desc' class='alll'>
			   	                   <h1>Update Description</h1>
			   	                   <span id="close2">&times;</span>
			   	                   <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>">
       	       	                	 <textarea name="specific_description"></textarea>
       	       	                	 <input type="submit" name="desc" value="update">
       	       	                </form>
			   </div>

			   <div id='Image' class='alll'>
			   	                <h1>Update Image</h1>
			   	                <span id="close3">&times;</span>
			   	                <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
       	       	                	 <input type="file" name="specific_image">
       	       	                	 <input type="submit" name="image" value="update">
       	       	                </form>
			   </div>

           <div id='Type' class='alll'>
                             <h1>Update Type</h1>
                             <span id="close4">&times;</span>
                             <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>">
                                    <select name="specific_type" style="top: 22%;">
                                           <option selected>courses</option>";
                                   </select>
                                    <select name="specific_course_belong" style="top: 51%;">
                                      <?php
                                           for ($i=0; $i <count($get_all_topic) ; $i++) { 
                                             
                                             if ($get_course->courseBelongTo == $get_all_topic[$i]->id) {
                                               echo "<option selected>" . $get_all_topic[$i]->title . "</option>";
                                             }
                                             echo "<option>" . $get_all_topic[$i]->title . "</option>";
                                           }
                                     
                                    ?> 
                                   </select>
                                   <input type="submit" name="type" value="update">
                                </form>
         </div>



			   <div id='topicBelongTo' class='alll'>
			   	                   <h1>Update Topic Belong</h1>
			   	                   <span id="close5">&times;</span>
			   	                   <form method="post" action="<?php  $_SERVER['PHP_SELF']; ?>">
       	       	                	  <select name="specific_topic_belong">
       	       	                	  	<?php
       	       	                	  	     for ($i=0; $i <count($get_depart) ; $i++) { 

       	       	                	  	     	if($get_topic->topicBelongTo == $get_depart[$i]->id){
                                              echo "<option selected>" . $get_depart[$i]->title . "</option>";
                                            } 
       	       	                	  	     	 echo "<option>" . $get_depart[$i]->title . "</option>";
       	       	                	  	     }
       	       	                	 	 
       	       	                	 	?> 
       	       	                	 </select>
       	       	                	 <input type="submit" name="topicBelong" value="update">
       	       	                </form>
			   </div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="http://localhost/tasks/courses/js/html5shiv.min.js"></script>
<script src="http://localhost/tasks/courses/js/jquer.js"></script>
	  

</body>
</html>

<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Skranji');
    @import url('https://fonts.googleapis.com/css?family=Exo+2|Sunflower:300');
	  .main{
      position: absolute;
      height: 693px;
    }
    .question_update{
        position: absolute;
        top: 53%;
        left: 51%;
        transform: translateX(-50%);
        width: 663px;
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

  .alll form input , .alll form select , .alll form textarea{

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

  .alll form textarea{

    resize: none;
    height: 95px;
    width: 80%;
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

  .pop{
    position: absolute;
  width: 23%;
  height: 327px;
  box-sizing: border-box;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  left: 50%;
  transform: translateX(-50%);
  overflow: hidden;
  top: 20%;
}

.pop img{
    position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-clip: border-box;
  background-origin: content-box;
  background-position: center;
  background-size: cover;
  transform: scale(1.3);
  transition: all .5s;
}

.pop:hover img{

  transform: scale(1);
}

.cover_image{

  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,.3);
  transition: all .2s;
}

.pop:hover .cover_image{

background-color: rgba(0,0,0,0);

}

.word_web_de{

  position: absolute;
  color: #fff;
  top: 69%;
  left: 50%;
  transform: translate(-50%,-50%);
  font-weight: bold;
  font-family: 'Exo 2', sans-serif;
  font-size: 15px;
  transition: all .5s;
}

.pop:hover .word_web_de{

     transform: scale(.5);
}

.word_web_de h1{
  font-weight: bold;
  font-size: 2rem;
  text-transform: capitalize;
}

.slide_web_de{
  position: absolute;
  top: 0;
  left: -100%;
  background-color: rgba(156, 204, 101,.5);
  width: 100%;
  clip-path: polygon(90% 0%, 0% 0%, 0% 100%, 40% 100%);
  height: 100%;
  z-index: 2;
  transition: all .2s;
}

.pop:hover .slide_web_de{

    left: 0;
}

.slide_web_de p{

  margin-top: 0;
  margin-bottom: 1rem;
  position: absolute;
  top: -50%;
  left: 35%;
  transform: translate(-50%,-50%);
  width: 168px;
  color: #fff;
  font-size: 13px;
  font-family: 'Exo 2', sans-serif;
  letter-spacing: 1px;
  transition: all .3s;
  transition-delay: .2s;

}

.pop:hover .slide_web_de p{

  top: 35%;
}
.button_slide_web_de{
  border: 2px solid #fff;
  padding: 12px 20px;
  box-sizing: border-box;
  position: absolute;
  top: -50%;
  left: 9%;
  transition: all .2s;
  transition-duration: .5s;
}

.pop:hover .button_slide_web_de{

  top: 70%;
}

.button_slide_web_de a{
  text-decoration: none;
  color: #fff;
  font-size: 12px;
  letter-spacing: 1px;
}


	</style>

	<script type="text/javascript">
 

$(document).ready(function(){
    
        var modal = document.getElementById('Title');
        var btn1 = document.getElementById('updateTitle');
        var btn11 = document.getElementById('close');

        btn1.onclick = function() {
	       modal.style.display = "block";
	     } 
    
	    btn11.onclick = function() {
	       modal.style.display = "none";
	     } 

	    var modal2 = document.getElementById('Desc');
        var btn2 = document.getElementById('updateDesc');
        var btn22 = document.getElementById('close2');

        btn2.onclick = function() {
	       modal2.style.display = "block";
	     } 
    
	    btn22.onclick = function() {
	       modal2.style.display = "none";
	     } 

        var modal3 = document.getElementById('Image');
        var btn3 = document.getElementById('updateImage');
        var btn33 = document.getElementById('close3');

        btn3.onclick = function() {
	       modal3.style.display = "block";
	     } 
    
	    btn33.onclick = function() {
	       modal3.style.display = "none";
	     } 

       var modal4 = document.getElementById('Type');
        var btn4= document.getElementById('updateType');
        var btn44 = document.getElementById('close4');

        btn4.onclick = function() {
         modal4.style.display = "block";
       } 
    
      btn44.onclick = function() {
         modal4.style.display = "none";
       }

	    
	    var modal5 = document.getElementById('topicBelongTo');
        var btn5 = document.getElementById('updateTopicBelong');
        var btn55 = document.getElementById('close5');

        btn5.onclick = function() {
	       modal5.style.display = "block";
	     } 
    
	    btn55.onclick = function() {
	       modal5.style.display = "none";
	     } 

        
     
  
});
</script>
