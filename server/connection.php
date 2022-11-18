<?php 
    session_start();

    function redirect($url) {
        header('Location: '.$url);
        die();
    }
    
    $con = mysqli_connect("localhost", "root", "deboHarsh@2022", "easyrentdb");

    if($con) {
    }else {
        echo "Unable to establish connection with the database.";
    }

?>