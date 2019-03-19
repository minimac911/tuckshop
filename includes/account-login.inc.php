<?php

if (isset($_POST['login-submit'])) {

    require 'dbh.inc.php';

    $mailuid = $_POST['uid'];
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
                } elseif ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['idUser'];
                    $_SESSION['userUid'] = $row['usernameUsers'];
                    $_SESSION['child'] = array();  

                    //used to store when user has logged in
                    //so that they can be logged out after being inactive for an hour
                    $_SESSION['last_login_timestamp'] = time();

                    //check if user has added any children
                    $sql = "SELECT * FROM users WHERE idUser = ?;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../login-signup.php?errorlog=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
                        mysqli_stmt_execute($stmt);
                        $results = mysqli_stmt_get_result($stmt);
                        if ($row = mysqli_fetch_assoc($results)) {
                            if ($row['numChildren'] == 0) {
                                header("Location: ../add-child.php?error=nochild");
                                exit();
                            } else {
                                require 'session-add.inc.php';
                            }
                        }
                    }
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