

<?php require_once('..//topicApi/topicApi.php'); ?>
<?php require_once('..//coursesApi/coursesApi.php'); ?>

<?php
     
     $obj_depart = new topicApi();
     $obj_courses = new coursesApi();

     $get_all_depart = $obj_depart->get_topic_information();


 ?> 

<header class="main">

   <div class="tutorial"> <!-- start tutorial -->

          <div class="tutorial-content "> <!-- start tutorial-content -->

                 <div class="close1" >
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

                                                                  <?php for ($x=0; $x < count($get_all_topic); $x++) {  ?>
      <li><a href="topics.php/?n=<?php echo $get_all_topic[$x]->title; ?>">
                                                                               <p>
                                                                                <?php echo $get_all_topic[$x]->title; ?></p></a></li>

                                                                   <?php }?>
                                                                 </ul>
                                                    </div>
                                             </li> 

                                      <?php } ?>  



                    </ul>     

                </nav>



          </div>  <!-- end tutorial-content -->

 </div>  <!-- end tutorial  -->
                      
  
</header>
             
                      
                   
                
               