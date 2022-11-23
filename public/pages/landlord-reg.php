<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | easyRent</title>
    <link href="../../css/style.css" rel="stylesheet" type="text/css">
    <link href="../../css/register.css" rel="stylesheet" type="text/css">
    
</head>
<body>
    <nav>
        <div class="container">
          <div class="navigation">
            <a href="../index.php"><h1 class="logo">easyRent</h1></a>
            <ul class="nav-menu">
              <li><a href="">Find Rent/PG</a></li>
              <li><a href="">Coworking</a></li>
              <li><a href="">Post Property</a></li>
              <li><a href=""> My Account </a></li>
            </ul>
            
          </div>
        </div>
      </nav>
    <div class="hero">
      <h1 class="reg_log-heading">Registration for Landlords</h1>
        <div class="form-box">
            <form action="../../server/register.php" method="post">
                <div class="form-wrapper">
                    <h1 class="heading">Register with us!</h1>
                    <div class="input-wrapper">
                        <label for="name">Name</label>
                        <input type="text" name="name" required>
                        
                        <label for="email_id">Email</label>
                        <input type="email" name="email_id" required>
                        
                        <label for="password">Password</label>
                        <input type="password" name="password1" minlength="0" required>

                        <label for="password">Confirm Password</label>
                        <input type="password" name="password2" minlength="0" required>
                        
                        <label for="mobile_number">Mobile Number</label>
                        <input type="number" name="mobile_number" required>

                        <input type="submit" class="btn" name="reg_landlord">
                        <p>Already registered ? <a href="./login.html">Login</a></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>