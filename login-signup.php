<?php
    require "header.php";
?>

    <main>
        <?php
        $username = "";
        $email = "";
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p>Fill in all fields!</p>';
                $username = $_GET['uid'];
                $email = $_GET['mail'];
            } else if ($_GET['error'] == "invalidmailuid") {
                echo '<p>Invalid Email and Invalid Username!</p>';
            } else if ($_GET['error'] == "invalidmail") {
                echo '<p>Invalid Email!</p>';
                $username = $_GET['uid'];
            } else if ($_GET['error'] == "invaliduid") {
                echo '<p>Invalid Username!</p>';
                $email = $_GET['mail'];
            } else if ($_GET['error'] == "passwordcheck") {
                echo '<p>Passwords do not match!</p>';
                $username = $_GET['uid'];
                $email = $_GET['mail'];
            } else if ($_GET['error'] == "userntaken") {
                echo '<p>Username is already taken!</p>';
                $email = $_GET['mail'];
            }
        } elseif (isset($_GET['signup']) == "success") {
            echo '<p>Signup Succesfull!</p>';
        }
        ?>

        <div class="form-grid">
            <ul class="tab-group">
                <li id="tabSign" class="tab active"><a href="javascript:switchVisible('s')">Sign Up</a></li>
                <li id="tabLog" class="tab"><a href="javascript:switchVisible('l')">Log In</a></li>
            </ul>
        
            <div class="tab-content">

                <div id="signup">   
                    <h1 class="form-heading">Sign Up for Free</h1>
                    <div class="form">
                        <form action="includes/signup.inc.php" method="post">
                            <input class="username" type="text" name="uid" placeholder="Username" value="<?php echo $username; ?>" required>
                            <input class="email" type="text" name="mail" placeholder="Email" value="<?php echo $email; ?>" required> 
                            <input class="password" type="password" name="pwd" placeholder="Password" required>
                            <input class="repeat-password" type="password" name="pwd-repeat" placeholder="Repeat Password" required >
                            <button class="btnSubmit" type="submit" name="signup-submit">Signup</button>
                        </form>
                    </div>
                    
                </div>
                
                <div id="login">   
                    <h1 class="form-heading">Welcome Back!</h1>
                    <div class="form">
                            <form action="includes/login.inc.php" method="post" >
                                <input type="text" name="mailuid" placeholder="Username/Email...">
                                <input type="password" name="pwd" placeholder="Password">
                                <button class="btnSubmit" type="submit" name="login-submit">Login</button>
                            </form>
                    </div>
                </div>
                
            </div><!-- tab-content -->
      
        </div> <!-- /form -->
    </main>

<?php
require "footer.php";
?>