<style>
    .content-se{
        position: absolute;
        top: 19%;
        transform: translateY(-50%);
        
    }


</style>


<?php
    require_once('..//session.php');
   
    require_once('searchApi.php');
    require_once('..//userApi/userApi.php');

    $obj_user = new userApi();


    function time_post($time_since_post){

          // $time_since_post = abs($time_since_post ); //to remove the negative sign
        //echo $time_since_post;

         if ($time_since_post <= 60) {
                                                         
                $time = ceil($time_since_post);
                echo $time . ' sec ago';

         }elseif($time_since_post <= (60*60)){

                $time = ceil($time_since_post/60);
                echo $time . ' min ago';

         }elseif($time_since_post <= (60*60*60)){

                $time = ceil($time_since_post/60/60);
                echo $time . ' hour ago';

         }elseif($time_since_post <= (60*60*60*24)){

                  $time = ceil($time_since_post/60/60/24 );
                   echo $time . ' day ago';

         }elseif($time_since_post <= (60*60*60*24*360)){

                  $time = ceil($time_since_post/60/60/24/360) ;
                  echo $time . ' year ago';

         }else{

                  echo $time = 'just now';

              } 
     }

    
        if (!isset($_POST['search']) || empty($_POST['search'])) {

            $conn = null;
            echo '<p class="no-isset">No Results Found</p>';
        }else{

            $post_search = $_POST['search'];
            $result_search = getSearch($post_search);
            if (empty($result_search)) {

                echo "<p class='no_result'>No Result Found</p>";
            }else{ ?>

    <?php require_once '..//files/tutorial.php'; ?>
    <?php require_once '..//files/navbar.php'; ?>
<section class="search-courses">

        <div class="container-fluid">
            <div class="row">
                <?php for ($i=0; $i <count($result_search) ; $i++) { ?>
                    
                <div class="col-3">
                      <div class="card text-white bg-dark mb-3" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                              <h3 class="card-header bg-secondary"><?php echo $result_search[$i]['title'] ?></h3>
                              <div class="card-body">
                                <?php 
                                  
                 $get_user_by_id = $obj_user->get_user_information_by_id($result_search[$i]['coursesBelongTo']);
                                     
                                     
                                ?>
                                <img src="..//userApi/<?php //echo $get_user_by_id->image ?>" 
                                class="img-thumbnail rounded float-left img-fluid" width='40px' height="40px">
                                <h5 class="card-title">
                                    <a href="#"><?php //echo $get_user_by_id->name ?></a>
                                </h5>
                              </div>
                              <img style="height: 200px; width: 100%; display: block;" src="<?php echo $result_search[$i]['image'] ?>" alt="Card image">
                              <div class="card-body"  style="height: 49px; ">
                                     <p class="card-text">
                                        <?php echo substr($result_search[$i]['description'] , 0 , 75) ?>...
                                     </p>
                             </div>

                              <div class="card-body">
                                <a href="#" class="card-link" style="color: #9E9D24">Entry</a>
                              </div>
                              <div class="card-footer text-white bg-secondary">
                                <?php 
                                     date_default_timezone_set('Africa/Cairo');
                                     $date_of_course= strtotime($result_search[$i]['created_at']);
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
            }
        }

    echo '</div>';
       
   

?>

<style type="text/css">
    .main{
        position: absolute !important;
        height: 695px;
    }

    .fa-lg{
        line-height: 1.7em !important;
    }
    .search-courses{
         min-height: 100%;
         margin-bottom: -100px;
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
<?php
require_once('..//files/footer.php');

?>



