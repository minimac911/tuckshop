<?php

if (isset($_POST['update-child-submit'])) {
    session_start();
    require 'dbh.inc.php';

    //check that url is correct
    if (isset($_GET['cid']) && isset($_GET['fn']) && isset($_GET['ln'])
        && isset($_GET['gr']) && isset($_GET['cl'])) {
            //childs id in DB
        $childId = $_GET['cid'];
        
        require 'verify-account.inc.php';
        if(isValidChilID($childId)){
            //orginal values for the child before edit
            $orgFirstName = $_GET['fn'];
            $orgLastName = $_GET['ln'];
            $orgGrade = $_GET['gr'];
            $orgClass = $_GET['cl'];

            //Values from form on edit-child.php
            $newFirstName = $_POST['firstName'];
            $newLastName = $_POST['lastName'];
            $newGrade = $_POST['grade'];
            $newClass = $_POST['class'];

            //check that fields in form are not empty
            if (empty($newFirstName) || empty($newLastName) || empty($newGrade) || empty($newClass)) {
                header("../children.php?status=edit&error=emptyfields");
                exit();
            } else {
                //check if any values have been edited
                //if not then just redirect user to view children
                if ($orgFirstName == $newFirstName && $orgLastName == $newLastName
                    && $orgGrade == $newGrade && $orgClass == $newClass) {
                    header('Location: ../children.php?status=edit&error=nochange');
                    exit();
                } else {
                    //checking that the child with new credentials is not already in table
                    $sql = "SELECT * FROM tblChildren WHERE firstNameChild=? AND lastNameChild =? AND gradeChild = ? AND classChild = ?;";
                    $stmt = mysqli_stmt_init($conn);
                    mysqli_stmt_prepare($stmt, $sql);
                    //check that sql stament will work
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../children.php?status=edit&error=sqlerror");
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "ssss", $newFirstName, $newLastName, $newGrade, $newClass);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        $resultcheck = mysqli_stmt_num_rows($stmt);

                        //check that there are no children already added
                        if ($resultcheck > 0) {
                            header("Location: ../children.php?status=edit&error=childadded");
                            exit();
                        } else {
                            $parentId = $_SESSION['userId'];
                            $sql = "UPDATE tblChildren SET firstNameChild = ?, lastNameChild = ?, gradeChild = ?, classChild = ? WHERE idChild = ?";
                            $stmt = mysqli_stmt_init($conn);

                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                header("Location: ../children.php?status=edit&error=sqlerror");
                                exit();
                            }else {
                                //execute sql statment for updating childs infomration
                                mysqli_stmt_bind_param($stmt, "ssssi", $newFirstName, $newLastName, $newGrade, $newClass, $childId);            
                                mysqli_stmt_execute($stmt);
                                require 'session-add.inc.php';
                            }
                            header("Location: ../children.php?status=edit&success=updated");
                            exit();
                        }
                    }
                }
            }
        }else{
            header("Location: ../children.php?error=nochild");
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