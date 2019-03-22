<?php
session_start();
?>

<!DOCTYPE html>
<html lang=”en”>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="scripts/jquery.min.js"></script>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/children.css">
    <link rel="stylesheet" href="css/order.css">
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="css/invoices.css">
    <script src="scripts/login.js" type="text/javascript"> </script>    
    <script src="scripts/header.js" type="text/javascript"></script>    
    <script src="scripts/children.js" type="text/javascript"></script>    
    <script src="scripts/order.js" type="text/javascript"></script>    
    <script src="scripts/orderSearch.js" type="text/javascript"></script>    
    <script src="scripts/checkout.js" type="text/javascript"></script>    

</head>
<body>
    
<header>
    <?php

    //decalring the time zone 
    date_default_timezone_set('Africa/Windhoek');
    // date_default_timezone_set('America/New_York');

    //checking if the user is logged in
    if(isset($_SESSION['userId'])){
        //checking if the user has been idle for too long
        if((time() - $_SESSION['last_login_timestamp']) > 3600){//60min x 60sec = 3600sec
            header("Location: includes/account-logout.inc.php?error=idle");
            exit();
        }else{
            //if they reload the header and it is under the allocated time
            //set last_login_timestamp to current time
            $_SESSION['last_login_timestamp'] = time();
        }
    }
    ?>
    <div class="header-container">
        <nav class="nav-header-main">
            <!-- <a  href="#" >
                <img src="img/logo.png" class="header-logo" alt="logo">
            </a> -->
        
            <ul class="header-buttons">
                <li><a href="index.php">Home</a></li>
                <li><a href="children.php?status=order">Order</a></li>
                <li><a href="children.php">Children</a></li>
                <!-- <li><a href="#">Contact</a></li> -->
            </ul>
        </nav>
        
        <div class="header-login">
            <?php
            if (isset($_SESSION['userId'])) {
                ?>  
                <!-- <form action="includes/account-logout.inc.php" method="post">
                <button type="submit" name="logout-submit">Logout</button>
            </form> -->
            <div class="dropdown">
                <div class="nav-checkout">
                    <ul>
                        <li><a href="checkout.php" name="viewChildren">Checkout</a></li>
                    </ul>
                </div>
                <button onclick="showDrop()" id="myBtn" class="account-button dropbtn">Account</button>
                <div id="myDropdown" class="dropdown-content">
                    <form action="" method="Post">
                        <!-- <button type="submit" formaction="includes/order-prepare-form.inc.php" name="orderForm">Order Form</button> -->
                        <a href="invoices.php" name="viewChildren">Invoices</a>
                        <!-- <a href="children.php" name="viewChildren">View Children</a> -->
                        <a href="children.php" name="viewChildren">Edit Account</a>
                        <a href="includes/account-logout.inc.php" >Logout</a>
                    </form>
                </div>
            </div>
                <!-- <button class="account-button" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false">Account</button>
                <ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true">
                    <li><a href="#">This is a link</a></li>
                    <li><a href="#">This is another</a></li>
                    <li><a href="#">Yet another</a></li>
                </ul> -->
                <?php
            } else {
                ?>
                    <a href="login-signup.php" class="btn-signup">Login / Signup</a>
                <?php
            }
            ?>
        </div>
    </div>
    <hr>
</header>