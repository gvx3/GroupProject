<?php
    session_start();
    
?>


<?php
    $test = "welcome master";
    $testImage = "https://i.pinimg.com/originals/92/df/87/92df87f34c7ec813d7aadfd52b6a464b.png";
    if(isset($_GET["id"])){
        //Get all the detailed info
        require 'includes/dbHandler.inc.php';
        //get all the column data from batdongsan
        $sqlText = "SELECT * FROM batdongsan WHERE id = ?";

        $sqlStatement = mysqli_stmt_init($conn);
        if($sqlStatement = mysqli_prepare($conn, $sqlText)) {
            mysqli_stmt_bind_param($sqlStatement, "i", $_GET['id']);
            mysqli_stmt_execute($sqlStatement);
            $result = mysqli_stmt_get_result($sqlStatement);
            
            while($row = mysqli_fetch_assoc($result)){
                $title = $row['title'];
                $imageLink = $row['image'];
                $bedroom = $row['bedrooms'];
                $address = $row['address'];
                $price = $row['price'];
                $area = $row['area'];
                $utilities = $row['utilities'];
                $places_neaby = $row['places_nearby'];
                $legal = $row['legal'];
                $city = $row['city'];
                $ownerID = $row['owner_id'];
                $description = $row['description'];
            }
        }

        //get all the poster data from table poster
        $sqlText = "SELECT * FROM owner WHERE id = ?";

        $sqlStatement = mysqli_stmt_init($conn);
        if($sqlStatement = mysqli_prepare($conn, $sqlText)) {
            mysqli_stmt_bind_param($sqlStatement, "i", $ownerID);
            mysqli_stmt_execute($sqlStatement);
            $result = mysqli_stmt_get_result($sqlStatement);
            
            while($row = mysqli_fetch_assoc($result)){
                $ownerName = $row['owner_name'];
                $ownerMail = $row['email'];
                $ownerPhone = $row['phone'];
            }
        }

        mysqli_stmt_close($sqlStatement);
        mysqli_close($conn);
    }   
    else {
        header("Fuc you");
    }

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom made CSS -->
    <link rel="stylesheet" href="OurCss/ourStyle.css">
    <link rel="stylesheet" href="OurCss/signup.css">
    <link rel="stylesheet" href="OurCss/searchForm.css">
    <title>Details</title>
  </head>
  <body>
    <!-- The nav bar -->
    <?php
        require 'navbar.php';
    ?>
    <!-- House picture and poster detail -->
    <div class="container-fluid">
      <div class="row">
          <div class=" container-fluid col-8">
              <img id="" src="<?php echo $imageLink; ?>" alt="house pic">
          </div>
          <div class="col-4">
              <div class="row">
                  <h2><?php echo $ownerName; ?></h1>
                  <h3><?php echo $ownerMail; ?></h5>
                  <h3><?php echo $ownerPhone; ?></h5>
              </div>
          </div>
      </div>
  </div>
  <!-- Detail info -->
    <div class="container-fluid">
    <h3>Home details</h3>
        <!-- Overview -->
        <div class="row">
            <div class="col-md-4">
                <h4 data-i18n-key="Date.time.location">Overview</h4>
            </div>
            <div class="col-md-8">
                <hr>
                <div class="container">
                    <p class="infoText"><?php echo $bedroom ?></p>
                    <p class="infoText"><?php echo $price ?></p>
                    <p class="infoText"><?php echo $area ?></p>
                    <p class="infoText"><?php echo $address ?></p>  
                </div>

            </div>
        </div>
        <!-- Description -->
        <div class="row">
            <div class="col-md-4">
                <h4 data-i18n-key="Date.time.location">Description</h4>
            </div>
            <div class="col-md-8">
                <hr>
                <div class="container">
                    <p class="infoText"><?php echo $description ?></p>
                </div>

            </div>
        </div>
        <!-- Features -->
        <div class="row">
            <div class="col-md-4">
                <h4 data-i18n-key="Date.time.location">Features</h4>
            </div>
            <div class="col-md-8">
                <hr>
                <div class="container testDiv">
                    <p class="infoText"><?php echo $utilities ?></p>
                    <p class="infoText"><?php echo $places_neaby ?></p>
                    <p class="infoText"><?php echo $legal ?></p>
                </div>
            </div>
        </div>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
    
    $(document).ready(function() {
        $(".testDiv").append('<p class="infoText"><?php echo "Yeah Yeah Yeah" ?></p>');
        var $_GET = {};
        if(document.location.toString().indexOf("?") !== -1){
            var query = document.location.toString().replace(/^.*?\?/, '').split("&");
            l = query.length;
            for(var i = 0;  i <l; ++i){
                var subQuery = decodeURIComponent(query[i]).split("=");
                $_GET[subQuery[0]] = subQuery[1];
            }
        }
        houseID = $_GET['id'];
        searchRequest = $.ajax({
            method: "post",
            url: "includes/Get5Houses.inc.php",
            data: houseID
        });

        searchRequest.done(function (response, textStatus, jqXHR){
            response = JSON.parse(response);
            console.log(response);
        });

    });
    </script>
  </body>
</html>