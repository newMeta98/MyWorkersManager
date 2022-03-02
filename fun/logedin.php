<?php

function LoginChek()
{
    if (!isset($_COOKIE['username'])) {
        $LogedIn = 'False';  
    }elseif (isset($_COOKIE['username'])) {
        $LogedIn = 'True';
        header('location: index.php');
    }
}


function goLogin()
{
    if (!isset($_COOKIE['username'])) {
        $LogedIn = 'False';
        header('location: login.php');
    }elseif (isset($_COOKIE['username'])) {
        $LogedIn = 'True';
        if ($_COOKIE['job'] != "sef_admin") {
            $checkAdmin = 'False';
            header('location: userAcc.php');
        }elseif ($_COOKIE['job'] == "sef_admin") {
            $checkAdmin = 'True';
        }
    }
}
function checkUser()
{
  if ($_COOKIE['job'] != "sef_admin") {
    $checkUser = 'True';
  }elseif ($_COOKIE['job'] == "sef_admin") {
    $checkUser = 'False';
      header('location: index.php');
  }
}
?>