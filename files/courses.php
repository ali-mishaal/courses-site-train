<?php 
    
    require_once '..//connect_db.php';
    require_once '..//session.php';
    require_once '..//coursesApi/coursesApi.php';
    require_once '..//topicApi/topicApi.php';

    $obj_courses = new coursesApi();

    if (!isset($_GET['t'])) {
    	
    	header("location: http://localhost/tasks/courses");
    }

    $title_of_course = $obj_courses->myTest($_GET['t']);

    $course_information = $obj_courses->get_courses_information_by_name($title_of_course);


    if (!$course_information) {
    	
         header("location: http://localhost/tasks/courses");
    }

    $popC = $course_information->popC + 1 ;
    $update_popC = $obj_courses->update_courses($course_information->id , NULL , NULL , NULL , 0 , $popC , 
                	                           0 , -1 , -1 , -1);

  require_once 'tutorial.php';
  require_once 'navbar.php';
  ?>
