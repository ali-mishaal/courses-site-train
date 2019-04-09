<section class="popular-training-topics">
                            
                   <?php 

                       $obj_courses = new coursesApi();
                       $asc_topics = $conn->prepare("SELECT * FROM course WHERE type=1 ORDER BY popC DESC");
                      $asc_topics->execute();

                       $result = $asc_topics->setFetchMode(PDO::FETCH_ASSOC);
                        $myarray_topic = array();
                        foreach($asc_topics->fetchAll() as $key => $value) {
                            $myarray_topic[count($myarray_topic)] = $value;
                        }

                       
                       $six_topic=array();
                       if (count($myarray_topic) >= 6) {
                          
                            for ($i=0; $i < 6; $i++) { 
                            
                                   $six_topic[count($six_topic)]= $myarray_topic[$i];
                            }
                       }else{

                           for ($i=0; $i < count($myarray_topic); $i++) { 
                            
                                   $six_topic[count($six_topic)]= $myarray_topic[$i];
                           }
                       }


                       echo "<div class='address_name'><h1>Popular Training Topics</h1></div>";
                       echo "<div class='pop_contain'>";
                      
                     
                       for ($i=0; $i < count($six_topic); $i++) { 
                                  
                                echo "<div class='pop pop1$i'>";
                                echo "<img src='topicApi/" . $six_topic[$i]['image']. "'>";
                                echo "<div class='cover_image'></div>";

                                echo "<div class='word_web_de'>";
                                echo "<h1>" . $six_topic[$i]['title'] . "</h1></div>";
                                            
                                echo "<div class='slide_web_de'>";
                                echo "<p>". $six_topic[$i]['description'] ."</p>";
                                echo "<div class='button_slide_web_de'>";
                                echo "<a href='files/topics.php?t=".$six_topic[$i]['title']."'>ENTRY</a>";  
                                echo "</div></div></div>";
                     

                       }
                       
                      echo '</div>';

                     ?>
                             
                             
                                 

               </section>