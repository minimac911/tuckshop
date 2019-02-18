<?php
session_start();
function deleteOrdersByCid($childId){
    require 'dbh.inc.php';
    //delete any orders that have been placed for child
    $sql = "DELETE FROM tblorder_cart WHERE idOrder IN (SELECT idOrder FROM tblorders WHERE idChild = ?);";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../checkout.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $childId);
        mysqli_stmt_execute($stmt);
        
        //delete any orders that have been placed for child
        $sql = "DELETE FROM tblorders WHERE idChild = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../checkout.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $childId);
            mysqli_stmt_execute($stmt);
        }
    }
}

// delete orders via order id
function deleteOrdersByOrderId($orderId){
    require 'dbh.inc.php';
    //delete any orders that have been placed for child
    $sql = "DELETE FROM tblorder_cart WHERE idOrder = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../checkout.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $orderId);
        mysqli_stmt_execute($stmt);
        
        //delete any orders that have been placed for child
        $sql = "DELETE FROM tblorders WHERE idOrder = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../checkout.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $orderId);
            mysqli_stmt_execute($stmt);
        }
    }
}

// check if delete order button is clicked
if(isset($_POST['delete-order'])){
    //check that child id is passed through url
    if(isset($_GET['oid'])){
        //delete order
        deleteOrdersByOrderId($_SESSION['arrOrderId'][$_GET['oid']]);
        header("Location: ../checkout.php?delete=succes");
        exit();
    }else{
        header("Location: ../checkout.php?error=invalidurl");
        exit();
    }
}

echo("error");