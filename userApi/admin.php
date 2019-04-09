
<?php

      if (file_exists('..//session.php')) {
        require_once('..//session.php');
      }

      require_once('userApi.php');
      require_once('../topicApi/topicApi.php');
      require_once('../coursesApi/coursesApi.php');

      if ($_SESSION['user_in']->isadmin != 1 || $_SESSION['user_in'] == false) {
        
           header("location: http://localhost/tasks/courses/");
      }


    
      $obj = new userApi();
      $obj1 = new topicApi();
      $obj2 = new coursesApi();

      require_once '..//files/tutorial.php';
      require_once '..//files/navbar.php';
      
?>

      <div class="error" style="position: absolute; left: 50%; transform: translateX(-50%); color: #EF5350;
                                top: 15%;">
            <p><?php if(isset($_SESSION['error']))echo $_SESSION['error'] ; ?></p>  
      </div>

        <div class="main2">
              
              <ul class="userul">
                   <p>users</p>
                   <li><i class="fa fa-caret-right" aria-hidden="true"></i>all users</li>
              </ul>

              <ul class="departmentul">
                   <p>department</p>
                   <li class="departmentul1"><i class="fa fa-caret-right" aria-hidden="true"></i>add depart</li>
                   <li class="departmentul2"><i class="fa fa-caret-right" aria-hidden="true"></i>all depart</li>
              </ul>
                    
              <ul class="topicul">
                   <p>topics</p>
                   <li class="topicul1"><i class="fa fa-caret-right" aria-hidden="true"></i>add topic</li>
                   <li class="topicul2"><i class="fa fa-caret-right" aria-hidden="true"></i>all topic</li>
              </ul>

              <ul class="courseul">
                   <p>courses</p>
                   <li class="courseul1"><i class="fa fa-caret-right" aria-hidden="true"></i>add corses</li>
                   <li class="courseul2"><i class="fa fa-caret-right" aria-hidden="true"></i>all corses</li>
              </ul>
              
        </div>

        <div class="all all_user">
              <!-- <a href='deleteUser.php?id=$id_of_user'> -->
              <?php
                   
                   $all_user = $obj->get_user_information();
                   echo "<table>";
                   echo "<tr>";
                    echo "<th>Name</th>";
                    echo "<th>Email</th>";
                    echo "<th>Update User</th>";
                    echo "<th>Delete User</th>";
                   echo "</tr>";
                   for ($i=0; $i <count($all_user) ; $i++) { 
                       
                       $id_of_user = $all_user[$i]->id ;
                       echo "<tr>";
                       echo "<td>" . $all_user[$i]->name . "</td>";
                       echo "<td>" . $all_user[$i]->email . "</td>";
                       echo "<td><a href='updateUserAdmin.php?id=$id_of_user'>update user</a></td>";
                       echo "<td><a href='deleteUser.php?id=$id_of_user'>delete user</a></td>";
                       echo "</tr>";
                   }

                   echo "</table>";

                  
              ?>
        
        </div>

        <div class="add_depart">
                
                <form method="post" action="../files/done.php">
                    <input type="text" name="nameDepart">
                    <textarea name="desDepart" placeholder="Descripe Of Depart" cols="30" rows="5"></textarea>
                    <input type="submit" name="addDepart" value="Add Depart">
                </form>
                 <div class="add_photo_depart">
                        <p class="button_add_photo_depart">Add Image <span>+</span></p>
                        <img src="..//topicApi/topicPhoto/default.jpg">
                        <div class="add_really_photo">
                          <p class="close_photo_depart">close</p>
                            <form>
                                <input type="file" name="topicPhoto">
                                <input type="submit" name="addTopicPhot">
                            </form>
                        </div>
                    </div>

                
        </div>
        <div class="all_depart">
               <?php
                   
                   $all_depart = $obj1->get_topic_information();
                   echo "<table>";
                   echo "<tr>";
                    echo "<th>title</th>";
                    echo "<th>Update User</th>";
                    echo "<th>Delete User</th>";
                   echo "</tr>";
                   for ($i=0; $i <count($all_depart) ; $i++) { 
                       
                       $id_of_user = $all_depart[$i]->id ;
                       echo "<tr>";
                       echo "<td>" . $all_depart[$i]->title . "</td>";
                       echo "<td><a href='updateDepartAdmin.php?id=$id_of_user'>update depart</a></td>";
                       echo "<td><a href='deleteDepart.php?id=$id_of_user'>delete depart</a></td>";
                       echo "</tr>";

                   }

                   echo "</table>";


              ?>

        </div>

        <div class="add_topic">
                <form method="post" action="../files/done.php">
                    <input type="text" name="nameTopic">
                    <select name="allDepart">
                           <?php
                                for ($i=0; $i < count($all_depart) ; $i++) { 
                                  
                                   echo "<option>" . $all_depart[$i]->title . "</option>";
                                }
                           
                           ?>
                    </select>
                    <textarea name="desTopic" placeholder="Descripe Of Topic" cols="30" rows="5"></textarea>
                    <div class="add_photo_topic"></div>
                    <input type="submit" name="addTopic" value="Add Depart">
                </form>
        </div>  

        <div class="all_topic">
              
               <?php
                     
                   $all_topic = $obj2->get_courses_information_by_type(1);
                   echo "<table>";
                   echo "<tr>";
                   echo "<th>title</th>";
                   echo "<th>discription</th>";
                   echo "<th>Update User</th>";
                   echo "<th>Delete User</th>";
                   echo "</tr>";
                   for ($i=0; $i <count($all_topic) ; $i++) { 
                       
                       $id_of_topic = $all_topic[$i]->id ;
                       echo "<tr>";
                       echo "<td>" . $all_topic[$i]->title . "</td>";
                       echo "<td>" . $all_topic[$i]->description . "</td>";
                       echo "<td><a href='../coursesApi/updateTopic.php?id=$id_of_topic'>update topic</a></td>";
                       echo "<td><a href='../coursesApi/deleteTopic.php?id=$id_of_topic'>delete topic</a></td>";
                       echo "</tr>";

                   }

                   echo "</table>"; 

               ?>
                
        </div>

        
        <div class="add_courses">
               <form method="post" action="../files/done.php">
                    <input type="text" name="nameCourse">
                     <select name="allTopic">
                           <?php
                                for ($i=0; $i < count($all_topic) ; $i++) { 
                                  
                                   if ($all_topic[$i]->type == 1) {
                                     echo "<option>" . $all_topic[$i]->title . "</option>";
                                   }
                                   
                                }
                           
                           ?>
                    </select>
                    <textarea name="desCourse" placeholder="Descripe Of Course" cols="30" rows="5"></textarea>
                    <div class="add_photo_course"></div>
                    <input type="submit" name="addCourse" value="Add Depart">
                </form>
        </div>

        <div class="all_courses">
          
              <?php
                     
                   $all_courses = $obj2->get_courses_information_by_type(0);
                   echo "<table>";
                   echo "<tr>";
                   echo "<th>title</th>";
                   echo "<th>discription</th>";
                   echo "<th>Update User</th>";
                   echo "<th>Delete User</th>";
                   echo "</tr>";
                   for ($i=0; $i <count($all_courses) ; $i++) { 
                       
                       $id_of_courses = $all_courses[$i]->id ;
                       echo "<tr>";
                       echo "<td>" . $all_courses[$i]->title . "</td>";
                       echo "<td>" . $all_courses[$i]->description . "</td>";
                       echo "<td><a href='../coursesApi/updateCourse.php?id=$id_of_courses'>update course</a></td>";
                       echo "<td><a href='..//coursesApi/deleteCourse.php?id=$id_of_courses'>delete course</a></td>";
                       echo "</tr>";

                   }

                   echo "</table>"; 

               ?>
        </div>

 <style type="text/css">
   .main{
    position: absolute;
    height: 692px;
   }
 </style>       

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="http://localhost/tasks/courses/js/html5shiv.min.js"></script>
<script src="../js/wow.min.js"></script>
              <script>
              new WOW().init();
              </script>
<script src="..//js/jquer.js"></script>

       
</body>
</html>

<script type="text/javascript">
 

$(document).ready(function(){
    

    $(".userul li") .css("background-color", "rgba(205,224,54,.6)");
    $(".all_user").show();
    

   $(".userul li").click(function(){
        $(".main2 ul li").css("background-color","transparent");
        $(".userul li") .css("background-color", "rgba(205,224,54,.6)");
        $(".add_depart,.all_depart,.add_topic,.all_topic,.add_courses ,.all_courses").hide('fast');
        $(".all_user").show('slow');
        
    });

   $(".main2 .departmentul .departmentul1").click(function(){
        $(".main2 ul li").css("background-color","transparent");
        $(".main2 .departmentul .departmentul1") .css("background-color", "rgba(205,224,54,.6)");
        $(".all_user,.all_depart,.add_topic,.all_topic,.add_courses ,.all_courses").hide('fast');
        $(".add_depart").show('slow');
        
        
       
    });

   $(".main2 .departmentul .departmentul2").click(function(){
        $(".main2 ul li").css("background-color","transparent");
        $(".main2 .departmentul .departmentul2") .css("background-color", "rgba(205,224,54,.6)");
        $(".all_user,.add_depart,.add_topic,.all_topic,.add_courses ,.all_courses").hide('fast');
        $(".all_depart").show('slow');
    });

   $(".main2 .topicul .topicul1").click(function(){
        $(".main2 ul li").css("background-color","transparent");
        $(".main2 .topicul .topicul1") .css("background-color", "rgba(205,224,54,.6)");
        $(".all_user,.add_depart,.all_depart,.all_topic,.add_courses ,.all_courses").hide('fast');
        $(".add_topic").show('slow');
    });

   $(".main2 .topicul .topicul2").click(function(){
        $(".main2 ul li").css("background-color","transparent");
        $(".main2 .topicul .topicul2") .css("background-color", "rgba(205,224,54,.6)");
        $(".all_user,.add_depart,.all_depart,.add_topic,.add_courses ,.all_courses").hide('fast');
        $(".all_topic").show('slow');

    });

   $(".main2 .courseul .courseul1").click(function(){
        $(".main2 ul li").css("background-color","transparent");
        $(".main2 .courseul .courseul1") .css("background-color", "rgba(205,224,54,.6)");
        $(".all_user,.add_depart,.all_depart,.add_topic,.all_topic,.all_courses").hide('fast');
        $(".add_courses").show('slow');
    });

   $(".main2 .courseul .courseul2").click(function(){
        $(".main2 ul li").css("background-color","transparent");
        $(".main2 .courseul .courseul2") .css("background-color", "rgba(205,224,54,.6)");
        $(".all_user,.add_depart,.all_depart,.add_topic,.all_topic,.add_courses").hide('fast');
        $(".all_courses").show('slow');
    });

   $(".button_add_photo_depart").click(function(){
       
      $(".add_really_photo").fadeIn();
        
   });

   $(".close_photo_depart").click(function(){
       
      $(".add_really_photo").fadeOut();
        
   });
   
  
});
</script>



