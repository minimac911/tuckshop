<?php

if (isset($_POST['order-form-submit']) || isset($_POST['orderForm'])) {
    session_start();
    require 'dbh.inc.php';
    if(empty($_SESSION['child'][0]['childId'])){
        header("Location: ../children.php");
        exit();
    }else{
        if(isset($_GET['cid'])){
            header("Location: ../order-form.php?cid=".$_GET['cid']);
            exit();
        }else{
            $childId = $_SESSION['child'][0]['childId'];
            if(isset($_GET['cid'])){
                $childId = $_GET['cid'];
            }
            echo($childId);
        }
    }

    // //storing the information that the user enter
    // $firstName = $_POST['firstName'];
    // $lastName = $_POST['lastName'];
    // $grade = $_POST['grade'];
    // $class = $_POST['class'];

    // if (empty($firstName) || empty($lastName) || empty($grade) || empty($class)) {
    //     header("Location: ../add-child.php?error=emptyfields&fn=" . $firstName . "&ln=" . $lastName."&g=".$grade."&c=".$class);
    //     exit();
    // } else {
    //     //checking that parent doesnt have 2 children
    //     $sql = "SELECT * FROM tblChildren WHERE firstNameChild=? AND lastNameChild =? AND gradeChild = ? AND classChild = ?;";
    //     $stmt = mysqli_stmt_init($conn);
    //     mysqli_stmt_prepare($stmt, $sql);
    //     if (!mysqli_stmt_prepare($stmt, $sql)) {
    //         header("Location: ../add-child.php?error=sqlerror");
    //         exit();
    //     } else {
    //         mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $grade, $class);
    //         mysqli_stmt_execute($stmt);
    //         mysqli_stmt_store_result($stmt);
    //         $resultcheck = mysqli_stmt_num_rows($stmt);
    //         if ($resultcheck > 0) {
    //             header("Location: ../add-child.php?error=childadded");
    //             exit();
    //         } else {
    //             $parentId = $_SESSION['userId'];
    //             $sql = "INSERT INTO tblChildren (firstNameChild, lastNameChild, gradeChild, classChild, idUsers) VALUES (?, ?, ?, ?, '$parentId');";
    //             $stmt = mysqli_stmt_init($conn);

    //             if (!mysqli_stmt_prepare($stmt, $sql)) {
    //                 header("Location: ../add-child.php?error=sqlerror");
    //                 exit();
    //             } else {
    //                 mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $grade, $class);            
    //                 mysqli_stmt_execute($stmt);

    //                 //make sure that another child is added to databse table 'users'
    //                 $sql = "UPDATE users SET numChildren = numChildren + 1 WHERE idUsers =? ;";
    //                 $stmt = mysqli_stmt_init($conn);
    //                 if (!mysqli_stmt_prepare($stmt, $sql)) {
    //                     header("Location: ../add-child.php?error=sqlerror");
    //                     exit();
    //                 } else {
    //                     mysqli_stmt_bind_param($stmt, "i", $parentId);
    //                     mysqli_stmt_execute($stmt);
    //                     require 'child-session-id-add.inc.php';
    //                 }
    //                 header("Location: ../add-child.php?add=success");
    //                 exit();
    //             }
    //         }
    //     }
    // }
    echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
    echo(time()+3600);
    // echo(strpos($_SERVER['REQUEST_URI'], "children.php"));
} else {
    header("Location: ../children.php");
    exit();
}