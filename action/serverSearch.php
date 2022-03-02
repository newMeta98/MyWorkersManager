<?php
// initializing variables
$errors = array(); 

// connect to the database
  include '../fun/db.php';
  include '../fun/load_cookies.php';
if (isset($_POST["action"])) {
    if ($_POST["action"] == "search") {
      $sql = "SELECT * FROM users WHERE username LIKE '%".$_POST["search"]."%'";
      $result = mysqli_query($db, $sql);
      if (mysqli_num_rows($result) > 0) 
      {
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
           
      }
      else
      {
        echo "Nema rezultata";
      }
    }
    if ($_POST["action"] == "veiw") {
       $sql = "SELECT * FROM users";
      $result = mysqli_query($db, $sql);
      
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
}
}
?>