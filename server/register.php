<?php 

// php script to set up connection with database
require_once('./connection.php');
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
        echo "<script> alert('passwords do not match. Please retype. ') </script>";
        echo "<script> history.back(); </script>";
        die();
    }
    
   $user_check_query = "SELECT * FROM users WHERE username ='$username' OR email_id='$email' LIMIT 1";
   $result = mysqli_query($con, $user_check_query);
   $user = mysqli_fetch_assoc($result);


    if($user) {
        if($user['mobile_number'] === $mobile_number) {
            array_push($errors, "Mobile number already registered.");
            echo "<script> alert('Mobile number already registered. Login instead!') </script>";
            echo "<script> history.back(); </script>";
            die();
        }

        if($user['email_id'] === $email) {
            array_push($errors, "Email already exists registered.");
            echo "<script> alert('Email already registered. Login instead!') </script>";
            echo "<script> history.back(); </script>";
            die();
        }

        array_push($errors, "Looks like you are already registered. Try logging in or create new account with another mobile number and email address");
    }

    if(count($errors) == 0) {
        $password = $pwd1; // encrypt the password before saving
        $uniq_id = uniqid("$mobile_number");

        $query = "INSERT INTO users (userid, mobile_number, email_id, username, pwd, appartment_id) 
                  VALUES('$uniq_id', '$mobile_number', '$email', '$username', '$password', null) ";

        try {
            mysqli_query($con, $query);
            if(isset($_SESSION['usertype']) and  $_SESSION['usertype'] == "landlord") {
                session_destroy();
                session_start();
            }

            $_SESSION['username'] = $email;
            $_SESSION['logedin'] = true;
            $_SESSION['success'] = "you are registered";
            $_SESSION['usertype'] = "tenant";
            $_SESSION['edit-profile'] = false;
            
            echo "<script>alert('Login Successfully!')</script>";
            echo "<script>window.location.href='../public/index.php'</script>";
            die();
        }catch(Exception $e) {
            echo "<script> alert('woops some error occured. Please try again or contact support team.') </script>";
            echo "<script> history.back(); </script>";
            echo "here we are";
            die();
        }
    }else {
        echo "<script> alert('woops some error occured. Please try again or contact support team.') </script>";
        echo "<script> history.back(); </script>";
        die();
    }

}

if(isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($con, $_POST['email_id']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if(count($errors) == 0) {
        echo "$password";
        $query = "SELECT * FROM users WHERE email_id = '$email' AND pwd = '$password'";
        $results = mysqli_query($con, $query);
        if(mysqli_num_rows($results) == 1) {
            if(isset($_SESSION['usertype']) and  $_SESSION['usertype'] == "landlord") {
                session_destroy();
                session_start();
            }
            $_SESSION['username'] = $email;
            $_SESSION['success'] = "You are now logged in!";
            $_SESSION['logedin'] = true;
            $_SESSION['usertype'] = "tenant";
            $_SESSION['edit-profile'] = false;
            echo "<script>alert('Login Successfully!')</script>";
            echo "<script>window.location='../public/index.php'</script>";
        }else {
            echo "<script> alert('Wrong email or password combination. Please try again') </script>";
            echo "<script> history.back(); </script>";
            die();
        }
    }
}


if(isset($_POST['reg_landlord'])) {
    // this is for the landlord image which will be saved in landlord table
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    $target_dir = "uploads/";
    $target_file = "";

    $username = mysqli_real_escape_string($con, $_POST['landlord_name']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $email = mysqli_real_escape_string($con, $_POST['email_id']);
    $pwd = mysqli_real_escape_string($con, $_POST['password']);
    $mobile_number = mysqli_real_escape_string($con, $_POST['mobile_number']);

    $appartment_name = mysqli_real_escape_string($con, $_POST['app_name']);
    $appartment_number = mysqli_real_escape_string($con, $_POST['app_no']);
    $appartment_location = mysqli_real_escape_string($con, $_POST['app_loc']);
    $appartment_rent = mysqli_real_escape_string($con, $_POST['app_rent']);
    $appartment_type = mysqli_real_escape_string($con, $_POST['app_type']);
    $appartment_facilities = mysqli_real_escape_string($con, $_POST['app_fac']);

    $user_check_query = "SELECT * FROM landlord WHERE landlord_name = '$username' OR email_id = '$email' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if($user) { // if user with the mobile number or email_id exists then 
        echo "<script> alert('The email id or password is already registered. Try loggin in instead')</script>";
        echo "<script> window.location.replace('http://localhost/easyRent/public/pages/log-option.html') </script>";
        die();
    }

    // insert data into landlord table as images table id is a foreign key referncing the mobile number of landlord table
    if(count($errors) == 0) {

        echo "$pwd";
        $appartment_id = uniqid($mobile_number);
        $query = "INSERT INTO landlord (appartment_id, landlord_name, appartment_name, appartment_type, appartment_number
        , appartment_rent, landlord_pwd, email_id, mobile_number, profile_pic, landlord_location, appartment_location, app_fac )
                  VALUES('$appartment_id', '$username', '$appartment_name', '$appartment_type', '$appartment_number', '$appartment_rent', 
        '$pwd', '$email', '$mobile_number', '$target_file', '$location', '$appartment_location', '$appartment_facilities' )";
        
        try {
            mysqli_query($con, $query);
            if(isset($_SESSION['usertype']) and  $_SESSION['usertype'] == "tenant") {
                session_destroy();
                session_start();
            }
            $_SESSION['username'] = $email;
            $_SESSION['success'] = "You are now logged in!";
            $_SESSION['logedin'] = true;
            $_SESSION['usertype'] = "landlord";
            $_SESSION['edit-profile'] = false;
        }catch (Exception $e) {
            echo "<script> alert('Mobile number or email already exists. Please try again or contact support team') </script>";
            echo "<script> history.back(); </script>";
            die();
        }
    }

    // for getting the appartment photos:
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $file_names = array_filter($_FILES['appartment_images']['name']);

    if(!empty($file_names)) {
        foreach($_FILES['appartment_images']['name'] as $key => $val) {
            // file upload path
            $file_name = uniqid() . basename($_FILES['appartment_images']['name'][$key]);
            $targetFilePath =   $target_dir.$file_name;

            // check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)) {
                // upload file to server
                if(move_uploaded_file($_FILES['appartment_images']['tmp_name'][$key], $targetFilePath)) {
                    $insertValuesSQL .= "(\""."$file_name"."\"".", "."\""."$mobile_number"."\""."),";
                }else {
                    $errorUpload .= $_FILES['appartment_images']['name'][$key].' | ';
                }
            }else {
                $errorUploadType .= $_FILES['appartment_images']['name'][$key].' | '; 
            }
        }

        // Error message
        $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
        $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
        $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
        $uploadOk = false;
    
        if(!empty($insertValuesSQL)) {
            $insertValuesSQL = trim($insertValuesSQL, ',');
            // insert image file name into the database
            $insert = $con -> query("INSERT INTO images (file_name, app_ref) VALUES $insertValuesSQL");
            if($insert){ 
                $statusMsg = "Files are uploaded successfully.".$errorMsg; 
            }else{ 
                $statusMsg = "Sorry, there was an error uploading your file."; 
            }
        }else{ 
            $statusMsg = "Upload failed! ".$errorMsg; 
        }
    
    }else {
        $statusMsg = "please select file to upload";
    }

    echo "<script> alert( '$statusMsg') </script>";
    echo "<script> window.location.replace('http://localhost/easyRent/public/pages/landlord-reg.php') </script>";
    die();
 
}

if(isset($_POST['login_landlord'])) {
    $email = mysqli_real_escape_string($con, $_POST['email_id']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $query = "SELECT * FROM landlord WHERE email_id = '$email' AND landlord_pwd = '$password'";
    $results = mysqli_query($con, $query);
    if(mysqli_num_rows($results) == 1) {
        if(isset($_SESSION['usertype']) and  $_SESSION['usertype'] == "tenant") {
            session_destroy();
            session_start();
        }
        $_SESSION['username'] = $email;
        $_SESSION['success'] = "You are now logged in!";
        $_SESSION['logedin'] = true;
        $_SESSION['edit-profile'] = false;
        $_SESSION['usertype'] = "landlord";
        echo "<script>alert('Login Successfully!')</script>";
        echo "<script>window.location.href ='../public/pages/landlord-reg.php'</script>";
    }else {
        array_push($errors, "Wrong Email / password combination");
        echo "<script> alert('wrong email or password combination. Try again or create a new account.') </script>";
        echo "<script> history.back(); </script>";
    }
    
}

if(isset($_POST['logout_landlord'])) {
    echo "<script> alert('You are successfully logged out') </script>";
    echo"<script> window.location.href = './logout.php'; </script>";
}

if(isset($_POST['delete_landlord'])) {
    $email_id = $_SESSION['username'];
    $result = mysqli_fetch_assoc(mysqli_query($con, "SELECT mobile_number FROM landlord WHERE email_id = '$email_id'"));
    $mobile_number = $result['mobile_number'];

    //unlink from uploads
    $img_query = "SELECT * FROM images where app_ref = '$mobile_number'";
    $query_result = mysqli_query($con, $img_query);
    $row = mysqli_fetch_assoc($query_result);
    while($row !== null) {
        $image_path = "uploads/".$row['file_name'];
        $r = unlink($image_path);
        $row = mysqli_fetch_assoc($query_result);
    }

    $query = "DELETE FROM images WHERE app_ref = '$mobile_number'";
    mysqli_query($con, $query);

    $query = "DELETE FROM landlord WHERE mobile_number = '$mobile_number'";
    mysqli_query($con, $query);
    echo "<script> alert('Sorry to see you go. Your Accont has been deleted permanantly') </script>";
    require_once('./logout.php');
    die();
}

if(isset($_POST['edit_landlord'])){
    $_SESSION['edit-profile'] = true;
    header('Location: http://localhost/easyRent/public/pages/landlord-reg.php');
    exit();
}

if(isset($_POST['resave_landlord'])) {
    // first delete the previus info from the databse
    
    $_SESSION['edit-profile'] = false;
    header('Location: http://localhost/easyRent/public/pages/landlord-reg.php');
    exit();
}

if(isset($_POST['cancel_edit_landlord'])) {
    $_SESSION['edit-profile'] = false;
    header('Location: http://localhost/easyRent/public/pages/landlord-reg.php');
    exit();
}

?>