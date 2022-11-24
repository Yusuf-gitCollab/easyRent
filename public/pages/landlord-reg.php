<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
  $_SESSION['edit-profile'] = false;
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

</head>

<body>
  <nav>
    <div class="container">
      <div class="navigation">
        <a href="../index.php">
          <h1 class="logo">easyRent</h1>
        </a>
        <ul class="nav-menu">
          <li><a href="">Find Rent/PG</a></li>
          <li><a href="">Coworking</a></li>
          <li><a href="">Post Property</a></li>
          <li><a href=""> My Account </a></li>
        </ul>

      </div>
    </div>
  </nav>

  <section>
    <div class="container">
      <form action="../../server/register.php" method="POST" enctype="multipart/form-data">
        <div class="landlord-account-wrapper"> <!---- contains different divs like personal details div, appartment details div etc --->
          <div class="account-header">
            <!------------------------------ PROFILE IMAGE DIV -------------------------------------->
            <div
              class="profile-img <?php echo ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true)) ? 'view' : '' ?>">

              <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?> 
              <!--- this is executed when the user is signed in -->
              <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkmQL4_XePw5_yIHPkzc0lfb8FesWP4TR9MQ&usqp=CAU"
                alt="">
              <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
              <!-- this is executed when the user is loged in but wants to edit his / her profile -->
              <?php else: ?>
              <label for="fileToUpload"> Upload Image </label>
              <input type="file" name="fileToUpload" id="fileToUpload">
              <?php endif ?>
            </div>
            <!---------------------------------------- PROFILE BASIC INFO ------------------------------------>
            <div class="profile-basic-info">
              <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
              <h1> Cha Eun Woo </h1>
              <h2> Gunpo, Gyeonggi Province, India </h2>
              <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>

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
                  <input class="view" name="email_id" type="text" placeholder="harsh1.5lacs@gmail.com" readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                  
                <?php else: ?>
                  <input  type="text" name="email_id" placeholder="eg: xyz@abc.mail" required> 
                <?php endif ?>
              </div>

              <div>
                <label for="name">Phone: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" type="number" name="mobile_number" placeholder="6000295281" readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                  
                <?php else: ?>
                  <input  type="text" name="mobile_number" placeholder="Enter mobile number" required> 
                <?php endif ?>
              </div>
            </div> <!----- END OF INPUT WRAPPER contains two div in it for two input fields -------------->

            <div class="input-wrapper">
              <div>
                <label for="name">Password: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" name="password" type="password" placeholder="********" readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                  
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
                  <input class="view" type="text" placeholder="harsh1.5lacs@gmail.com" readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                
                <?php else: ?>
                  <input type="text" name="app_name" placeholder="eg: Four Seasons" required>
                <?php endif ?>
              </div>
              <div>
                <label for="name">Appartment Number: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" type="text" placeholder="harsh1.5lacs@gmail.com" readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                
                <?php else: ?>
                  <input type="text" name="app_no" placeholder="eg: NE23" required>
                <?php endif ?>
              </div>
            </div> <!---------------- INPUT WRAPPER INSIDE Appartment INFO DIV ---------------->

            <div class="input-wrapper">
              <div>
                <label for="name">Location: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" type="text" placeholder="harsh1.5lacs@gmail.com" readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                
                <?php else: ?>
                  <input type="text" name="app_loc" placeholder="eg: Ulubari Road, Ghy-5" required>
                <?php endif ?>
              </div>
              <div>
                <label for="name">Appartment Rent: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" type="text" placeholder="harsh1.5lacs@gmail.com" readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                
                <?php else: ?>
                  <input type=number name="app_rent" placeholder="eg: $400" required>
                <?php endif ?>
              </div>
            </div>  <!---------------- INPUT WRAPPER INSIDE Appartment INFO DIV ---------------->

            <div class="input-wrapper">
              <div>
                <label for="name">Appartment Type: </label>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <input class="view" type="text" placeholder="harsh1.5lacs@gmail.com" readonly>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                
                <?php else: ?>
                  <input type="text" name="app_type" placeholder="eg: 3BHK" required>
                <?php endif ?>
              </div>
              <div>
                <label for="name">Facilities: </label> <br/>
                <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
                  <textarea class="view" type="text" placeholder="harsh1.5lacs@gmail.com" readonly> </textarea>
                <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
                
                <?php else: ?>
                  <textarea type="text" name="app_fac" placeholder="eg: 2 Balconies, Hall" required> </textarea>
                <?php endif ?>
              </div>
            </div> <!---------------- INPUT WRAPPER INSIDE Appartment INFO DIV ---------------->
      
          </div> <!--- APPRATMENT INFO DIV ENDS ---------------->

          <div class="appartment-photo-section">
            <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?> 
              <!--- this is executed when the user is signed in -->
              <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkmQL4_XePw5_yIHPkzc0lfb8FesWP4TR9MQ&usqp=CAU"
                alt="">
              <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
              <!-- this is executed when the user is loged in but wants to edit his / her profile -->
              <?php else: ?>
              <label for="fileToUpload"> Upload Appartment Images </label>
              <input type="file" name="files[]" id="fileToUpload" multiple required>
            <?php endif ?>
          </div>

          <div class="button-div">
            <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
              <input type="submit"  class="Edit" name="edit_landlord">
            <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>
              <input type="submit" class="Save" name="resave_landlord">
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