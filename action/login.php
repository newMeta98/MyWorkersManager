<?php

// initializing variables

$errors = array(); 
// connect to the database
  include 'fun/db.php';
// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, strtolower($_POST['username']));
    $password = mysqli_real_escape_string($db, $_POST['password']);
    if (empty($username)) {
      array_push($errors, "Username is required");
    }
    if (empty($password)) {
      array_push($errors, "Password is required");
    }
    $queryUSER = "SELECT * FROM users WHERE username='$username'";
    $resultsUSER = mysqli_query($db, $queryUSER);
    while($rows=mysqli_fetch_array($resultsUSER)){
      $job_value = $rows['job'];
      $job = "job";
      setcookie($job, $job_value, time() + (86400 * 30), "/");
    }
    if (count($errors) == 0) {
      $password = md5($password);
      $query_user = "SELECT * FROM users WHERE username='$username' AND password='$password'";
      $results_user = mysqli_query($db, $query_user);
      if (mysqli_num_rows($results_user) == 1) {
        
        $username_name = "username";
        setcookie($username_name, $username, time() + (86400 * 30), "/");
        header('location: index.php');
      }else {
        array_push($errors, "Wrong email/password combination");
      }
    }
  }
?>