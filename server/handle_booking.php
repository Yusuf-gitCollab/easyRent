<?php
require_once('./connection.php');

if((isset($_SESSION['logedin']) and $_SESSION['logedin'] === true) and (isset($_SESSION['usertype']) and $_SESSION['usertype'] == "tenant")) {
    date_default_timezone_set("Asia/Kolkata");

    $date = date('Y/m/d', time());
    $user_email_id = $_SESSION['username'];
    echo "$user_email_id";
    
    // check if it is already booked
    $app_ref = $_GET['app_ref'];
    
    $query = "SELECT * FROM landlord WHERE mobile_number = '$app_ref'";
    $result = mysqli_fetch_assoc(mysqli_query($con, $query));

    // extract the landlord email id to be used in updation of landlord table
    $landlord_id = $result['email_id'];

    if($result['appartment_occupied'] === "0") {
        // update appartment_id in user table
        $appartment_id = $result['appartment_id'];

        $query_user = "UPDATE users SET appartment_id = '$appartment_id', `start_date` = '$date', end_date= DATE_ADD('$date', INTERVAL 30 DAY) WHERE `email_id` = '$user_email_id' ";
        $query_landlord = "UPDATE landlord SET appartment_occupied = 1, tenant_id = '$user_email_id' WHERE `email_id` = '$landlord_id'";
        try {
            $result = mysqli_query($con, $query_user);
            $result = mysqli_query($con, $query_landlord);
        }catch (Exception $e) {
            echo "$e";
        }
        var_dump( mail( '6000295281@vtext.com', '', 'This was sent with PHP.' ) );

        // update landlord appartment_id start_date end_date
    }else {
        echo "<script> alert('The appartment is already booked. </script>";
        echo "<script> history.back() </script>";
    }
    

}else {
    echo "<script> alert('please login to make a booking.'); </script>";
    echo "<script> window.location.href='http://localhost/easyRent/public/pages/login.html'; </script>";
}
?>