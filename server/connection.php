<?php 
    session_start();
    
    $con = mysqli_connect("localhost", "root", "deboHarsh@2022", "easyrentdb");

    if($con) {
        echo"done";
        var_dump($con);
    }else {
        echo"not done";
    }

?>