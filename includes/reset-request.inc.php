<?php

if (isset($_POST['reset-request-submit'])) {

    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);

    //need to change url when hosting
    $url = "www.websitename.co.za/forgottenpwd/create-new-password.php?selector=" . $selector . "&validator=" . bin2hex($token);

    //1800 is 1 hour in seconds from when token is created
    //maybe change to 30 min
    $expires = date("U") + 1800;

    require 'dbh.inc.php';

    $userEmail = $_POST["email"];

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?;";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $userEmail);
        mysqli_stmt_execute($stmt);
    }

    $sql = "INSERT INTO pwdReset (pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "There was an error!";
        exit();
    } else {
        $hasedToken = password_hash($token, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $userEmail, $selector, $hasedToken, $expires);
        mysqli_stmt_execute($stmt);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    //wehre the email is being sent to
    $to = $userEmail;
    //the email
    $subject = 'Reset your password';

    $message = '<P>We receied a password reset request. The link to reset your password is below. If you did not make this request ignore this email!</p>';
    $message .= '<P>Here is your password reset link: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';
    //change this to website name and email (no-reply)
    $headers = "From: pre-order tuckshop <no-reply@website-name.co.za>\r\n";
    $headers .= "Reply-To: <replyemail@website-name.co.za>\r\n";
    $headers .= "Content-type: text/html\r\n";

    mail($to, $subject, $message, $headers);

    header("Location: ../reset-password.php?reset=success");

} else {
    header("Location: ../index.php");
}