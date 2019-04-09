<?php 
    
    require_once '..//connect_db.php';
    require_once '..//session.php';
    require_once '..//coursesApi/coursesApi.php';
    require_once '..//topicApi/topicApi.php';

    $obj_courses = new coursesApi();

    if (!isset($_GET['t'])) {
    	
    	header("location: http://localhost/tasks/courses");
    }

    $title_of_topic = $obj_courses->myTest($_GET['t']);

    $topic_information = $obj_courses->get_courses_information_by_name($title_of_topic);


    if (!$topic_information) {
    	
         header("location: http://localhost/tasks/courses");
    }

    $popC = $topic_information->popC + 1 ;
    $update_popC = $obj_courses->update_courses($topic_information->id , NULL , NULL , NULL , 0 , $popC , 
                	                           0 , -1 , -1 , -1);

   $id_of_topic = $topic_information->id;

   $get_courses = $obj_courses->get_courses_information_by_coursesBelong($id_of_topic);

  require_once 'tutorial.php';
  require_once 'navbar.php';
  ?>


  <section class="topics">

        <div class="container-fluid">
            <div class="row">
                <?php for ($i=0; $i <count($get_courses) ; $i++) { ?>
                    
                <div class="col-3">
                      <div class="card text-white bg-dark mb-3" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                              <h3 class="card-header bg-secondary"><?php echo $get_courses[$i]->title ?></h3>
                              <div class="card-body">
                                
                                <img src="..//userApi/<?php //echo $get_user_by_id->image ?>" 
                                class="img-thumbnail rounded float-left img-fluid" width='40px' height="40px">
                                <h5 class="card-title">
                                    <a href="#"><?php //echo $get_user_by_id->name ?></a>
                                </h5>
                              </div>
                              <img style="height: 200px; width: 100%; display: block;" src="<?php 
                                       echo $get_courses[$i]->image ?>" alt="Card image">
                              <div class="card-body"  style="height: 49px; ">
                                     <p class="card-text">
                                        <?php echo substr($get_courses[$i]->description , 0 , 75) ?>...
                                     </p>
                             </div>

                              <div class="card-body">
                                <a href="#" class="card-link" style="color: #9E9D24">Entry</a>
                              </div>
                              <div class="card-footer text-white bg-secondary">
                                <?php 
                                     date_default_timezone_set('Africa/Cairo');
                                     $date_of_course= strtotime($get_courses[$i]->created_at);
                                     $hour_of_cource = date("h" , $date_of_course);
                                     $min_of_course = date("i" , $date_of_course);
                                     $seconds_of_course =date("s" , $date_of_course);
                                     
                                     $form_of_date_course = date("Y-m-d" , $date_of_course);
                                     $date_of_course_by_sec = (time()-strtotime($form_of_date_course))/60/60/24;
                                     
                                     if ($date_of_course_by_sec < 1) {
                                         
                                         if (date("h") - $hour_of_cource >= 1) {
                                             
                                             echo floor(date("h") - $hour_of_cource) . " hour ago";

                                         }elseif (date("i") - $min_of_course >= 1 && date("i") - $min_of_course <= 60) {
                                             
                                             echo floor(date("i") - $min_of_course) . " minute ago";

                                         }elseif (date("s") - $seconds_of_course >= 1 && date("s") - $seconds_of_course <= 60) {

                                             echo floor(date("s") - $seconds_of_course) ." sec ago";
                                         }

                                     }else{

                                         if ( $date_of_course_by_sec > 30 && $date_of_course_by_sec <= 365 ){
                                             
                                             echo floor($date_of_course_by_sec)/30 . " month  ". (floor($date_of_course_by_sec)/30 > 1? 's' : '') ."ago";

                                         }elseif ($date_of_course_by_sec > 365 ) {
                                             echo floor($date_of_course_by_sec)/30/12 ." year ". (floor($date_of_course_by_sec)/30/12 > 1?'s' : '') ." ago";

                                         }else{
                                            echo floor($date_of_course_by_sec) . " day". (floor($date_of_course_by_sec) > 1?'s' : '') ." ago";
                                         } 
                                     }


                                     
                                     
                                     
                                      ?>
                              </div>
                     </div>

                </div>
                <?php } ?>
            </div>
        </div>
</section>

<?php                                
            
        

       
   

?>


<?php
  require_once 'footer.php';

?>

<style type="text/css">
	.main{
		position: absolute;
		height: 694px;
	}

	.fa-lg{
		line-height: 1.7em !important;
	}

	.topics{
         min-height: 100%;
         margin-top: 90px;
    }

    .search-courses:after {
        content: "";
        display: block;
        height: 100px;
    }
    .my-card{
        width: 80%;
    }
    .my-card h1{
        background-color: #616161;
        color: #fff;
        padding: 12px;
        text-transform: capitalize;
        border-radius: 5px 5px 0 0;
        text-align: left;
        margin-bottom: 0

    }
    
    .won-course{
        background-color: #424242;
    }
    .card-header{
        font-family: 'ZCOOL QingKe HuangYou', cursive;
       font-size: 20px;
    }

    .card-title a{
        padding-left: 7px !important;
        font-size: 14px;
        font-family: sans-serif;
        color: #9E9D24;
        text-decoration: none;
        font-weight: normal;
    }
</style>