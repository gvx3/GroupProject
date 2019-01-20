<?php
    session_start();
    $_SESSION['current_page'] = $_SERVER['REQUEST_URI'];
?>
 

<?php
    require 'header.php';
?>

    <?php
        require 'navbar.php';
    ?>

    <!-- END NAVBAR -->

    <section class="main-container">
        <div class="messageWrapper">

            <?php
                if(isset($_GET['error'])) {
                    if($_GET['error'] == 'emptyField'){
                        echo '<p class="signupError"> There are empty fields </p>';
                    }
                    elseif($_GET['error'] == 'invalidEmail'){
                        echo '<p class="signupError"> Invalid email </p>';
                    }
                    elseif($_GET['error'] == 'passwordCheck'){
                        echo '<p class="signupError">repeat password don\'t match</p>';
                    }
                    elseif($_GET['error'] == 'connectionError'){
                        echo '<p class="signupError">Server error, please try again</p>';
                    }
                    elseif($_GET['error'] == 'userTaken'){
                        echo '<p class="signupError">username or email taken</p>';
                    }
                    elseif($_GET['error'] == 'invalidusername'){
                        echo '<p class="signupError">Invalid username</p>';
                    }
                }
                elseif (isset($_GET['signup']) && $_GET['signup'] == 'success'){
                    echo '<p class="signupSuccess"> Sign up success </p>';

                }
            ?>
        </div>

            <div class="signup-form">
                <form action="includes/signup.inc.php" method="POST">
                    <h2>Sign up</h2>
                    <hr>
                    <div class="form-group">
                        <input type="text" class="form-control" name="fullName" placeholder="Full name" value="<?php echo isset($_GET['fullName']) ? $_GET['fullName'] : '' ?>" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" name="mail" placeholder="Email" value="<?php echo isset($_GET['mail']) ? $_GET['mail'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo isset($_GET['username']) ? $_GET['username'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="pwd" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="pwd-repeat" placeholder="Repeat Password">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control" name="phone" placeholder="Phone number">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="city" placeholder="Your city" value="<?php echo isset($_GET['city']) ? $_GET['city'] : '' ?>">
                    </div>
                    <div class="form-group">
                        <label class="checkbox-inline"><input type="checkbox" required> I accept the <a href="#">Term of Use</a> and <a href="#">Privacy Policy</a></label>
                    </div>
                    <div class="form-group">
                            <button type="submit" name="signup-submit" class="btn btn-primary btn-lg">Sign up</button>
                    </div>
                    
                </form>
            </div>
        

    </section>
</div>

<?php
    require 'footer.php';
?>