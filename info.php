<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <!-- bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
 
  <title>info</title>
  <style>
    .nav.navbar-nav.navbar-right li a {
        color: white;
    }

    .info{
        margin: 0px auto;
        padding: 30px;
        width: 82%;
    }

    #parallax {
        /* The image used */
        background-image: url("images/background2.jpg");
        height: 480px;
        box-shadow: inset 0px 0px 10px rgba(0,0,0,0.9);
        background-position: center;
        background-size: cover;
    }
    #block_picture{
        box-shadow: inset 0px 0px 10px rgba(0,0,0,0.9);

    }
    #inner{
        box-shadow: inset 0px 0px 10px rgba(0,0,0,0.9);
        width: 82%;
        margin:0 auto;

    }
    #body > .row{
      margin-top:5px;
    }

    table td:first-child{
      font-weight: bold;
      text-align: left;
      width: 110px;

    }

    table td{
      text-align: right;
      flex:auto;
      font-weight: normal;
    }

    .carousel-inner img {
      max-height: 400px;
      max-width: 100%;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }

    .black{
      height: 450px;
    }
    .ourLogo{
    height: auto;
    width: auto;
    max-height: 60px;
    max-width: 100px;
    line-height: 120px;
    vertical-align: middle;
}

.loginSignupContainer > * {
    margin: 0 5px;
    float: right;
}
.loginInfo {
    max-height: 180px;
    height: auto;
}
.navbar-light .navbar-nav .active> .homeNavLink {
    color: white;
    font-size: large;
}

.navbar-light .navbar-nav .active> .homeNavLink:hover {
    background: #17a2b8;
    border-radius: 5px;
}

.navbar-light .navbar-nav .dropdownNavLink {
    color: rgb(238, 238, 238);
    font-size: large;
}
    
  </style>

</head>

<body>
  <!--header-->
  <?php
    require 'navbar.php';
  ?>

  <!--picture-->
  <div id="block_picture" class="container-fluid d-block bg-info">
    <div id="inner" style="box-shadow: inset 0px 0px 10px rgba(0,0,0,0.9);">
      <div class="black row bg-dark">
        <div id="image-carousel" class="carousel slide col-lg-9" data-ride="carousel">
          <ol class="carousel-indicators"></ol>
          <div class="carousel-inner"></div>
          <a class="carousel-control-prev" href="#image-carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#image-carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <!--Register_form-->
        <!--Header-->
        <div class="col bg-white" style="box-shadow: inset 0px 0px 10px rgba(0,0,0,0.9);">
          <div class=" row-xs-6">
            <h5 style="margin: 12px;">
              <strong>Contact Listing Agent</strong>
            </h5>
          </div>
          <div class="row" style="font-size:10px;margin-bottom:10px; ">
            <div class="col-3 ">
              <img src="images/user_m_00_m.gif" style="width:50px;height: 50px;position: relative;">
            </div>
            <div class="col-8">
              <p id="poster" style="color:black;"></p>
              <p id="phone"></p>
              <p id="email"></p>
            </div>
          </div>

          <!--form-->
          <div class="form">
            <!--Name and phone-->
            <div class="form-row">
              <div class="col">
                <input type="text" class="form-control" placeholder="name">
              </div>
              <div class="col">
                <input type="text" class="form-control" placeholder="phone">
              </div>
            </div>
            <!--email-->
            <div class="row-xs-6 form-group">
              <input class="form-control" type="text" placeholder="email" style="margin-top:5px;" />
            </div>
            <!--Write a text-->
            <div class="row-xs-6 form-group">
              <textarea class="rounded" name="comment" form="usrform"> Enter text here...</textarea>
            </div>
            <!--Check if u want to talk about financing-->
            <div class="row form-group">
              <div class="form-check form-check-inline" style="margin-left:15px;">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                <label class="form-check-label" for="inlineCheckbox1">I want to talk about financing</label>
              </div>
            </div>
            <!--button-->
            <div class="row-xs-6 form-group">
              <button class="btn btn-danger btn-block">Request Info</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!--body-->
  <div class="container-fluid d-block bg-white" style="padding-top:20px;padding-bottom: 20px;">
    <div class="info bg-white border border-primary rounded">
      <div class="title border-bottom" id="title">
      </div>

      <!--Get_info-->
      <div id="body" class="d-block" style="padding-top:20px">
        <div class="row">
          <div class="col">
            <!--description-->
            <h5><b>Description:</b></h5>
            <p id="description" style="white-space: pre-line;"></p>
          </div>
          <div class="col-sm-5 border border-primary rounded" style="background-color:skyblue">
            <table style="width:100%;">
              <!--Property-->
              <tr>
                <td>Type of housing:</td>
                <td id="housing_type"></td>
              </tr>

              <!--Address-->
              <tr>
                <td >Address:</td>
                <td id="address"  style="font-weight: normal;"> Nguyễn Trãi, Nguyễn Cư Trinh, Quận 1, Hồ Chí Minh   </td>
              </tr>
              <!--Cost-->
              <tr>
                <td>Price:</td>
                <td style="text-align:right;"><span id="price" class="badge badge-lg badge-danger">9.5 mil</span></td>
              </tr>
              <!--Sqft-->
              <tr>
                <td>Surface area:</td>
                <td id="surface_area">40 m²</td>
              </tr>
              <!--Day_pushlish-->
              <tr>
                <td>Posted on:</td>
                <td id="start_date">01/11/2018</td>
              </tr>
              <tr>
                <td>Expired on:</td>
                <td id="expiry_date">16/12/2018</td>
              </tr>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!--footer-->
  <div class="footer bg-info" style="text-align:center;">
    <p>Copyright by USTH 2018</p>
    <p>All right reserved</p>
    <img src="images/logo.png" class="img-responsive img-square margin" style="display:inline" alt="usth" width="200"
      height="100">
  </div>

  <script>
    function formatPrice(price) {
      if (price > 1) {
        res = Math.round(price * 10) / 10 + " billions";
      } else {
        res = Math.round(price * 1000) + " millions";
      }
      return res;
    }
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    const indexName = urlParams.get('index');

    var client = algoliasearch('MQ39V1L64H', '89090a11fec2dfe035ee55d52a4d1f7a');
    var index = client.initIndex(indexName);
    index.getObject(id, function (err, content) {
      $(document).ready(function () {
        $("#poster").text(content.poster_name);
        $("#phone").text(content.poster_phone);
        $("#email").text(content.poster_email);

        $("#title").text(content.title);
        $("#description").html("Nh\u1eefng \u0111i\u1ec1u b\u1ea1n c\u1ea7n ph\u1ea3i bi\u1ebft khi mua Vincity Qu\u1eadn 9:<br><br>Ch\u1ec9 t\u1eeb 200 tri\u1ec7u tr\u1ea3 trong v\u00f2ng 6 th\u00e1ng l\u00e0 c\u00f3 \u0111\u01b0\u1ee3c h\u1ed9 kh\u1ea9u S\u00e0i G\u00f2n.<br><br>2 n\u0103m sau m\u1edbi ph\u1ea3i tr\u1ea3 ti\u1ebfp.<br><br>Khu \u0111\u00f4 th\u1ecb \u0111\u01b0\u1ee3c quy ho\u1ea1ch \u0111\u1ed3ng b\u1ed9, v\u0103n minh, hi\u1ec7n \u0111\u1ea1i, \u0111\u1eb7c bi\u1ec7t s\u1edf h\u1eefu c\u00f4ng vi\u00ean ven s\u00f4ng quy m\u00f4 h\u00e0ng \u0111\u1ea7u \u0110\u00f4ng Nam \u00c1 - 36ha.<br><br>\u0110\u01b0\u1eddng V\u00e0nh \u0110ai 3 ch\u1ea1y gi\u1eefa l\u00f2ng d\u1ef1 \u00e1n.<br><br>C\u0103n h\u1ed9 \u0111\u01b0\u1ee3c thi\u1ebft k\u1ebf th\u00f4ng minh ph\u1ee5c v\u1ee5 cho nhi\u1ec1u \u0111\u1ed1i t\u01b0\u1ee3ng c\u01b0 d\u00e2n kh\u00e1c nhau.<br><br>Ti\u1ec7n \u00edch th\u00ec v\u00f4 v\u00e0n \u0111\u1ebfm kh\u00f4ng xu\u1ec3.<br><br>Cam k\u1ebft b\u00e1n gi\u00e1 g\u1ed1c c\u1ee7a C\u0110T.<br><br>Li\u00ean h\u1ec7 0901 868 915 \u0111\u1ea1i l\u00fd F1 \u0111\u1ec3 nh\u1eadn th\u00eam th\u00f4ng tin chi ti\u1ebft.<div class=\"product-tag\"></div><div class=\"warp-style\"><ins class=\"adsbygoogle\" style=\"display:block\" data-ad-client=\"ca-pub-1882771695480141\" data-ad-slot=\"4545052818\" data-ad-format=\"auto\" data-full-width-responsive=\"true\"></ins></div>");
        $("#housing_type").text(content.housing_type);
        $("#address").text(content.address);
        $("#price").text(formatPrice(content.price));
        $("#surface_area").text(content.surface_area);
        $("#start_date").text(content.start_date);
        $("#expiry_date").text(content.expiry_date);

        console.log(content.img_links)
        for (var i = 0; i < content.img_links.length; i++) {
          $('<div class="carousel-item"><img src="' + content.img_links[i] + '"></div>').appendTo('.carousel-inner');
          $('<li data-target="#image-carousel" data-slide-to="' + i + '"></li>').appendTo('.carousel-indicators');
        }
        $('.carousel-item').first().addClass('active');
        $('.carousel-indicators > li').first().addClass('active');
        $('#image-carousel').carousel();
      });
    });
  </script>
</body>

</html>