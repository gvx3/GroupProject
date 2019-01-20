<?php

session_start();
require 'includes/dbHandler.inc.php';
$userID = $_SESSION['userID'];

//Prepare sql select statement
$sqlText = "SELECT user_email, full_name, phone, city, user_uid, image_link  FROM users WHERE user_id=?";
$sqlStatement = mysqli_stmt_init($conn);
if(!(mysqli_stmt_prepare($sqlStatement, $sqlText))) {
    echo '<span class="login_error">Server error, please try again</span>';
}
else {
    mysqli_stmt_bind_param($sqlStatement, "s", $userID);
    mysqli_stmt_execute($sqlStatement);
    $result = mysqli_stmt_get_result($sqlStatement);
    $row = mysqli_fetch_assoc($result);
    //Get user info
    $email = $row['user_email'];
    $fullName = $row['full_name'];
    $phone = $row['phone'];
    $city = $row['city'];
    $userName = $row['user_uid'];
    $imageLink = $row['image_link'];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consumer Profile</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="OurJs/OurScript.js"></script>
    <!-- fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="OurCss/ourStyle.css">
    <link rel="stylesheet" href="OurCss/signup.css">
    <style>
        .blur-text{
            opacity: 0.5;
        }

        #sticky{
            position: -webkit-sticky;
            position: sticky;
            top: 0;
        }
    </style>
</head>
<body>
    <?php
        require 'navbar.php';
    ?>  
    <div class="container-fluid" >
            <!--Profile Overview  -->
          <div class="row ">
              <div  class=" col-2 bg-white border-secondary border-right" >
                  <div id="sticky">
                        <div class="pt-2 row justify-content-center ">
                            <h4 id="name"><b>Your profile</b></h4>
                        </div>
                        <div class="border-bottom"></div>
                        <!--Profile pic -->
                        <div class="row justify-content-center">
                                <img id="user-image" src="<?php echo $imageLink ?>" style="width:100px;height:100px;">
                          </div>
                          <!-- User name -->
                          <div class="row justify-content-center">
                              <h4 id="name"><b><?php echo $fullName ?></b></h4>
                          </div>
                          <!--Type of user  -->
                          <div class="row justify-content-center ">
                              <p id="user-type" class="blur-text">Home Buyer</p>
                          </div>
                          <div class="border-bottom"></div>
                          <!-- tel -->
                          <div class="row justify-content-center ">
                                <i id="i-tel" class="mt-2 mb-2 fa fa-mobile-phone" > <?php echo $phone ?></i>    
                          </div>
                          <!-- email -->
                          <div class="row justify-content-center ">
                                <i id="i-email" class="mt-2 mb-2 fa fa-envelope-o" style="font-size:12px"><?php echo $email ?></i>    
                          </div>
                          <!-- location -->
                          <div class="row justify-content-center ">
                                <i id="i-location" class="mt-2 mb-2 fa fa-bank" ><?php echo $city ?></i>    
                          </div>
                  </div>
              </div>
              <!-- Edit profile -->
              <div class="col-10" style="background-color:rgb(226, 226, 226)">
                    <!-- Title  -->
                    <div class="border-dark border-bottom mt-3 mb-3" >
                        <div class="row">
                            <div class="col"><h4><b>Edit Profile</b></h4></div>
                        </div>
                    </div>
                    <!-- Form -->
                    <div class="container border-dark ">
                        <div class="col">
                            <!-- Inner form -->
                            <form id="changeProfileForm" action="includes/changeProfile.inc.php" method="POST" enctype="multipart/form-data">
                                <!-- username -->
                                <div class="form-group">
                                    <label  class="blur-text" for="email-change">EMAIL</label>
                                    <input name="email" type="text" class="form-control-file" id="email-change">
                                </div>
                                <!-- Password -->
                                <div class="p-3 form-group border border-dark rounded">
                                    <label  class="blur-text" for="password-change">PASSWORD</label>
                                    <input name="password" type="password" class="form-control" id="password-change" >
                                    <div class="nt-4 mb-4"></div>
                                    <label  class="blur-text" for="repeat-password-change">CONFIRM PASSWORD</label>
                                    <input name="passwordRepeat" type="password" class="form-control" id="repeat-password-change" >
                                </div>
                                <!-- user image -->
                                <div class="form-group">
                                    <label  class="blur-text" for="input-user-image">IMAGE FILE INPUT</label>
                                    <input name="imageLink" type="file" class="form-control-file" id="input-user-image">
                                </div>
                                <!-- user phone number -->
                                <div class="form-group">
                                    <label class="blur-text" for="input-user-tel">PHONE</label>
                                    <input name="phone" type="tel" class="form-control" id="input-user-tel" aria-describedby="phoneHelp">        
                                </div>
                                <!-- user address -->
                                <div class="form-group">
                                    <label class="blur-text" for="type-location">CITY</label>
                                    <input name="city" type="text" class="form-control" id="type-location" aria-describedby="emailHelp">        
                                </div>
                                <!-- subimt -->
                                <div class="mt-2 mb-2 "></div>
                                <div class="row mb-3 justify-content-center p-3 ">
                                    <!-- Save profile -->
                                    <button name="changeProfileButton" id="save" type="submit" class="btn btn-danger mb-2">Save Profile</button>
                                    <br>
                                    <p id="change_profile_message" style="text-align: center;"></p>
                                </div>
                            </form>
                        </div>
                    </div>
              </div> 
          </div> 
    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
