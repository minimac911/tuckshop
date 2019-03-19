<?php
require "header.php";
?>

    <main>
    <div class="form-grid">

        <?php
        $selector = $_GET['selector'];
        $validator = $_GET['validator'];

        if (empty($selector) || empty($validator)) {
            echo "Could not validate your request";
        } else {
            if (ctype_xdigit($selector) == true && ctype_xdigit($validator) == true) {
                ?>
                <div class="form">
                    <form action="includes/account-reset-password.inc.php" method="post" autocomplete="off">
                        <input type="hidden" name="selector" value="<?php echo $selector;?>"> 
                        <input type="hidden" name="validator" value="<?php echo $validator;?>"> 
                        <input class="password" type="password" name="pwd" placeholder="Enter a New Password" required>
                        <input class="repeat-password" type="password" name="pwd-repeat" placeholder="Repeat new Password" required >
                        <button type="submit" name="reset-password-submit">Reset password</button>
                    </form>
                </div>
                <?php
            }
        }
        ?>

        <h1 class="form-heading">Reset Your Password</h1> 
        
    </div>
    </main>

<?php
require "footer.php";
?>