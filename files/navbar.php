
<?php

            if (file_exists('..//connect_db.php')) {
              
              require_once('..//connect_db.php');
            }else{

              die('THe COnnection TO DAtaBAse IS LOst');
            } 

                                     

?> 

<!DOCTYPE html>
<html>
<head>
  <title>AHMC</title>

  <meta charset="utf-8">
</head>

<!-- css file plugin -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="..//css/font-awesome.min.css">

<link href="https://fonts.googleapis.com/css?family=ZCOOL+QingKe+HuangYou" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="..//css/croppie.css"> 
<link rel="stylesheet" type="text/css" href="..//css/style.css">
           


<style>
    .my-nav{
        height: 75px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        
    }

    li a{

        font-family: 'ZCOOL QingKe HuangYou', cursive;
        font-size: 18px;
        font-weight: normal;
        color: rgba(255,255,255,.8); !important;
    }

    form .btn-outline-success:hover{
      background-color: #515953 !important;
      color: rgba(255,255,255,.7) !important;
    }

    .dropdown-menu{
      padding-bottom: 0;
      padding-top: 0;
    }

    .dropdown-menu a{
      font-family:sans-serif;
      padding-top: 10px;
      padding-bottom: 10px;
      font-size: 13px;
      color: #000 !important;
      transition: all .5s;
    }

    .dropdown-menu a:hover{
      background-color: #dbdd8d;
    }
</style>    
<body>

<nav class=" navbar-expand-lg navbar navbar-dark bg-dark my-nav">
    
      <a class="navbar-brand" href="http://localhost/tasks/courses/">
            <img src="..//images/logo.png" style="width: 108px;margin-right: 47px;padding-left: 17px;"/>
      </a>
    
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              
              <li class="nav-item">
                <a class="nav-link tutorial-menu" href="#">tutorial</a>
              </li>
              <!-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li> -->
              
            </ul>
              
               <?php 
                    if ($_SESSION['user_in'] == false) 
                        echo '<ul class="navbar-nav mr-auto" style="margin-right: 0 !important;padding-right: 10px;">
                               <li class="nav-item"><a href="http://localhost/tasks/courses/" class="nav-link">login</a></li>
                               <li class="nav-item"><a href="http://localhost/tasks/courses/" class="nav-link">register</a></li>
                          </ul>';
                     
                    else{
                       $personal_pic = $_SESSION['user_in']->image;
                       echo "<ul class='navbar-nav mr-auto' style='margin-right: 0 !important;padding-right: 10px;'nav>
                                <li class='nav-item'> <img class='personal_image_user' src='..//userApi/".$personal_pic . "'></li>
                                <li class ='nav-item dropdown'><a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" . $_SESSION['user_in']->name . "</a>
                                        <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                              <a class='dropdown-item' href='http://localhost/tasks/courses/userApi/myCourses.php'>my courses</a>
                                              <a class='dropdown-item' href='http://localhost/tasks/courses/userApi/editedProfile.php'>edit profile</a>";
                                              if ($_SESSION['user_in']->isadmin == 1) {
                                                echo "<a class='dropdown-item' href='http://localhost/tasks/courses/userApi/admin.php'>admin control</a>";
                                              }

                                             echo "<a class='dropdown-item' href='http://localhost/tasks/courses/userApi/loggedOut.php'>log out</a>
                                              
                                        </div>
                                </li>        
                                      
                         </ul>"; 
                       }

              ?>  
            
           
             
              
        <form class="form-inline my-2 my-lg-0" action="http://localhost/tasks/courses/searchApi/search.php" method="post">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="type to search..." aria-label="Search">    
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="color: rgba(205,224,54,.6);
                                                                                    border-color: rgba(205,224,54,.6);">
              Search
            </button>
        </form>
              
       
                                
          </div>
</nav>


