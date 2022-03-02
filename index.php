<?php 
  session_start(); 
  include 'fun/load_cookies.php';
  include 'fun/logedin.php';
  include 'fun/logout.php';
  include_once('fun/db.php');
  goLogin();
  $title = "Radnici";
  if (isset($_POST['sub'])) {
   $_SESSION['name'] = $_POST['sub'];
   $url = "viewAcc.php";
   echo "<script type='text/javascript'>window.top.location='viewAcc.php';</script>"; exit;
  }
?><!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<main class="main-list">
  <div class="top_btn_wrap"><button class="logout_btn" onclick="logOut()">Odjavi se</button></div>
  <div class="top_btn_wrap"><a href="autoDnevnice.php" class="btn_top">Auto-Dnevnice</a></div>
  
  <form  method="post" id="searchForm">
   <input type="text" name="search" id="search" placeholder="Pretrazi" autocomplete="off"><img src="images/lupa.png" width="30px" height="30px">
  </form>

  <form method="post" action="index.php" id="myUL">
  <?php
      $query = "SELECT * FROM users" ;
      $result = mysqli_query($db, $query);
      while($rows=mysqli_fetch_assoc($result)){ 

          if ($rows['username'] == $username) {
    
          }else{
              ?>
                  <button type="submit" name="sub" class="accordion" id="<?php echo $rows['username']; ?>" value="<?php echo $rows['username'];?>">
                    <img src="<?php echo $rows['profile']; ?>">
                        <div class="profile-left">
                          <div class="name">
                            <?php echo $rows['username']; ?>
                          </div>
                        </div>
                  </button>
                
              <?php 
              }
      } 
  ?> </form>
</main>
<button class="addButton" id="JoinBtn">+</button>

 <?php include 'include/createUser.php';?>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/addUser.js"></script>
<script type="text/javascript" src="js/search.js"></script>
<script type="text/javascript" src="js/loguot.js"></script>
</body>
</html>