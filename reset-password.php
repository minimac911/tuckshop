<?php
require "header.php";
?>

    <main>
    <div class="form-grid">
        <h1 class="form-heading">Reset Your Password</h1>
        <div class="form">
            <?php
            $username = "";
            $email = "";
            if (isset($_GET['reset']) == "success") {
                ?>
                <p class="reset-success">
                    Your reset link has been sent to your Email!
                </p>
                <?php
            } else {
                ?>
                <p class="reset-instructions">
                    An email will be sent to you with further instructions on reseting your password!
                </p>
                <form action="includes/reset-request.inc.php" method="post" autocomplete="off">
                    <input class="email" type="text" name="mail" placeholder="Enter your email address..." required> 
                    <button type="submit" name="reset-request-submit">Reset password!</button>
                </form>
                <?php

            }
            ?>  
            
        </div>
    </div>
    </main>

<?php
require "footer.php";
?>