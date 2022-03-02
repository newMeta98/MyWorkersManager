<?php 
  session_start();
  include_once('fun/logedin.php');
  include_once('fun/logout.php');
  include_once('fun/load_cookies.php');
  include_once('fun/db.php');
  $name = $username;
  $users = "SELECT * FROM users WHERE username = '$name'" ;
  $users_result = mysqli_query($db, $users);
  $satnica = "SELECT * FROM satnica WHERE username = '$name'" ;
  $satnica_result = mysqli_query($db, $satnica);
  $evryday = "SELECT * FROM evryday WHERE username = '$name'" ;
  $evryday_result = mysqli_query($db, $evryday);
  $title = $name;
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="profile-main">
<?php 
    if (isset($_SESSION['msg'])) {
      echo $_SESSION['msg'];
    }else {
      echo "";
    }
?>
<div class="profile-user">
  <div class="top_btn_wrap"><button class="logout_btn" onclick="logOut()">Odjavi se</button></div>
<?php  while($rows=mysqli_fetch_assoc($users_result))
{ ?> 
      <div class="profile">
        <div class="user">

  <button class="profileImg_btn" id="profile_img" value="uncheck">
    <img src="<?php echo $rows['profile']; ?>" id="myImg">
  </button>

  <div class="profile-left">

      <div class="name">
          <?php echo $rows['username']; ?>
          <input type="hidden" name="name" id="name" value="<?php echo $rows['username']; ?>">
      </div>

      <?php echo $rows['job'];?> | Balans: <span id="user_balans"><?php echo $rows['balans'];?></span>din.
  </div>
</div></div> 
 <form id="image_form" method="post" enctype="multipart/form-data">
     <p><label>Izaberi Sliku</label>
     <input type="file" name="image[]" id="image" placeholder="odaberi sliku" /></p>
     <input type="hidden" name="action" id="action" value="upload_profileImg" />
     <input type="hidden" name="name" id="name" value="<?php echo $rows['username']; ?>" />
     <input type="submit" class="upload_btn" name="insert" id="insert" value="Promeni sliku" class="btn btn-info" />
    </form>
 <div class="viewreport" id="viewreport">
    
 </div>
<div class="alert_msg"></div>

<div class="top_btn_wrap"><button class="logout_btn" onClick="window.location.reload()">refres</button></div>
</div>

<?php } ?>
</body>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/viewreportUser.js"></script>
<script type="text/javascript" src="js/loguot.js"></script>
</html>