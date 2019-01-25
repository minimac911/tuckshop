<?php


if (isset($_POST['reset-request-submit'])) {
    
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    //need to change url when hosting
    $url = "www.websitename.co.za/forgottenpwd/create-new-password.php?selector=".$selector."&validator=".bin2hex($token);

    //1800 is 1 hour in seconds from when token is created
    //maybe change to 30 min
    $expires = date("U")+1800;

} else {
    header("Location: ../index.php");
}