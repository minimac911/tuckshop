<?php

if (isset($_POST['signup-submit'])) {

    // require 'dbh.inc.php';
    require_once "classes/classes.inc.php";
    $db = new db();

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

        // Checking if username is taken
        $sql = "SELECT * FROM users WHERE usernameUsers=?";
        if(!$db->validQuery($sql)){
            header("Location: ../login-signup.php?error=sqlerror");
            exit();
        }else{
            $resultcheck = $db->query($sql,$username)->numRows();
            if ($resultcheck > 0) {
                header("Location: ../login-signup.php?error=userntaken");
                exit();
            }else{
                // checking if email has been taken
                $sql = "SELECT * FROM users WHERE emailUsers=?";
                if(!$db->validQuery($sql)){
                    header("Location: ../login-signup.php?error=sqlerror");
                    exit();
                }else{
                    $resultcheck = $db->query($sql,$email)->numRows();
                    if ($resultcheck > 0) {
                        header("Location: ../login-signup.php?error=emailtaken");
                        exit();
                    }else{

                        $sql = "INSERT INTO users (usernameUsers, emailUsers, pwdUsers) VALUES (?, ?, ?)";
                        if(!$db->validQuery($sql)){
                            header("Location: ../login-signup.php?error=sqlerror");
                            exit();
                        }else{
                            //hash password
                            $hasedPwd = password_hash($password, PASSWORD_DEFAULT);
                            //execute query
                            $db->query($sql,$username, $email, $hasedPwd);
                        }

                        //loging in the user
                        $sql = "SELECT * FROM users WHERE usernameUsers = ?;";
                        if(!$db->validQuery($sql)){
                            header("Location: ../login-signup.php?error=sqlerror");
                            exit();
                        }else{
                            //exec query
                            $qry = $db->query($sql,$username);
                            $numrow = $qry->numRows();
                            $result = $qry->fetchArray();

                            //if there is only one row
                            if($numrow==1){
                                $pwdCheck = password_verify($password, $result['pwdUsers']);
                                if ($pwdCheck == false) {
                                    header("Location: ../login-signup.php?errorlog=wrongpassworduser");
                                    exit();
                                } elseif ($pwdCheck == true) {
                                    session_start();
                                    $_SESSION['userId'] = $result['idUser'];
                                    $_SESSION['userUid'] = $result['usernameUsers'];
                                    $_SESSION['child'] = array(); 
                                    $_SESSION['last_login_timestamp'] = time();
                                }
                            }else{
                                    header("Location: ../login-signup.php?errorlog=wrongpassworduser");
                                    exit();
                            }
                        }
                        header("Location: ../add-child.php");
                        exit();
                    }
                }
            }
        }
    }
    $db->close();
} else {
    header("Location: ../login-signup.php");
    exit();
}