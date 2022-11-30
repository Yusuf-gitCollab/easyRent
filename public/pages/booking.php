<?php
use LDAP\Result;

require('../../server/connection.php');
  if(isset($_GET['app_ref'])) {
    $app_ref = $_GET['app_ref'];
    
    $query = "SELECT * FROM landlord WHERE mobile_number = '$app_ref'";
    $result = mysqli_fetch_assoc(mysqli_query($con, $query));

    // var_dump($result);
    $app_name = $result['appartment_name'];
    $landlord = $result['landlord_name'];
    $app_type = $result['appartment_type'];
    $app_fac = $result['app_fac'];
    $app_location = $result['appartment_location'];
    $rent = $result['appartment_rent'];
    $mobile_number = $result['mobile_number'];
    $app_status = $result['appartment_occupied'];

    $image_array = array();

    $query = "SELECT * FROM images WHERE app_ref = '$app_ref'";
    $raw_result = mysqli_query($con, $query);

    while($row = mysqli_fetch_assoc($raw_result)) {
      $file_path = "../../server/uploads/" . $row['file_name'];
      array_push($image_array, $file_path);
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../css/style.css">
  <link rel="stylesheet" type="text/css" href="../../css/product-page.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&family=Poppins:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
    integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>Search Result | easyRent</title>
</head>

<body>
  <nav>
    <div class="container">
      <div class="navigation">
        <a href="http://localhost/easyRent/public/index.php">
          <h1 class="logo">easyRent</h1>
        </a>
        <ul class="nav-menu">
          <li><a href="#">Find Rent/PG</a></li>
          <li><a href="./landlord-reg.php">Post Property</a></li>

          <?php
          require('../../server/connection.php');
          if (isset($_SESSION['logedin']) and $_SESSION['logedin'] == true):
          ?>
          <li>
            <a
              href="<?php echo ($_SESSION['usertype'] == 'landlord') ? './landlord-reg.php' : './user-profile.php' ?>">
              <?php
            if (isset($_SESSION['usertype']) and $_SESSION['usertype'] == "tenant") {
              $query = mysqli_query($con, "SELECT * FROM `users` WHERE `email_id`='$_SESSION[username]'");
              $fetch = mysqli_fetch_array($query);
              $str = $fetch['username'];
              $str = substr($str, 0, strpos($str, ' '));
              echo "<i class='fa-solid fa-user'></i>" . "$str";
            } else if (isset($_SESSION['usertype']) and $_SESSION['usertype'] == "landlord") {
              $query = mysqli_query($con, "SELECT * FROM `landlord` WHERE `email_id`='$_SESSION[username]'");
              $fetch = mysqli_fetch_array($query);
              $str = $fetch['landlord_name'];
              $str = substr($str, 0, strpos($str, ' '));
              echo "<i class='fa-solid fa-user'></i>" . "$str";
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
      <div class="product-wrapper">
        <h1> <?php echo "$app_name" ?> </h1>
        <h4>Owner: <?php  echo "$landlord" ?> </h4>
        <div class="img-wrapper">
          <div class="img">
            <?php if(count($image_array) > 0) : ?>
              <img src='<?php echo"$image_array[0]" ?>' alt="">
            <?php endif?>
          </div>
          <div class="small-img-container">
            <?php if(count($image_array) > 1) : ?>

            <?php endif ?>
          </div>
        </div>
        <div class="info">
          <p> Location:  <?php echo "$app_location" ?> </p>
          <p>Appartment Type:  <?php echo "$app_type" ?> </p>
          <p>Facilities Available:  <?php echo "$app_fac" ?> </p>
          <p class="highlight">Rent: <?php echo "$rent" ?> per month </p>
        </div>

        <div class="info">
          <p> Owner:  <?php echo "$landlord" ?> </p>
          <p>Contact:  <?php echo "$mobile_number" ?> </p>
        </div>

        <?php if($app_status === "0"): ?>
          <p>The appartment is available for booking</p>
          <form action="../../server/handle_booking.php" method="GET">
            <input type="hidden" name="app_ref" value='<?php echo"$mobile_number" ?>'>
            <input type="submit" class="btn"  value="Book">
          </form>
        <?php else: ?>
          <p> The appartment is already booked </p>
        <?php endif ?>
      </div>
    </div>
  </section>
</body>

</html>