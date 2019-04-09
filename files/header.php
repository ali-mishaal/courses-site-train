
<?php require_once 'topicApi/topicApi.php'; ?>
<?php require_once 'coursesApi/coursesApi.php'; ?>

<?php
  
     $obj_depart = new topicApi();
     $obj_courses = new coursesApi();

     $get_all_depart = $obj_depart->get_topic_information();



 ?> 

<!DOCTYPE html>
<html>
<head>
  <title>AHMC</title>

  <meta charset="utf-8">
</head>

<!-- css file plugin -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/croppie.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
           

<body>
  
      <!-- ........................................................start header............................ -->
<header class="main">
    
          <div class="div-main-of-header"> <!-- start main -->
                      
                <video preload="auto" autoplay="autoplay" type="video/mp4" src="images/video1.mp4" loop></video>	    
                	   
                <div class="search"> <!-- start search --> 


                        <div class="left-search"><i class="fa fa-search" aria-hidden="true"></i></div>
                        <form action="searchApi/search.php" method="post">
                            <input class="input-search" type="search" name="search" placeholder="type to search...">
                        </form>


                </div> <!-- end search -->
                           
                 <img class="logo-img" src="images/logo.png"/><!-- start logo -->
                 <p class="logo-p">get the free courses...</p><!-- end logo -->
                
                      
<?php 
    if($_SESSION['user_in'] == false){
        require_once 'files/register.php';
    }else{
        $personal_pic = $_SESSION['user_in']->image; 

?>
                 <div class ='user_name'>

                               <img class='personal_image_user' src='userApi/<?php echo $personal_pic; ?>'>
                                 <div class='personal_name_user'>
                                         <p><?php echo $_SESSION['user_in']->name; ?> </p>
                                         <div class='list_user_profile'>
<?php
     if($_SESSION['user_in']->isadmin == 1){
?>                                           <ul class = 'list_of_user1'> 
<?php }else{?>
                                             <ul class = 'list_of_user'>
<?php }?>
                                                   <li><a href='userApi/myCourses.php'>my courses</a></li>
                                                   <li><a href='userApi/editedProfile.php'>edit profile</a></li>
                                                 
<?php if($_SESSION['user_in']->isadmin == 1){
                                                 
                                                 echo"<li><a href='userApi/admin.php'>control admin</a></li>";
}?>
                                                 
                                                  
                                                   <li><a href='userApi/loggedOut.php'>log out</a></li>
                                             </ul>
                                        
                                             
                                         </div> 
                                  </div> 
<?php } ?>
                    </div> 
                   

                      <div class="social"> <!-- start social -->

                              <ul>
                                  <li><a href="#"><i class="fa fa-facebook" style="width: 30px"></i></a></li>
                                  <li><a href="#"><i class="fa fa-twitter" style="width: 30px"></i></a></li>
                                  <li><a href="#"><i class="fa fa-linkedin" style="width: 30px"></i></a></li>
                                  <li><a href="#"><i class="fa fa-vimeo" style="width: 30px"></i></a></li>
                                  <li><a href="#"><i class="fa fa-youtube"  style="width: 30px"></i></a></li>

                              </ul>
                            
                      </div> <!-- end social -->

                      <div class="tutorial"> <!-- start tutorial -->

                              <div class="tutorial-menu"> <!-- start tutorial-menu -->

                                      

                                     <div class="tutorial-line-style">  <!-- start tutoria-line-style -->
                                            <ul>
                                                <li></li>
                                                <li></li>
                                                <li></li>
                                            </ul>
                                     </div><!-- end tutoria-line-style -->
                             </div><!-- end tutorial-menu -->
                          
                          <div class="tutorial-content"> <!-- start tutorial-content -->

                                     <div class="close1">
                                           <i class="fa fa-times fa-lg" aria-hidden="true"></i>
                                    </div>

                                    <nav>
                                      
                                        <ul class="main-ul">

                                           
                                          <?php for ($i=0; $i < count($get_all_depart) ; $i++) { 
                                                $get_all_topic = $obj_courses->get_courses_information_by_id($get_all_depart[$i]->id);
                                              ?>
                                              <li class="li-main-ul toggle<?php echo $i+1; ?> ">
                                                    <a href="#">
                                                         <p><?php echo $get_all_depart[$i]->title; ?></p>
                                                         <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                    </a>     
                                                    <div class="development">
                                                                 <ul>

                                                                  <?php for ($x=0; $x < count($get_all_topic); $x++) {  $title=$get_all_topic[$x]->title;

                         echo "<li><a href='files/topics.php?t=$title'>"; ?>
                                                                 <p><?php echo
                                                                     $title; ?></p></a></li>

                                                                   <?php }?>
                                                                 </ul>
                                                    </div>
                                             </li> 

                                      <?php } ?>  
                                        </ul>     

                                    </nav>



                              </div>  <!-- end tutorial-content -->


                      </div>  <!-- end tutorial  -->
                	    

                	    
                   
                
                </div>	<!-- end main -->

                              