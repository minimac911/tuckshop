<?php

if(!isset($_SESSION['userId'])){
    header ("Location: login-signup.php");
    exit();
}
