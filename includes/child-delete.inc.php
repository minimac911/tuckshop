<?php

if (isset($_POST['delete-child-submit'])) {
    session_start();
    require 'dbh.inc.php';

    //check that url is correct
    if (isset($_GET['cid'])) {
            //childs id in DB
        $childId = $_GET['cid'];

        
        //check if any values have been edited
        //if not then just redirect user to view children
        if (empty($_GET['cid'])) {
            header('Location: ../children.php?status=edit&error=noid');
            exit();
        } else {
                //checking that the child with new credentials is not already in table
            $sql = "DELETE FROM tblChildren WHERE idChild = ?;";
            $stmt = mysqli_stmt_init($conn);
            mysqli_stmt_prepare($stmt, $sql);
                //check that sql stament will work
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../children.php?status=edit&error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "i", $childId);
                mysqli_stmt_execute($stmt);
            }

            //make sure that another child is deleted to databse table 'users'
            $parentId = $_SESSION['userId'];
            $sql = "UPDATE users SET numChildren = numChildren - 1 WHERE idUsers =? ;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../add-child.php?error=sqlerror");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "i", $parentId);
                mysqli_stmt_execute($stmt);
                require 'child-session-id-add.inc.php';
            }
            header("Location: ../children.php?status=edit&delete=success");
            exit();
        }
    } else {
        header("Location: ../children.php?status=edit");
        exit();
    }
} else {
    header("Location: ../children.php?status=edit");
    exit();
}