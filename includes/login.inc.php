<?php

if (isset($_POST['login-submit'])) {

    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)) {
        header("Location: ../login-signup.php?errorlog=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE usernameUsers = ? OR emailUsers = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login-signup.php?errorlog=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($results)) {
                $pwdCheck = password_verify($password, $row['pwdUsers']);
                if ($pwdCheck == false) {
                    header("Location: ../login-signup.php?errorlog=wrongpassworduser");
                    exit();
                }elseif ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['idUsers'];
                    $_SESSION['userUid'] = $row['usernameUsers'];

                    header("Location: ../index.php?login=success");
                    exit();
                }
            } else {
                header("Location: ../login-signup.php?errorlog=wrongpassworduser");
                exit();
            }
        }
    }

} else {
    header("Location: ../login-signup.php");
    exit();
}