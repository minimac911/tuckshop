<?php

if (isset($_POST['add-child-submit'])) {
    session_start();
    require 'dbh.inc.php';

    //storing the information that the user enter
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $grade = $_POST['grade'];
    $class = $_POST['class'];

    if (empty($firstName) || empty($lastName) || empty($grade) || empty($class)) {
        header("Location: ../add-child.php?error=emptyfields&fn=" . $firstName . "&ln=" . $lastName."&g=".$grade."&c=".$class);
        exit();
    } else {
        //checking that parent doesnt have 2 children
        $sql = "SELECT * FROM tblChildren WHERE firstNameChild=? AND lastNameChild =? AND gradeChild = ? AND classChild = ?;";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../add-child.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $grade, $class);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);
            if ($resultcheck > 0) {
                header("Location: ../add-child.php?error=childadded");
                exit();
            } else {
                $parentId = $_SESSION['userId'];
                $sql = "INSERT INTO tblChildren (firstNameChild, lastNameChild, gradeChild, classChild, idUser) VALUES (?, ?, ?, ?, '$parentId');";
                $stmt = mysqli_stmt_init($conn);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../add-child.php?error=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $grade, $class);            
                    mysqli_stmt_execute($stmt);

                    //make sure that another child is added to databse table 'users'
                    $sql = "UPDATE users SET numChildren = numChildren+1 WHERE idUser = ? ;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../add-child.php?error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "i", $parentId);
                        var_dump($parentId);
                        mysqli_stmt_execute($stmt);
                        require 'session-add.inc.php';
                    }
                    header("Location: ../add-child.php?add=success");
                    exit();
                }
            }
        }
    }

} else {
    header("Location: ../add-child.php");
    exit();
}