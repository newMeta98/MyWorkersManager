<?php 
  session_start(); 
  include 'fun/load_cookies.php';
  include 'fun/logedin.php';
  include 'fun/logout.php';
  include_once('fun/db.php');
  goLogin();
 ?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
  <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

  <main class="auto_d_main">
    <div class="" id="showdate"></div>
    <button class="btn_top" id="btn_upisiD">Upisi Dnevnice</button>

     <div class="viewreport" id="viewreport">
    
    </div>

    

    <div class="alert_msg"></div>

  <form method="post" action="index.php" id="myUL">
  <?php
      $query = "SELECT * FROM users" ;
      $result = mysqli_query($db, $query);
      while($rows=mysqli_fetch_assoc($result)){ 

          if ($rows['username'] == $username) {
    
          }else{
              ?>
                  <button name="sub" class="accordion" id="<?php echo $rows['username']; ?>" value="<?php echo $rows['username'];?>">
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
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/autodnevnice.js"></script>
  <script type="text/javascript" src="js/search.js"></script>
</body>
</html>