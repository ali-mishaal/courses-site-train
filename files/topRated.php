<section class="top-rated" style="width: 100%; margin-top: 0">

                             <div class="specilization_word"><h1>TOP RATED</h1></div>
                             <?php 
                             $obj_topic = new coursesApi();

                             $obj_courses = new coursesApi();
                  $asc_courses = $conn->prepare("SELECT * FROM course WHERE type=0 ORDER BY topRated DESC");
                  $asc_courses->execute();

                  $result = $asc_courses->setFetchMode(PDO::FETCH_ASSOC);
                  $myarray_courses = array();
                  foreach($asc_courses->fetchAll() as $key => $value) {
                            $myarray_courses[count($myarray_courses)] = $value;
                        }

                       
                $six_courses=array();
                if (count($myarray_courses) >= 6) {
                          
                      for ($i=0; $i < 6; $i++) { 
                            
                            $six_courses[count($six_courses)]= $myarray_courses[$i];
                        }

                 }else{

                      for ($i=0; $i < count($myarray_courses); $i++) { 
                            
                                   $six_courses[count($six_courses)]= $myarray_courses[$i];
                           }
                }

                 
                $width = 0 ;
                for ($i=0; $i <count($six_courses) ; $i++) { 


                      echo "<div class='spec_web_de' style='position:relative'>";
                          echo "<h3>" . $six_courses[$i]['title'] . "</h3>";

                          $width = ($six_courses[$i]['topRated']/5)*100;

                ?>
                     <div class="rate">
                           <div class="outer-star">
                                  <div class="inner-star" style="<?php echo 'width:'.$width .'%'; ?>"></div>
                           </div>

                     </div>


                <?php
                          
                          echo "<p>" . $six_courses[$i]['description'] . "</p>";
                          echo "<div class='get_started'>";
                                   echo "<i class='fa fa-caret-right fa-lg'></i>";
                                   echo "<a href='files/courses.php?t=".$six_courses[$i]['title']."'>GET STARTED</a>"; 
                         echo "</div>
                      </div>"; 

                             }

                     ?>      
                             
               </section>