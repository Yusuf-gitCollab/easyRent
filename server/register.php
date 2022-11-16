<?php 

    // php script to set up connection with database
    include('./connection.php');

    $username = "";
    $email = "";
    $mobile_number = "";
    $pwd1 = "";
    $pwd2 = "";
    $errors = array();

    if(isset($_POST['reg_user'])) {
        $username = mysqli_real_escape_string($con, $_POST['name']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $pwd1 = mysqli_real_escape_string($con, $_POST['password1']);
        $pwd2 = mysqli_real_escape_string($con, $_POST['password2']);
        $mobile_number = mysqli_real_escape_string($con, $_POST['mobile_number']);


        echo"$username <br/> $email <br/>";

    }


?>