<?php
require "header.php";
?>

    <main>
        <h1>Singup</h1>
        <?php
        if (isset($_GET['error'])) {
            if($_GET['error']=="emptyfields"){
                echo '<p>Fill in all fields!</p>';
            }else if($_GET['error']=="invalidmailuid"){
                echo '<p>Invalid Email and Invalid Username!</p>';
            }else if($_GET['error']=="invalidmail"){
                echo '<p>Invalid Email!</p>';
            }else if($_GET['error']=="invaliduid"){
                echo '<p>Invalid Username!</p>';
            }else if($_GET['error']=="passwordcheck"){
                echo '<p>Passwords do not match!</p>';
            }else if($_GET['error']=="userntaken"){
                echo '<p>Username is already taken!</p>';
            }
        }elseif (isset($_GET['signup'])=="success") {
            echo '<p>Signup Succesfull!</p>';
        }
        ?>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username">
            <input type="text" name="mail" placeholder="Email">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwd-repeat" placeholder="Repeat Password">
            <button type="submit" name="signup-submit">Signup</button>
        </form>
    </main>

<?php
require "footer.php";
?>