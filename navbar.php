
<section class="navSection">
    <nav class="navbar navbar-expand-lg navbar-light bg-light ourNav">
            <a class="navbar-brand" href="index.php">
                <img src="images/logoblack.png" alt="logo" class="ourLogo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse parentNavBar" id="navbarSupportedContent">
                <div class="childNavbar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="search.html?index=buy">Buy<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="search.html?index=rent">Rent<span class="sr-only">(current)</span></a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                More
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Mortgage</a>
                                <a class="dropdown-item" href="#">Local Info</a>
                                <a class="dropdown-item" href="#">Additional Resources</a>
                            </div>
                        </li>

                    </ul>
                </div>
                

                
            </div>

            <div class="loginSignupContainer">
                    <!-- AN DEP TRAI HERE-->
                    <?php
                        if(isset($_SESSION['userID'])) {
                            echo '
                            <form action="includes/logout.inc.php" method="POST">
                                <button name="logoutButton" type="submit" class="btn btn-primary">Logout</button>
                            </form>';
                            echo '
                            <div class="loginInfo">
                                <div class="dropdown show">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropDownMenuUser" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="images/user.png" alt="logo">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropDownMenuUser">
                                        <a class="dropdown-item" href="profile.php">Profile</a>
                                        <a class="dropdown-item" href="form.html">Post a form</a>
        
                                    </div>
                                </div>
                            
                            </div>';

                            
                        }
                        else{
                            echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">Login</button>';
                            echo '<a href ="signup.php"><button type="button" class="btn btn-primary">Sign up</button></a>';
                        }

                    ?>
                    
                    
                    
                    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h3 class="modal-title"><b>Login</b></h3>
                            </div>
                            <div class="modal-body ">
                                <form class="justify-content-center login-form " id="loginForm" action="includes/login.inc.php" method="POST">
                                    <div class="form-group usernameContainer">
                                      <input class="form-control" id="inputUsername" type="text" name="userName" placeholder="Username" >
                                    </div>
                                    <div class="form-group passwordContainer">
                                      <input class="form-control" id="inputPassword" type="password" name="userPassword" placeholder="Password">
                                    </div>
                                    <button class="btn btn-primary" type="submit" name="loginButton" id="loginButton">Login</button>
                                    <p id="form_message" style="text-align: center;"></p>
                                  </form>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- Indication show log in or not -->
                
            </div>
            
                <!-- AN DEP TRAI HERE-->
    </nav>
</section>
      