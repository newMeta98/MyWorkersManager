<?php 
  session_start();
  include_once('fun/logedin.php');
  include_once('fun/load_cookies.php');
  include_once('fun/db.php');
  $name = $_SESSION['name'];
  $users = "SELECT * FROM users WHERE username = '$name'" ;
  $users_result = mysqli_query($db, $users);
  $satnica = "SELECT * FROM satnica WHERE username = '$name'" ;
  $satnica_result = mysqli_query($db, $satnica);
  $evryday = "SELECT * FROM evryday WHERE username = '$name'" ;
  $evryday_result = mysqli_query($db, $evryday);
  $title = $name;
  goLogin();
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
<?php  while($rows=mysqli_fetch_assoc($users_result))
{ ?> 
      <div class="profile">
        <div class="user">

<img src="<?php echo $rows['profile']; ?>" id="myImg">

  <div class="profile-left">

      <div class="name">
          <?php echo $rows['username']; ?>
          <input type="hidden" name="name" id="name" value="<?php echo $rows['username']; ?>">
      </div>

      <?php echo $rows['job'];?> | Balans: <span id="user_balans"><?php echo $rows['balans'];?></span>din.
  </div>
</div></div> 
 <div class="viewreport" id="viewreport">
    
 </div>
<div class="alert_msg"></div>

    <div class="wrap_dis_all">
       <div class="menu_btns">
          <button class="btn_menu" id="menu_isplata">Isplata</button>
          <button class="btn_menu" id="menu_zarada">Zarada</button>
          <button class="btn_menu" id="menu_dug">Dugovanja</button>
       </div>
       <div class="wrap_dis">
         <div class="dis_isplata">
              
              <h3>Isplata 
                <span class="span_right">
                  Kurs EUR <input type="number" class="kurs" name="" id="kursEUR1" value="117">
                </span>
              </h3>
              <input type="number" name="" id="suma1" placeholder="Suma.."> 
              <select class="valuta1" name="valuta1">
                <option value="din">DIN</option>
                <option value="eur">EUR</option>
              </select>
              <input type="text" class="opis" name="" id="opis1" placeholder="Gradiliste (opis..)"> 
              <button class="dis_btn" id="btn_isplata">Dodaj</button>
         </div>

         <div class="dis_zarada">

              <h3>Zarada 
                <span class="span_right">
                  Kurs EUR <input type="number" class="kurs" name="" id="kursEUR2" value="117">
                </span>
              </h3>
              <input type="number" name="" id="suma2" placeholder="Suma.."> 
              <select class="valuta2" name="valuta1">
                <option value="din">DIN</option>
                <option value="eur">EUR</option>
              </select>
              <input type="text" class="opis" name="" id="opis2" placeholder="Opis..">
              <button class="dis_btn" id="btn_zarada">Dodaj</button>
         </div>

         <div class="dis_dug">

              <h3>Dugovanja 
                <span class="span_right">
                  Kurs EUR <input type="number" class="kurs" name="" id="kursEUR3" value="117">
                </span>
              </h3>
              <input type="number" name="" id="suma3" placeholder="Suma.."> 
              <select class="valuta3" name="valuta1">
                <option value="din">DIN</option>
                <option value="eur">EUR</option>
              </select>
              <input type="text" class="opis" name="" id="opis3" placeholder="Opis..">
              <button class="dis_btn" id="btn_dug">Dodaj</button>         
         </div>
      </div>
    </div>
</div>
<div>
<?php } ?>
</body>
<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/viewreport.js"></script>

</html>