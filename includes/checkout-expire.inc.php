<?php

require_once 'dbh.inc.php';

$sql = "UPDATE tblorders SET expired = 1 WHERE dueDate <= now()";
    
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../checkout.php?errorlog=sqlerror");
    exit();
} else {
    mysqli_stmt_execute($stmt);
}