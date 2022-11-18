<?php 
    session_start();

    function redirect($url) {
        header('Location: '.$url);
        die();
    }
    
    $_SESSION['message'] = "";
    
    $con = mysqli_connect("localhost", "root", "deboHarsh@2022", "easyrentdb");

    if($con) {
    }else {
        echo "Unable to establish connection with the database.";
    }

?>