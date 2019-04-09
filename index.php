

      <?php


            if (file_exists('session.php')) {
              
              require_once('session.php');
            }else{

              die('THe COnnection TO DAtaBAse IS LOst');
            }

            if (file_exists('connect_db.php')) {
              
              require_once('connect_db.php');
            }else{

              die('THe COnnection TO DAtaBAse IS LOst');
            }

            if (file_exists('topicApi/topicApi.php')) {
              
              require_once('topicApi/topicApi.php');
            }else{

              die('topicApi is not found');
            }

            if (file_exists('coursesApi/coursesApi.php')) {
              
              require_once('coursesApi/coursesApi.php');
            }else{

              die('coursesApi is not found');
            }

            include 'files/header.php';  

        ?>
      </header>

      <!-- ..........................................................end header............................ -->


    <!-- *************************************************************************************************************************   -->


      <!-- ..........................................................start continer......................... -->

      <div class="contain-courses">
      	       <section class="about-courses">
                            <div class="leftdesign"></div>

                             <div class="what"><h1>What We Do</h1></div>
                             <div class="line"></div>
                            <article class="anywhere">
                                         <header class="header-anywhere"><i class="fa fa-desktop fa-3x" aria-hidden="true"></i></header>
                                         <div class="contain-anywhere">
                                                  <h3>Learn Anywhere</h3>
                                                  <p>Learn from anywhere in the world</p>
                                         </div>
                            </article>

                            <article class="unlimited">
                                         <header class="header-unlimited"><i class="fa fa-free-code-camp fa-3x" aria-hidden="true"></i></header>
                                         <div class="contain-unlimited">
                                                  <h3>Unlimited Access</h3>
                                                  <p>Choose what you’d like to learn from our extensive subscription library</p>
                                         </div>
                            </article> 

                            <article class="certificate">
                                         <header class="header-certificate"><i class="fa fa-certificate fa-3x" aria-hidden="true"></i></header>
                                         <div class="contain-certificate">
                                                  <h3>Certificates</h3>
                                                  <p>Earn official recognition for your work</p>
                                         </div>
                            </article> 

                            <div class="clear"></div>

                            <div class="rightdesign"></div>
               </section>

              
               <?php

                         if (file_exists('files/populartopic.php')) {
                           
                              require_once('files/populartopic.php');
                         }

                         if (file_exists('files/specialize.php')) {
                             
                             require_once('files/specialize.php');
                         }

                         if (file_exists('files/popularcourses.php')) {
                             
                             require_once('files/popularcourses.php');
                         }


                         if (file_exists('files/topRated.php')) {
                             
                             require_once('files/topRated.php');
                         }
               ?>
        
               
      </div>

      <!--............................................................start footer................................................-->

      <?php  require_once('files/footer.php'); ?>

      <!--............................................................end footer................................................-->


