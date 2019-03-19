<?php
    session_start();
    
?>


<?php
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
    <style>
       /* Set the size of the div element that contains the map */
      #map {
        height: 400px;  /* The height is 400 pixels */
        width: 100%;  /* The width is the width of the web page */
       }
    </style>
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
          <div class=" container col-8">
              <img class="detailImage" id="" src="<?php echo $imageLink; ?>" alt="house pic">
          </div>
          <div class="col-4">
              <div class="row">
                  <h2><?php echo $ownerName; ?></h1>
                </div>
                <div class="row">
                    <h3><?php echo $ownerMail; ?></h5>
                </div>
                <div class="row">
                    <h3><?php echo $ownerPhone;?></h5>
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
                    <p class="infoText" id="houseAddress"><?php echo $address ?></p>  
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

        <!-- Google map -->
        <div class = "container-fluid" id="map">

        </div>

    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>

    
       
    var geocoder;
    var map;
    var bounds;
    var infoWindow;
    //var address = "new york city";
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: { lat: 21.046370, lng: 105.795243 } //Where map is focus
        });
        geocoder = new google.maps.Geocoder();
        bounds = new google.maps.LatLngBounds();
        infoWindow = new google.maps.InfoWindow();
        geocoder.geocode({'address': $("#houseAddress").text()}, function(results, status){
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                map: map,
                icon: {
                    url: "https://cdn0.iconfinder.com/data/icons/map-and-navigation-2-1/48/100-512.png",
                    scaledSize: new google.maps.Size(50, 50)
                    },
                position: results[0].geometry.location
                });

                bounds.extend(marker.getPosition());
                map.fitBounds(bounds);
            }
        }); 
    }

    function getLocation(address){
        var location = {};
        geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                //console.log(typeof(results[0].geometry.location.lat()));
                //return results[0].geometry.location;
                location['long'] = results[0].geometry.location.lat();
                location['lat'] = results[0].geometry.location.lng();
            } 
            
        });

        return location;
    }
    
    function makeMarker(address, title, theID){
        geocoder.geocode({'address': address}, function(results, status){
            if (status === 'OK') {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                map: map,
                icon: {
                    url: "https://cdn1.iconfinder.com/data/icons/real-estate-set-2/512/17-512.png",
                    scaledSize: new google.maps.Size(50, 50)
                    },
                position: results[0].geometry.location
                });

                bounds.extend(marker.getPosition());
                map.fitBounds(bounds);

                google.maps.event.addListener(marker, 'click', function(){
                    infoWindow.close(); // Close previously opened infowindow
                    infoWindow.setContent('<div><a href="DetailPage.php?id=' + theID + '">' + title + '</a></div>');
                    infoWindow.open(map, marker);
                });
            }

        });

        
    }
    

    $(document).ready(function() {
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
            console.log("Medone");
            response = JSON.parse(response);
            for(var i = 0; i < response.length; ++i){
                
                var tempAdd = response[i].address;
                var tempTitle = response[i].title;
                var tempID = response[i].id;
                var location = getLocation(tempAdd);
                
                // var latLng = new google.maps.LatLng(location['lat'], location['long']);
                //console.log(latLng);
                makeMarker(tempAdd, tempTitle, tempID);
                    
            }
            
        });

        

    });
    </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB21S73adph9lNEIhidoOMwtDvXQlxnq7s&callback=initMap"
        async defer></script>
  </body>
</html>