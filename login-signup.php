<?php
require "header.php";
?>

    <main>
        

        <div class="form-grid">
            <ul class="tab-group">
                <li id="tabSign" class="tab active"><a href="javascript:switchVisible('s')">Sign Up</a></li>
                <li id="tabLog" class="tab"><a href="javascript:switchVisible('l')">Log In</a></li>
            </ul>
            
            <div class="tab-content">

                <div id="signup">   
                    <h1 class="form-heading">Sign Up for Free</h1>
                    <?php
                    $username = "";
                    $email = "";
                    if (isset($_GET['error'])) {
                        if ($_GET['error'] == "emptyfields") {
                            echo '<p class="signup-error">Fill in all fields!</p>';
                            $username = $_GET['uid'];
                            $email = $_GET['mail'];
                        } else if ($_GET['error'] == "invalidmailuid") {
                            echo '<p class="signup-error">Invalid Email and Invalid Username!</p>';
                        } else if ($_GET['error'] == "invalidmail") {
                            echo '<p class="signup-error">Invalid Email!</p>';
                            $username = $_GET['uid'];
                        } else if ($_GET['error'] == "invaliduid") {
                            echo '<p class="signup-error">Invalid Username!</p>';
                            $email = $_GET['mail'];
                        } else if ($_GET['error'] == "passwordcheck") {
                            echo '<p class="signup-error">Passwords do not match!</p>';
                            $username = $_GET['uid'];
                            $email = $_GET['mail'];
                        } else if ($_GET['error'] == "userntaken") {
                            echo '<p class="signup-error">Username is already taken!</p>';
                            $email = $_GET['mail'];
                        }
                    } elseif (isset($_GET['signup']) == "success") {
                        echo '<p class="signup-success">Signup Succesfull!</p>';
                    }
                    ?>
                    <div class="form">
                        <form action="includes/signup.inc.php" method="post" autocomplete="off">
                            <input class="username" type="text" name="uid" placeholder="Username" value="<?php echo $username; ?>" required>
                            <input class="email" type="text" name="mail" placeholder="Email" value="<?php echo $email; ?>" required> 
                            <input class="password" type="password" name="pwd" placeholder="Password" required>
                            <input class="repeat-password" type="password" name="pwd-repeat" placeholder="Repeat Password" required >
                            <button  type="submit" name="signup-submit">Signup</button>
                        </form>
                    </div>
                    
                </div>
                
                <div id="login">   
                    <h1 class="form-heading">Welcome Back!</h1>
                    <?php
                    if (isset($_GET['errorlog'])) {
                        echo "<script type='text/javascript'>switchVisible('l');</script>";
                        if ($_GET['errorlog'] == "emptyfields") {
                            echo '<p class="signup-error">Fill In All Fields!</p>';
                        } else if ($_GET['errorlog'] == "sqlerror") {
                            echo '<p class="signup-error">Unexpected Server Error!</p>';
                        } else if ($_GET['errorlog'] == "wrongpassworduser") {
                            echo '<p class="signup-error">Wrong Password or Username!</p>';
                        }
                    }
                    //  elseif (isset($_GET['signup']) == "success") {
                    //     echo '<p class="signup-success">Signup Succesfull!</p>';
                    // }
                    ?>
                    <div class="form">
                            <form action="includes/login.inc.php" method="post" >
                                <input type="text" name="mailuid" placeholder="Username/Email...">
                                <input type="password" name="pwd" placeholder="Password">
                                <a class="forgot-password" href="reset-password.php">Forgot Password?</a>
                                <button type="submit" name="login-submit">Login</button>
                            </form>
                    </div>
                </div>
                
            </div><!-- tab-content -->
      
        </div> <!-- /form -->
    </main>

<?php
require "footer.php";
?>