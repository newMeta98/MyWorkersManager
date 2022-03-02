<?php 
session_start(); 

  include('action/login.php'); 
  include 'fun/logedin.php';
  $title = "Uloguj se";
  LoginChek()
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

  <main>
    <form method = "post" action = "login.php" id = "login">

      <div class="input-group">
        <label>Korisnicko Ime (admin, user)</label>
        <input type="text" name="username" placeholder="Korisnicko Ime">
      </div>

      <div class="input-group">
        <label>Sifra (123456)</label><br/>
        <input type="password" name="password" placeholder="Sifra">
      </div><br/>

      <div class="input-group">
        <input type="submit" class="submit" name="login_user" value="Uloguj se" />
      
      </div>

    </form>
  </main>

</body>
</html>