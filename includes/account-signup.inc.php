<?php

if (isset($_POST['signup-submit'])) {

    require 'dbh.inc.php';

    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../login-signup.php?error=emptyfields&uid=" . $username . "&mail=" . $email);
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../login-signup.php?error=invalidmailuid");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../login-signup.php?error=invalidmail&uid=" . $username);
        exit();
    } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../login-signup.php?error=invaliduid&mail=" . $email);
        exit();
    } elseif ($password !== $passwordRepeat) {
        header("Location: ../login-signup.php?error=passwordcheck&uid=" . $username . "&mail=" . $email);
        exit();
    } else {

        $sql = "SELECT * FROM users WHERE usernameUsers=?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login-signup.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);
            if ($resultcheck > 0) {
                header("Location: ../login-signup.php?error=userntaken&mail=" . $email);
                exit();
            } else {
                $sql = "INSERT INTO users (usernameUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../login-signup.php?error=sqlerror");
                    exit();
                } else {
                    $hasedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hasedPwd);
                    mysqli_stmt_execute($stmt);

                    //loging in the user
                    $sql = "SELECT * FROM users WHERE usernameUsers = ?;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../login-signup.php?errorlog=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "s", $username);
                        mysqli_stmt_execute($stmt);
                        $results = mysqli_stmt_get_result($stmt);
                        if ($row = mysqli_fetch_assoc($results)) {
                            $pwdCheck = password_verify($password, $row['pwdUsers']);
                            if ($pwdCheck == false) {
                                header("Location: ../login-signup.php?errorlog=wrongpassworduser");
                                exit();
                            } elseif ($pwdCheck == true) {
                                session_start();
                                $_SESSION['userId'] = $row['idUsers'];
                                $_SESSION['userUid'] = $row['usernameUsers'];
                                $_SESSION['child'] = array(); 
                                $_SESSION['last_login_timestamp'] = time();
                            }
                        } else {
                            header("Location: ../login-signup.php?errorlog=wrongpassworduser");
                            exit();
                        }
                    }
                    // require("account-login.inc.php");
                    header("Location: ../add-child.php");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../login-signup.php");
    exit();
}