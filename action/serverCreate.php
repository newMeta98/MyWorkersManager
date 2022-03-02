<?php

// initializing variables
$errors = array(); 

$balans = '0';
// connect to the database
  include '../fun/db.php';

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $img = "images/profile-def.jpg";
  $newuser = mysqli_real_escape_string($db, strtolower($_POST['newuser']));
  $job = mysqli_real_escape_string($db, $_POST['job']); 
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $days = '0';
  $hours = mysqli_real_escape_string($db, $_POST['hours']);
  $payh = mysqli_real_escape_string($db, $_POST['payh']);
  $balans = mysqli_real_escape_string($db, $_POST['balans']);
  $btn_val = mysqli_real_escape_string($db, $_POST['btn_val']);
    
  
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($newuser)) { array_push($errors, "Username is required"); echo "Username is required!"; }
  if (empty($password_1)) { array_push($errors, "Password is required"); echo "Password is required!";}


  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username = '$newuser' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
    if (isset($user['username'])) {
      if ($user['username'] === $newuser) {
      array_push($errors, "Username already exists"); echo "Username already exists!";
    }
    }
     

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
      $password = md5($password_1);//encrypt the password before saving in the database
      $query = "INSERT INTO users (username, job, password, profile, balans) 
            VALUES('$newuser', '$job', '$password', '$img', '$balans')";
      mysqli_query($db, $query);


      if ($btn_val == 'check') {
            $Query = "INSERT INTO satnica (username, days, hours, payh) 
                VALUES('$newuser', '$days', '$hours', '$payh')";
          mysqli_query($db, $Query);   
      }
       
      echo '1';
  }
}
    
?>