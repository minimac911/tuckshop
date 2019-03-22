<?php

// require 'dbh.inc.php';
require_once "classes/classes.inc.php";
$db = new db();

//if it is before 7am
if(date("H:i:s",(time())) < date("H:i:s",strtotime("07:00:00"))
&& date("H:i:s",(time())) >= date("H:i:s",strtotime("00:00:00"))){
    $datetimeblah = date("Y-m-d H:i:s",(time()-strtotime("07:00:00")));
    //update time if it is past 7 
    $sql = "UPDATE tblorders SET expired = 1 WHERE dueDate <= '". $datetimeblah."'";
}else{
    $sql = "UPDATE tblorders SET expired = 1 WHERE dueDate <= now()";
}

if (!$db->validQuery($sql)) {
    header("Location: ../checkout.php?errorlog=sqlerror");
    exit();
} else {
    //execute query 
    $db->query($sql);
    //close connection
    $db->close();
}