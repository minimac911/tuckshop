<?php

require 'dbh.inc.php';
//if it is before 7am
if(date("H:i:s",(time())) < date("H:i:s",strtotime("07:00:00"))
&& date("H:i:s",(time())) >= date("H:i:s",strtotime("00:00:00"))){
    $datetimeblah = date("Y-m-d H:i:s",(time()-strtotime("07:00:00")));
    $sql = "UPDATE tblorders SET expired = 1 WHERE dueDate <= '". $datetimeblah."'";
    // $sql = "UPDATE tblorders SET expired = 1 WHERE dueDate <= DATE_SUB(now(), INTERVAL 7 HOUR)";
    // $sql = "UPDATE tblorders SET expired = 1 WHERE dueDate <= #".date("Y-m-d H:i:s", strtotime("+7 hour", time()))."#;";
}else{
    $sql = "UPDATE tblorders SET expired = 1 WHERE dueDate <= now()";
}
    
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../checkout.php?errorlog=sqlerror");
    exit();
} else {
    mysqli_stmt_execute($stmt);
}