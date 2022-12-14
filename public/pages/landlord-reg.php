<?php

require('../../server/connection.php');
if(isset($_SESSION['logedin']) and $_SESSION['logedin'] == true and ((isset($_SESSION['usertype']) and $_SESSION['usertype'] != "landlord"))){
  session_destroy();
  session_start();
}

if(isset($_SESSION['logedin']) and $_SESSION['logedin'] == true and ((isset($_SESSION['usertype']) and $_SESSION['usertype'] == "landlord"))){
  $email_id = $_SESSION['username'];

  $query = "SELECT * FROM landlord WHERE email_id = '$email_id' LIMIT 1";
  $result = mysqli_query($con, $query);
  $user = mysqli_fetch_assoc($result);
  // var_dump($user);
  $landlord_name = $user['landlord_name'];
  $landlord_phone = $user['mobile_number'];
  $landlord_pwd = $user['landlord_pwd'];
  $appartment_name = $user['appartment_name'];
  $appartment_number  = $user['appartment_number'];
  $appartment_location = $user['appartment_location'];
  $appartment_rent = $user['appartment_rent'];
  $appartment_type = $user['appartment_type'];
  $landlord_location = $user['landlord_location'];
  $app_fac = $user['app_fac'];

  // tenant information
  $tenant_id = $user['tenant_id'];
  $appartment_occupied = $user['appartment_occupied'];
  
  // query tenant database
  $query = "SELECT * FROM users WHERE email_id = '$tenant_id'";
  $result = mysqli_fetch_assoc(mysqli_query($con, $query));
  // var_dump($result);
  if($appartment_occupied !== "0") {
    $tenant_name = $result['username'];
    $tenant_email = $result['email_id'];
    $tenant_phone = $result['mobile_number'];
    $tenant_start_date = $result['start_date'];
    $tenant_end_date = $result['end_date'];
    $payable_amt = $result['payable_amt'];
    $start_date = $result['start_date'];
    $end_date = $result['end_date'];
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | easyRent</title>
  <link href="../../css/style.css" rel="stylesheet" type="text/css">
  <link href="../../css/account-page.css" rel="stylesheet" type="text/css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <nav>
    <div class="container">
      <div class="navigation">
        <a href="../index.php">
          <h1 class="logo">easyRent</h1>
        </a>
        <ul class="nav-menu">
          <?php 
              require('../../server/connection.php');
              if(isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) :
            ?>
              <li>
                <a href="<?php echo ($_SESSION['usertype'] == 'landlord') ?  '#' : './user-profile.php' ?>">
                  <?php 
                    if(isset($_SESSION['usertype']) and $_SESSION['usertype'] == "tenant") {
                      $query = mysqli_query($con, "SELECT * FROM `users` WHERE `email_id`='$_SESSION[username]'");
                      $fetch = mysqli_fetch_array($query);
                      $str = $fetch['username'];
                      $str=substr($str, 0, strpos($str, ' '));
                      echo"<i class='fa-solid fa-user'></i>"."$str";
                    }else if(isset($_SESSION['usertype']) and $_SESSION['usertype'] == "landlord") {
                      $query = mysqli_query($con, "SELECT * FROM `landlord` WHERE `email_id`='$_SESSION[username]'");
                      $fetch = mysqli_fetch_array($query);
                      $str = $fetch['landlord_name'];
                      $str=substr($str, 0, strpos($str, ' '));
                      echo"<i class='fa-solid fa-user'></i>"."$str";
                    }
                   ?>
            
                </a>
              </li>
              <li>
                <a href="../../server/logout.php" class="btn" style="color: white;">Log out</a>
              </li>
            <?php else: ?>
              <li><a href="./log-option.html" class="btn" style="color: white">Sign in</a></li>
            <?php endif; ?>
        </ul>

      </div>
    </div>
  </nav>

  <section>
    <div class="container">
      <form action="../../server/register.php" method="POST" enctype="multipart/form-data">
        <div class="landlord-account-wrapper"> <!---- contains different divs like personal details div, appartment details div etc --->
          <div class="account-header">
            <!---------------------------------------- PROFILE BASIC INFO ------------------------------------>
            <div class="profile-basic-info">
              <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
              <h1> <?php echo "$landlord_name" ?> </h1>
              <h2> <?php echo "$landlord_location" ?> </h2>
              <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                <input type="text" name="landlord_name" id="landlord_name" value='<?php echo "$landlord_name" ?>' required>
                <input type="text" name="location" id="location" value='<?php echo "$landlord_location" ?>' required>
              <?php else: ?>
              <input type="text" name="landlord_name" id="landlord_name" placeholder="Enter your name" required>
              <input type="text" name="location" id="location" placeholder="Enter your location" required>
              <?php endif ?>
            </div>
          </div>

          <!--------------------------------PERSONAL DETAILS DIV --------------------------------->
          <div class="personal-details-div">
  
            <div class="input-wrapper">
              <div>
                <label for="name">Email: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" name="email_id" type="text" value='<?php echo "$email_id" ?>' readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                  <input  name="email_id" type="text" value='<?php echo "$email_id" ?>' required >
                <?php else: ?>
                  <input  type="text" name="email_id" placeholder="eg: xyz@abc.mail" required> 
                <?php endif ?>
              </div>

              <div>
                <label for="name">Phone: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" type="number" name="mobile_number" value='<?php echo "$landlord_phone" ?>'readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                  <input type="number" name="mobile_number" value='<?php echo "$landlord_phone" ?>' required>
                <?php else: ?>
                  <input  type="text" name="mobile_number" placeholder="Enter mobile number" required> 
                <?php endif ?>
              </div>
            </div> <!----- END OF INPUT WRAPPER contains two div in it for two input fields -------------->

            <div class="input-wrapper">
              <div>
                <label for="name">Password: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" name="password" type="password" value='<?php echo "$landlord_pwd" ?>' readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                  <input  name="password" type="text" value='<?php echo "$landlord_pwd" ?>' required>
                <?php else: ?>
                  <input  type="password" name="password" placeholder="Atleast 8 characters" required> 
                <?php endif ?>
              </div>
            </div> <!---- END OF INPUT WRAPPER ------------------>
          </div> <!--- END OF PERSONAL DETAILS DIV --------------->

          <div class="appartment-info-div">
        
            <div class="input-wrapper">
              <div>
                <label for="name">Appartment Name: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" type="text" value='<?php echo "$appartment_name" ?>' readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                  <input type="text" value='<?php echo "$appartment_name" ?>' required >
                <?php else: ?>
                  <input type="text" name="app_name" placeholder="eg: Four Seasons" required>
                <?php endif ?>
              </div>
              <div>
                <label for="name">Appartment Number: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" type="text" value='<?php echo "$appartment_number" ?>' readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                  <input type="text" value='<?php echo "$appartment_number" ?>' required>
                <?php else: ?>
                  <input type="text" name="app_no" placeholder="eg: NE23" required>
                <?php endif ?>
              </div>
            </div> <!---------------- INPUT WRAPPER INSIDE Appartment INFO DIV ---------------->

            <div class="input-wrapper">
              <div>
                <label for="name">Location: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" value='<?php echo "$appartment_location" ?>' readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                  <input value='<?php echo "$appartment_location" ?>' required >
                <?php else: ?>
                  <input type="text" name="app_loc" placeholder="eg: Ulubari Road, Ghy-5" required>
                <?php endif ?>
              </div>
              <div>
                <label for="name">Appartment Rent: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" type="text" value='<?php echo "$appartment_rent" ?>' readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                  <input  type="text" value='<?php echo "$appartment_rent" ?>' required>
                <?php else: ?>
                  <input type=number name="app_rent" placeholder="eg: $400" required>
                <?php endif ?>
              </div>
            </div>  <!---------------- INPUT WRAPPER INSIDE Appartment INFO DIV ---------------->

            <div class="input-wrapper">
              <div>
                <label for="name">Appartment Type: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" type="text" value='<?php echo "$appartment_type" ?>' readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                  <input type="text" value='<?php echo "$appartment_type" ?>' required>
                <?php else: ?>
                  <input type="text" name="app_type" placeholder="eg: 3BHK" required>
                <?php endif ?>
              </div>
              <div>
                <label for="name">Facilities: </label> <br/>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" type="text" value='<?php echo "$app_fac" ?>' readonly> 
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                  <input  type="text" value='<?php echo "$app_fac" ?>' required>
                <?php else: ?>
                  <input type="text" name="app_fac" placeholder="eg: 2 Balconies, Hall" required> 
                <?php endif ?>
              </div>
            </div> <!---------------- INPUT WRAPPER INSIDE Appartment INFO DIV ---------------->
      
          </div> <!--- APPRATMENT INFO DIV ENDS ---------------->

          <!-- ------------------------------------- TENANT INFO DIV---------------------------------------- -->
          <div class="tenant-info">
            <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                <?php if($appartment_occupied == 1) : ?>
                  <div class="input-wrapper">
                      <div>
                        <label for="name">Tenant Name: </label>
                          <input class="view" value='<?php echo "$tenant_name" ?>' readonly>
                      </div>
                      <div>
                        <label for="name">Tenant email: </label>
                          <input class="view" type="text" value='<?php echo "$tenant_email" ?>' readonly>
                      </div>
                  </div>

                  <div class="input-wrapper">
                      <div>
                        <label for="name">Tenant Phone: </label>
                          <input class="view" value='<?php echo "$tenant_phone" ?>' readonly>
                      </div>
                  </div>

                  <div class="input-wrapper">
                      <div>
                        <label for="name">Start date: </label>
                          <input class="view" value='<?php echo "$tenant_start_date" ?>' readonly>
                      </div>
                      <div>
                        <label for="name">End date: </label>
                          <input class="view" type="text" value='<?php echo "$tenant_end_date" ?>' readonly>
                      </div>
                  </div>

                  <div class="input-wrapper">
                      <div>
                        <label for="name">Amount Payable: </label>
                          <input class="view" value='<?php echo "$payable_amt" ?>' readonly>
                      </div>
                  </div>
                <?php else : ?>
                      <p> No tenant yet </p>
                <?php endif ?>
            <?php endif ?>
          </div>

          <div class="appartment-photo-section">
            <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?> 
              <!--- this is executed when the user is signed in -->
              <?php 
                $email_id = $_SESSION['username'];
                $mobile_number = mysqli_fetch_assoc(mysqli_query($con, "SELECT mobile_number FROM landlord WHERE email_id = '$email_id'"))['mobile_number'];
                $query = "SELECT * FROM images WHERE app_ref = $mobile_number";
                $result = mysqli_query($con, $query);

                if($result->num_rows > 0) {
                  while($row = $result -> fetch_assoc()) {
                    $img_url = '../../server/uploads/'.$row["file_name"];
                      echo "<img src='$img_url'  class='appartment-images'/>" ;           
                  }
                }else {
                  echo "Images were not uploaded. Please upload images by clicking the edit button below.";
                }
                  
                ?>
              <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
              <!-- this is executed when the user is loged in but wants to edit his / her profile -->
              <?php else: ?>
              <label for="fileToUpload"> Upload Appartment Images(Recommended) </label>
              <input type="file" name="appartment_images[]" id="fileToUpload" multiple>
            <?php endif ?>
          </div>

          <div class="button-div">
            <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
              <!-- <input type="submit"  value="Edit" class="btn" name="edit_landlord"> -->
              <input type="submit"  value="Log Out" class="btn" name="logout_landlord">
              <!-- <input type="submit"  value="Delete Account" class="btn" name="delete_landlord"> -->
            <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
              <input type="submit" value="Save" class="btn" name="resave_landlord">
              <input type="submit" value="Cancel" class="btn" name="cancel_edit_landlord">
            <?php else: ?>
              <input type="submit" value="Register" class="btn" name="reg_landlord">
            <?php endif ?>
          </div>
        </div> <!-- landlord-account-wrapper ends !-->
      </form>
    </div> <!-- Container div ends !-->
  </section>
</body>

</html>