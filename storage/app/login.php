<?php
  
  session_start();

  $email = $_REQUEST['email']; 

  $_SESSION['email'] = $email;
  //echo $_SESSION['email'];
  header("location: ./list.php");

?>
