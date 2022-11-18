<?php 

// php script to set up connection with database
include("./connection.php");
$username = "";
$email = "";
$mobile_number = "";
$pwd1 = "";
$pwd2 = "";
$errors = array();

if(isset($_POST['reg_user'])) {
    $username = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email_id']);
    $pwd1 = mysqli_real_escape_string($con, $_POST['password1']);
    $pwd2 = mysqli_real_escape_string($con, $_POST['password2']);
    $mobile_number = mysqli_real_escape_string($con, $_POST['mobile_number']);

    if($pwd1 != $pwd2) {
        array_push($errors, "Passwords don't match. Please make sure that password and confirm password are both same");
    }
    
   $user_check_query = "SELECT * FROM users WHERE username ='$username' OR email_id='$email' LIMIT 1";
   $result = mysqli_query($con, $user_check_query);
   $user = mysqli_fetch_assoc($result);


    if($user) {
        if($user['mobile_number'] === $mobile_number) {
            array_push($errors, "Mobile number already registered.");
        }

        if($user['email_id'] === $email) {
            array_push($errors, "Email already exists registered.");
        }

        array_push($errors, "Looks like you are already registered. Try logging in or create new account with another mobile number and email address");
    }

    if(count($errors) == 0) {
        $password = md5($pwd1); // encrypt the password before saving
        $uniq_id = uniqid("$mobile_number");

        $query = "INSERT INTO users (userid, mobile_number, email_id, username, pwd, appartment_id) 
                  VALUES('$uniq_id', '$mobile_number', '$email', '$username', '$password', null) ";

        mysqli_query($con, $query);
        $_SESSION['username'] = $username;
        $url = 'http://localhost/easyRent/public/';
        redirect($url);
        
    }else {
        include('./errors.php');
    }

}


?>