
<?php
    echo "<pre>";
    ini_set('display_errors', 'On');


    
    $imageLink = 'uploaded_images/avatar_images/' . "0.jpg";
    echo $imageLink;

    //Image
    if(!empty($imageLink)){
        print_r($_FILES);
        $error = $_FILES["imageLink"]["error"];
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


    $changeProfileSuccess = true;
    // header("Location: ../profile.php");
    


    echo "</pre>";

?>

<script>
    var changeProfileSuccess = "<?php echo $changeProfileSuccess; ?>";
    
    if(changeProfileSuccess == true){
        window.location.reload(true);
    }
</script>