<?php

if (isset($_POST['login-submit'])) {

    // require 'dbh.inc.php';
    require_once "classes/classes.inc.php";
    $db = new db();

    $mailuid = $_POST['uid'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)) {
        header("Location: ../login-signup.php?errorlog=emptyfields");
        exit();
    } else {
        //see if a user has that username or email
        $sql = "SELECT * FROM users WHERE usernameUsers = ? OR emailUsers = ?;";
        $results = $db->query($sql,$mailuid,$mailuid)->fetchArray();
        //check password
        $pwdCheck = password_verify($password, $results['pwdUsers']);
        //if password is wrong
        if ($pwdCheck == false) {
            header("Location: ../login-signup.php?errorlog=wrongpassworduser");
            exit();
        } elseif ($pwdCheck == true) {
            session_start();
            $_SESSION['userId'] = $results['idUser'];
            $_SESSION['userUid'] = $results['usernameUsers'];
            $_SESSION['child'] = array(); 

            //used to store when user has logged in
            //so that they can be logged out after being inactive for an hour
            $_SESSION['last_login_timestamp'] = time();

            if($results['numChildren']<=0){
                header("Location: ../add-child.php?error=nochild");
                exit();
            }elseif($results['numChildren']>0){
                require 'session-add.inc.php';
            }
            //close connection to database
            $db->close();

            header("Location: ../index.php?login=success");
            exit();
        }
    }
} else {
    header("Location: ../login-signup.php");
    exit();
}