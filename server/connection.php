<?php 
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    
    $con = mysqli_connect("localhost", "root", "deboHarsh@2022", "easyrentdb");

    if($con) {
    }else {
        echo "Unable to establish connection with the database.";
    }

?>