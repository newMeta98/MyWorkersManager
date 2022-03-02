<?php
// initializing variables
$errors = array(); 
// connect to the database
  include '../fun/db.php';
  include '../fun/load_cookies.php';
if (isset($_POST["action"])) {
    if (isset($_POST["name"])) {
      $name = $_POST["name"];
    }
    if (isset($_POST["kursEUR"])) {
      $kursEUR = $_POST["kursEUR"];
    }

    if ($_POST["action"] == "fetch_viewreport") {

      $sql = "SELECT * FROM everyday WHERE username='$name'";
      $result = mysqli_query($db, $sql);
          
            if (mysqli_num_rows($result) > 0) 
            { 


              while($rows=mysqli_fetch_assoc($result))
              {?>

                <?php  if ($rows['action'] == 'isplata') { 
                    $date = strtotime($rows['date']);
                    $date = date("D d.m ", $date);
                  ?>

                    <button class="istorija_li li_<?php echo $rows['action']; ?>" id="<?php echo $rows['id']; ?>"> 
                      <span>Isplaceno <span><?php echo $rows['suma']; ?>din.</span> <?php echo $date; ?></span>
                    </button>

               <?php }elseif ($rows['action'] == 'zarada') { 
                    $date = strtotime($rows['date']);
                    $date = date("D d.m ", $date);
                ?>
                    
                    <button class="istorija_li li_<?php echo $rows['action']; ?>" id="<?php echo $rows['id']; ?>"> 
                      <span>Zaradjeno <span> | <?php echo $rows['descrip']; ?> | </span> <span><?php echo $rows['suma']; ?>din.</span> <?php echo $date; ?></span>
                    </button>

               <?php }elseif ($rows['action'] == 'dug') { 
                    $date = strtotime($rows['date']);
                    $date = date("D d.m ", $date);
                ?>
                
                    <button class="istorija_li li_<?php echo $rows['action']; ?>" id="<?php echo $rows['id']; ?>"> 
                      <span>Odplata duga <span><?php echo $rows['suma']; ?>din.</span> <?php echo $date; ?></span>
                    </button>

             <?php  } 
               } 
          }else
            {
                echo "Nema rezultata";
            }
    }
    if ($_POST["action"] == "isplata") {
        $action = $_POST["action"];
        $name = $_POST["name"];
        $suma = $_POST["suma"];
        $valuta = $_POST["valuta"];
        $descrip = $_POST["opis"];

        $sql = "SELECT * FROM users WHERE username='$name'";
        $result = mysqli_query($db, $sql);
                if (mysqli_num_rows($result) > 0) 
            {   
              while($rows=mysqli_fetch_assoc($result)){
                $balans = $rows['balans'];
              }
            }
        $oldBalans = $balans;
        if ($valuta == 'eur') {
            $suma = $suma * $kursEUR;
            $newBalans = $balans - $suma; 
        }else{
            $newBalans = $balans - $suma; 
        }

        $sql = "INSERT IGNORE INTO everyday (username, action, oldBalans, suma, newBalans, descrip) 
            VALUES ('$name', '$action', '$oldBalans', '$suma', '$newBalans', '$descrip')";
          $db->query($sql);

        $sql = "UPDATE users SET balans = '$newBalans' WHERE username = '$name'";
            mysqli_query($db, $sql);
    }
    if ($_POST["action"] == "zarada") {
        $action = $_POST["action"];
        $name = $_POST["name"];
        $suma = $_POST["suma"];
        $valuta = $_POST["valuta"];
        $descrip = $_POST["opis"];

        $sql = "SELECT * FROM users WHERE username='$name'";
        $result = mysqli_query($db, $sql);
                if (mysqli_num_rows($result) > 0) 
            {   
              while($rows=mysqli_fetch_assoc($result)){
                $balans = $rows['balans'];
              }
            }
        $oldBalans = $balans;
        if ($valuta == 'eur') {
            $suma = $suma * $kursEUR;
            $newBalans = $balans + $suma; 
        }else{
            $newBalans = $balans + $suma; 
        }

        $sql = "INSERT IGNORE INTO everyday (username, action, oldBalans, suma, newBalans, descrip) 
            VALUES ('$name', '$action', '$oldBalans', '$suma', '$newBalans', '$descrip')";
          $db->query($sql);

        $sql = "UPDATE users SET balans = '$newBalans' WHERE username = '$name'";
            mysqli_query($db, $sql);
    }
    if ($_POST["action"] == "dug") {
        $action = $_POST["action"];
        $name = $_POST["name"];
        $suma = $_POST["suma"];
        $valuta = $_POST["valuta"];
        $descrip = $_POST["opis"];

        $sql = "SELECT * FROM users WHERE username='$name'";
        $result = mysqli_query($db, $sql);
                if (mysqli_num_rows($result) > 0) 
            {   
              while($rows=mysqli_fetch_assoc($result)){
                $balans = $rows['balans'];
              }
            }
        $oldBalans = $balans;
        if ($valuta == 'eur') {
            $suma = $suma * $kursEUR;
            $newBalans = $balans + $suma; 
        }else{
            $newBalans = $balans + $suma; 
        }

        $sql = "INSERT IGNORE INTO everyday (username, action, oldBalans, suma, newBalans, descrip) 
            VALUES ('$name', '$action', '$oldBalans', '$suma', '$newBalans', '$descrip')";
          $db->query($sql);

        $sql = "UPDATE users SET balans = '$newBalans' WHERE username = '$name'";
            mysqli_query($db, $sql);
    }
     
    if ($_POST["action"] == "fetch_BALANS") {
        $action = $_POST["action"];
        $name = $_POST["name"];

        $sql = "SELECT * FROM users WHERE username='$name'";
        $result = mysqli_query($db, $sql);
                if (mysqli_num_rows($result) > 0) 
            {   
              while($rows=mysqli_fetch_assoc($result)){
                $balans = $rows['balans'];
              }
            }

          echo $balans;

    }

    // AUTO DNEVNICE

    if ($_POST["action"] == "fetch_viewreport_AutoD") {

      $sql = "SELECT * FROM satnica";
      $result = mysqli_query($db, $sql);
          
            if (mysqli_num_rows($result) > 0) 
            { 


              while($rows=mysqli_fetch_assoc($result))
              {?>
                  <button class="istorija_li li_satnica" id="<?php echo $rows['id']; ?>"> 
                    <span><?php echo $rows['username']; ?> -> <span><?php echo $rows['payh']; ?>din. |</span> 
                    <?php echo $rows['hours']; ?>h</span>
                    </button>

             <?php
               } 
          }else
            {
                echo "Nema rezultata";
            }
    }
    if ($_POST["action"] == "addToSatnice") {

      $sql = "SELECT * FROM satnica WHERE username = '$name'";
      $result = mysqli_query($db, $sql);
      $days = '0';
      $payh = '0';
      $hours = '0';    
            if (mysqli_num_rows($result) > 0) 
            { 

                echo "<div class='alert_msg_red'>".$name." vec na listi</div>";
          }else
            {
                

              $sql = "INSERT IGNORE INTO satnica (username, days, payh, hours) 
                VALUES ('$name', '$days', '$payh', '$hours')";
             

             if ($db->query($sql)) {
                 echo "<div class='alert_msg_blue'>".$name." dodat na listu</div>";
              } 
            }
    }

    if ($_POST["action"] == "Edit_li") {
      $id = $_POST["id"];
      $sql = "SELECT * FROM satnica WHERE id = '$id'";
      $result = mysqli_query($db, $sql);
   
            if (mysqli_num_rows($result) > 0) 
            { 
                  while($rows=mysqli_fetch_assoc($result))   
              {
                  $dnevno = $rows['payh'] * $rows['hours'];

                ?>
                    <div class="Edit_li"><label><?php echo $rows['username']; ?></label><br>
                      Dnevnica (trenutno <span><?php echo $rows['payh']; ?>din.</span> | 
                     <span> <?php echo $rows['hours']; ?>h</span>) 
                       <span><?php echo $dnevno ?>din.</span><br>
                      <input type="number" name="" id="edit_din" placeholder="din. po satu" value="<?php echo $rows['payh']; ?>">
                      <input type="number" name="" id="edit_h" placeholder="h dnevno" value="<?php echo $rows['hours']; ?>">

                      <input type="text" name="" id="edit_description" placeholder="Gradiliste" value="<?php echo $rows['description']; ?>">
                      <button class="edit_save" id="<?php echo $rows['id'] ?>">Sacuvaj</button><button class="edit_delete" id="<?php echo $rows['id'] ?>">Ukloni</button><button id="edit_back">Nazad</button>
                    </div>
             <?php }
            }
    }
    if ($_POST["action"] == "Edit_istorija") {
      $id = $_POST["id"];
      $sql = "SELECT * FROM everyday WHERE id = '$id'";
      $result = mysqli_query($db, $sql);
   
            if (mysqli_num_rows($result) > 0) 
            { 
                  while($rows=mysqli_fetch_assoc($result))   
              {

                  $date = strtotime($rows['date']);
                  $date = date("D d.m ", $date);
                ?>
                    <div class="Edit_li"><label><?php echo $rows['username']; ?></label>
                      <?php echo $rows['action']; ?> <span><?php echo $rows['suma']; ?>din.</span> 
                      | <?php echo $date; ?><br><?php echo $rows['descrip']; ?> <br>
                      <input type="number" name="" id="edit_din" placeholder="suma"><br>
                      <button class="edit_save" id="<?php echo $rows['id'] ?>">Sacuvaj</button><button class="edit_delete" id="<?php echo $rows['id'] ?>">Ukloni</button><button id="edit_back">Nazad</button>
                    </div>
             <?php }
            }
    }

    if ($_POST["action"] == "Edit_istorijaUser") {
      $id = $_POST["id"];
      $sql = "SELECT * FROM everyday WHERE id = '$id'";
      $result = mysqli_query($db, $sql);
   
            if (mysqli_num_rows($result) > 0) 
            { 
                  while($rows=mysqli_fetch_assoc($result))   
              {

                  $date = strtotime($rows['date']);
                  $date = date("D d.m ", $date);
                ?>
                    <div class="Edit_li"><label><?php echo $rows['username']; ?></label>
                      <?php echo $rows['action']; ?> <span><?php echo $rows['suma']; ?>din.</span> | <?php echo $date; ?><br><?php echo $rows['descrip']; ?> <br>
                    </div>
             <?php }
            }
    }
    if ($_POST["action"] == "edit_delete") {
          $id = $_POST["id"];

      $sql = "SELECT * FROM satnica WHERE id = '$id'";
      $result = mysqli_query($db, $sql);
   
            if (mysqli_num_rows($result) > 0) 
            { 
                  while($rows=mysqli_fetch_assoc($result))   
              {
                  $name = $rows['username'];
              }
            }



          $query = "DELETE FROM satnica WHERE id = '$id'";

          if (mysqli_query($db, $query)) {
             echo "<div class='alert_msg_red'>".$name." uklonjen sa liste</div>";
          }
    }  
    if ($_POST["action"] == "edit_delete_istorija") {
          $id = $_POST["id"];

          $sql = "SELECT * FROM everyday WHERE id = '$id'";
           $result = mysqli_query($db, $sql);
   
            if (mysqli_num_rows($result) > 0) 
            { 
                  while($rows=mysqli_fetch_assoc($result))   
              {
                  $name = $rows['username'];
                  $suma = $rows['suma'];
                  $action = $rows['action'];
              }
            }
          $Sql = "SELECT * FROM users WHERE username = '$name'";
          $Result = mysqli_query($db, $Sql);
          if (mysqli_num_rows($Result) > 0) 
            { 
                  while($Rows=mysqli_fetch_assoc($Result))   
              {
                  $balans = $Rows['balans'];
              }
            }

          if ($action == 'zarada') {

              $newBalans = $balans - $suma;
          }elseif ($action == 'isplata') {
              
              $newBalans = $balans + $suma;
          }elseif ($action == 'dug') {
              
              $newBalans = $balans - $suma;
          }

          $query = "DELETE FROM everyday WHERE id = '$id'";
          if (mysqli_query($db, $query)) {
            $sQl = "UPDATE users SET balans = '$newBalans' WHERE username = '$name'";
            if (mysqli_query($db, $sQl)) {
                echo "<div class='alert_msg_red'>Uklonjeno iz istorije</div>";
            }
          }
    } 

    if ($_POST["action"] == "edit_save_istorija") {
          $id = $_POST["id"];
          $newSuma = $_POST["payh"];

          $sql = "SELECT * FROM everyday WHERE id = '$id'";
           $result = mysqli_query($db, $sql);
   
            if (mysqli_num_rows($result) > 0) 
            { 
                  while($rows=mysqli_fetch_assoc($result))   
              {
                  $name = $rows['username'];
                  $suma = $rows['suma'];
                  $action = $rows['action'];
              }
            }
          $Sql = "SELECT * FROM users WHERE username = '$name'";
          $Result = mysqli_query($db, $Sql);
          if (mysqli_num_rows($Result) > 0) 
            { 
                  while($Rows=mysqli_fetch_assoc($Result))   
              {
                  $balans = $Rows['balans'];
              }
            }

          if ($action == 'zarada') {

              $newBalans = $balans - $suma;
              $newBalans = $newBalans + $newSuma;
          }elseif ($action == 'isplata') {
              
              $newBalans = $balans + $suma;
              $newBalans = $newBalans - $newSuma;
          }elseif ($action == 'dug') {
              
              $newBalans = $balans - $suma;
              $newBalans = $newBalans + $newSuma;
          }

          $query = "UPDATE everyday SET suma = '$newSuma' WHERE id = '$id'";
          if (mysqli_query($db, $query)) {

            $sQl = "UPDATE users SET balans = '$newBalans' WHERE username = '$name'";
            if (mysqli_query($db, $sQl)) {
                echo "<div class='alert_msg_blue'>Izmena uspesno sacuvana</div>";
            }
          }
    } 
    if ($_POST["action"] == "edit_save") {
          $id = $_POST["id"];
          $payh = $_POST["payh"];
          $hours = $_POST["hours"];
          $description = $_POST["description"];

      $sql = "SELECT * FROM satnica WHERE id = '$id'";
      $result = mysqli_query($db, $sql);
   
            if (mysqli_num_rows($result) > 0) 
            { 
                  while($rows=mysqli_fetch_assoc($result))   
              {
                  $name = $rows['username'];
              }
            }


          $query = "UPDATE satnica SET payh = '$payh', hours = '$hours', description = '$description' WHERE id = '$id'";

          if (mysqli_query($db, $query)) {
             echo "<div class='alert_msg_blue'>Uspesno sacuvano!</div>";
          }
    }


    if ($_POST["action"] == "upisi_Dnevnice") {



      $sql = "SELECT * FROM satnica";
      $result = mysqli_query($db, $sql);
   
            if (mysqli_num_rows($result) > 0) 
            { 
                  while($rows=mysqli_fetch_assoc($result))   
              {
                  $name = $rows['username'];

                  $Sql = "SELECT * FROM users WHERE username='$name'";
                  $Result = mysqli_query($db, $Sql);
                  if (mysqli_num_rows($Result) > 0) 
                  {   
                    while($Rows=mysqli_fetch_assoc($Result)){
                      $balans = $Rows['balans'];
                    }
                  }

                  $action = 'zarada';
                  $descrip = $rows['description'];
                  $suma = $rows['payh'] * $rows['hours'];
                  $oldBalans = $balans;
                  $newBalans = $balans + $suma; 


            $SQL = "INSERT IGNORE INTO everyday (username, action, oldBalans, suma, newBalans, descrip) 
                        VALUES ('$name', '$action', '$oldBalans', '$suma', '$newBalans', '$descrip')";
              if ($db->query($SQL)) {
                    $sQl = "UPDATE users SET balans = '$newBalans' WHERE username = '$name'";
                  if (mysqli_query($db, $sQl)) {
                     echo "<div class='alert_msg_blue'>".$name." -> Dnevnica uspesno upisana!</div>";
                  }
                }  
              }
            }
    }


    if ($_POST["action"] == "upload_profileImg") {


              $ext = array('jpg', 'jpeg', 'png', 'gif');
              $file_ext = explode('.',$_FILES["image"]['name'][0]);
              $img_name = $file_ext[0];
              $file_ext = end($file_ext);
              $Name = $img_name."-".md5(rand()).".".$file_ext;
              if (!in_array($file_ext, $ext)){
              ?> <div class="error-msg">
              <?php  echo $_FILES["image"]['name'] . ' - Invalid file extension!';
            ?> </div> <?php
              }else
              {
              $img_dir = '../images/'.$Name;
              $Img_dir = 'images/'.$Name;
                  move_uploaded_file($_FILES["image"]['tmp_name'][0], $img_dir);

              $sql = "UPDATE users SET profile = '$Img_dir' WHERE username = '$name'";
              mysqli_query($db, $sql);
              
               echo $_FILES["image"]['name'][0] . ' - Seccess! Image has uploaded!';
              }   

    }
}
?>