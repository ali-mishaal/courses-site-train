<?php

      if (file_exists('..//session.php')) {
        require_once('..//session.php');
      }

      require_once('..//connect_db.php');
      require_once('../topicApi/topicApi.php');
      require_once('..//coursesApi/coursesApi.php');

      $obj = new topicApi();
      $obj1 = new coursesApi();
      $_SESSION['error'] = '';

     if (isset($_POST['addDepart'])) {
         
         $input_title =  $_POST['nameDepart'];
         $input_desc = $_POST['desDepart'];

         
         $check_depart = $obj->get_topic_information_by_name($input_title);
         
         if (!empty($check_depart)) {
             
             $_SESSION['error'] = 'this depart is already exists';
             header("location: http://localhost/tasks/courses/userApi/admin.php");
         }else{

             $add_depart = $obj->add_topic($input_title , $input_desc,'topicPhoto/default.jpg');
             
             if (!$add_depart) {
                 $_SESSION['error'] = 'add depart failed';
                 header("location: http://localhost/tasks/courses/userApi/admin.php");
             }else{
                $_SESSION['error'] = 'depart added';
                header("location: http://localhost/tasks/courses/userApi/admin.php");
             }
        }
           

     }

      if (isset($_POST['addTopic'])) {
         
         $input_title =  $_POST['nameTopic'];
         $input_desc = $_POST['desTopic'];
         $input_depart = $_POST['allDepart'];
         
         $get_depart = $obj->get_topic_information_by_name($input_depart);
         $check_topic = $obj1->get_courses_information_by_name($input_title);
         
         if (!empty($check_topic)) {
             if ($check_topic->type == 1) {
                 
                 $_SESSION['error'] ='this topic is already exists';
                 header("location: http://localhost/tasks/courses/userApi/admin.php");
             }
             
         }else{

             $add_topic = $obj1->add_courses($input_title ,$input_desc , '..//coursesApi/courseImage/defaultTopic.jpeg' , 1 , 1 , 1 , 1 , $get_depart->id , 0);

             if (!$add_topic) {

                 $_SESSION['error'] = 'add topic failed';
                 header("location: http://localhost/tasks/courses/userApi/admin.php");
             }else{
                $_SESSION['error'] = 'depart added';
                header("location: http://localhost/tasks/courses/userApi/admin.php");
             }
        }
         


     }

     if (isset($_POST['addCourse'])) {
         
         $input_title =  $_POST['nameCourse'];
         $input_desc = $_POST['desCourse'];
         $input_topic = $_POST['allTopic'];
         
         $get_topic = $obj1->get_courses_information_by_name($input_topic);
         $check_courses = $obj1->get_courses_information_by_name($input_title);
         
         if (!empty($check_courses)) {
             if ($check_courses->type == 0) {
                 
                 $_SESSION['error'] = 'this courses is already exists';
                 header("location: http://localhost/tasks/courses/userApi/admin.php");
             }
             
         }else{
             
             $add_courses = $obj1->add_courses($input_title ,$input_desc , '..//coursesApi/courseImage/defaultCourse.jpeg' , 1 , 1 , 1 , 0 , 0 , $get_topic->id);
             
             if (!$add_courses) {
                 $_SESSION['error'] = 'add course failed';
                 header("location: http://localhost/tasks/courses/userApi/admin.php");
             }else{
                $_SESSION['error'] = 'course added';
                header("location: http://localhost/tasks/courses/userApi/admin.php");
             }
        }


     }





?>