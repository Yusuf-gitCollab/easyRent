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
        <div class="landlord-account-wrapper">
          <div class="account-header">
            <div
              class="profile-img <?php echo ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true)) ? 'view' : '' ?>">

              <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>

              <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQkmQL4_XePw5_yIHPkzc0lfb8FesWP4TR9MQ&usqp=CAU"
                alt="">
              <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>

              <?php else: ?>
              <label for="fileToUpload"> Upload Image </label>
              <input type="file" name="fileToUpload" id="fileToUpload">
              <?php endif ?>
            </div>
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
          <div class="personal-details-div">
            <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
            <div class="input-wrapper">
              <div>
                <label for="name">Email: </label>
                <input class="view" type="text" placeholder="harsh1.5lacs@gmail.com" readonly>
              </div>
              <div>
                <label for="name">Phone: </label>
                <input class="view" type="text" placeholder="6000295281" readonly>
              </div>
            </div>

            <div class="input-wrapper">
              <div>
                <label for="name">Password: </label>
                <input class="view" type="text" placeholder="deboHarsh@2022" readonly>
              </div>
            </div>


            <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>

            <?php endif ?>
          </div>

          <div class="appartment-info-div">
            <?php if ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == false)): ?>
            <div class="input-wrapper">
              <div>
                <label for="name">Appartment Name: </label>
                <input class="view" type="text" placeholder="harsh1.5lacs@gmail.com" readonly>
              </div>
              <div>
                <label for="name">Appartment Number: </label>
                <input class="view" type="text" placeholder="6000295281" readonly>
              </div>
            </div>

            <div class="input-wrapper">
              <div>
                <label for="name">Location: </label>
                <input class="view" type="text" placeholder="harsh1.5lacs@gmail.com" readonly>
              </div>
              <div>
                <label for="name">Appartment Rent: </label>
                <input class="view" type="text" placeholder="6000295281" readonly>
              </div>
            </div>

            <div class="input-wrapper">
              <div>
                <label for="name">Appartment Type: </label>
                <input class="view" type="text" placeholder="harsh1.5lacs@gmail.com" readonly>
              </div>
              <div>
                <label for="name">Facilities: </label>
                <input class="view" type="text" placeholder="6000295281" readonly>
              </div>
            </div>
            <?php elseif ((isset($_SESSION['logedin']) and $_SESSION['logedin'] == true) and (isset($_SESSION['edit-profile']) and $_SESSION['edit-profile'] == true)): ?>

            <?php endif ?>
          </div>
        </div> <!-- landlord-account-wrapper ends !-->
        <input type="submit" class="btn" name="reg_landlord">
      </form>
    </div> <!-- Container div ends !-->
  </section>
</body>

</html>