<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
    <script src="scripts/login.js"></script>    
</head>
<body>
    
<header>

    <div class="header-container">
        <nav class="nav-header-main">
            <a  href="#" >
                <img src="img/logo.png" class="header-logo" alt="logo">
            </a>
        
            <ul class="">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Portfolio</a></li>
                <li><a href="#">About Me</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
        <div class="header-login">
            <?php
            if (isset($_SESSION['userId'])) {
                echo '<form action="includes/logout.inc.php" method="post">
                        <button type="submit" name="logout-submit">Logout</button>
                    </form>';
            } else {
                echo '<a href="login-signup.php" class="btn-signup">Login / Signup</a>';
            }
            ?>
            
            
        </div>
    </div>

</header>