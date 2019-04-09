  <?php


    session_start();

  if (!isset($_SESSION['user_in'])) {
  	
  	$_SESSION['user_in'] = false;
  }


?>