<?php
    session_start();
    $userID = $_SESSION['userID'];
    if(isset($_POST['changeProfileButton'])){
        require 'dbHandler.inc.php';
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $passwordRepeat = mysqli_real_escape_string($conn, $_POST['passwordRepeat']);
        $imageLink = 'uploaded_images/avatar_images/'.$userID.mysqli_real_escape_string($conn, $_FILES['imageLink']["name"]);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $changeProfileSuccess = false;
        
        //boolean to check empty
        if(!empty($email)){
            $sqlText = "UPDATE users SET user_email=?  WHERE user_id = ?";
            $sqlStatement = mysqli_stmt_init($conn);
            if(!(mysqli_stmt_prepare($sqlStatement, $sqlText))) {
                echo '<span class="login_error">Server error, please try again</span>';
                
            }
            else{
                mysqli_stmt_bind_param($sqlStatement, "ss", $email, $userID);
                mysqli_stmt_execute($sqlStatement);
            }
        }
        //password
        if(!empty($password) && !empty($passwordRepeat)){
            if($password != $passwordRepeat){
                echo '<span class="login_error">password and repeat password are not the same</span>';
                
            }
            else{
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                $sqlText = "UPDATE users SET user_pwd=?  WHERE user_id = ?";
                $sqlStatement = mysqli_stmt_init($conn);
                if(!(mysqli_stmt_prepare($sqlStatement, $sqlText))) {
                    echo '<span class="login_error">Server error, please try again</span>';
                    
                }
                else{
                    mysqli_stmt_bind_param($sqlStatement, "ss", $hashedPwd, $userID);
                    mysqli_stmt_execute($sqlStatement);
                }
            }
            
        }

        //Image
        if(!empty($imageLink)){
            $sqlText = "UPDATE users SET image_link=?  WHERE user_id = ?";
            $sqlStatement = mysqli_stmt_init($conn);
            if(!(mysqli_stmt_prepare($sqlStatement, $sqlText))) {
                echo '<span class="login_error">Server error, please try again</span>';
                
            }
            else{
                mysqli_stmt_bind_param($sqlStatement, "ss", $imageLink, $userID);
                mysqli_stmt_execute($sqlStatement);
            }
            print_r($_FILES);
            $uploadOk = 1;

            $tmp_name = $_FILES["imageLink"]["tmp_name"];
            $ext = pathinfo($_FILES["imageLink"]["name"], PATHINFO_EXTENSION);

            if($ext != "jpg" && $ext != "png" && $ext != "jpeg" && $ext != "gif" ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            $full_path = dirname( dirname(__FILE__) ) . "/" . $imageLink;
            echo $full_path . "\n";
            if ($error == UPLOAD_ERR_OK && $uploadOk == 1) {
                if (move_uploaded_file($tmp_name, $full_path)) {
                    echo "Image successfully uploaded";
                }
            }
        }

        //Phone
        if(!empty($phone)){
            $sqlText = "UPDATE users SET phone=?  WHERE user_id = ?";
            $sqlStatement = mysqli_stmt_init($conn);
            if(!(mysqli_stmt_prepare($sqlStatement, $sqlText))) {
                echo '<span class="login_error">Server error, please try again</span>';
                
            }
            else{
                mysqli_stmt_bind_param($sqlStatement, "ss", $phone, $userID);
                mysqli_stmt_execute($sqlStatement);
            }
        }
        //city
        if(!empty($city)){
            $sqlText = "UPDATE users SET city=?  WHERE user_id = ?";
            $sqlStatement = mysqli_stmt_init($conn);
            if(!(mysqli_stmt_prepare($sqlStatement, $sqlText))) {
                echo '<span class="login_error">Server error, please try again</span>';
                
            }
            else{
                mysqli_stmt_bind_param($sqlStatement, "ss", $city, $userID);
                mysqli_stmt_execute($sqlStatement);
            }
        }

        $changeProfileSuccess = true;
        header("Location: ../profile.php");
        

    }
    else{
        exit();
    }

?>

<script>
    var changeProfileSuccess = "<?php echo $changeProfileSuccess; ?>";
    
    if(changeProfileSuccess == true){
        window.location.reload(true);
    }
</script>