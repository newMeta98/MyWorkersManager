<?php 
  if (isset($_GET['logout'])) {
    session_destroy();

     $job = "job";
     setcookie($job, "", time() - (89700 * 30), "/");
     $username_name = "username"; 
     setcookie($username_name, "", time() - (89700 * 30), "/");

    header("location: index.php");
  }
?>