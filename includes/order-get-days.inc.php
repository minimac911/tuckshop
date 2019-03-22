<?php

require 'dbh.inc.php';
//date("Y-m-d H:i:s",strtotime(
$sql = "SELECT class, day FROM tblorder_days WHERE grade = ?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../order-form.php?errorlog=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $gradeOrderDay);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
    
    //fucntion to sort the days in order of which day is soonest
    function compareByTimeStamp($time1, $time2) 
    { 
        if (strtotime($time1) > strtotime($time2) )
            return 1; 
        else if (strtotime($time1) < strtotime($time2))  
            return -1; 
        else
            return 0; 
    } 

    $row = mysqli_fetch_array($results);
    $orderDay = $row["day"];
    // creating amount of listDays depending on grades tuck day
    if($row["class"]!=null){
        $listDays[] = "next ".$orderDay;        
    }else{
        if($orderDay!="any"){
            $listDays[] = "next ".$orderDay;
        }else{
            $listDays[] = "next monday";
            $listDays[] = "next tuesday";
            $listDays[] = "next wednesday";
            $listDays[] = "next thursday";
            $listDays[] = "next friday";
            usort($listDays, "compareByTimeStamp"); 
        }
        // $listDays = null;
        //if it is before 7am
        if(date("H:i:s",(time())) < date("H:i:s",strtotime("07:00:00"))
            && date("H:i:s",(time())) > date("H:i:s",strtotime("00:00:00"))){
            // $listDays = null;
            // array_pop($listDays);
            array_splice($listDays,0,0,"today");
            // $listDays[] = "now";
        }
    }

    $sql = "SELECT dueDate FROM tblorders WHERE idChild = ? AND (dueDate BETWEEN '".
        date("Y-m-d H:i:s",strtotime(reset($listDays)))."' AND '".date("Y-m-d H:i:s",strtotime(end($listDays)))."');";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../order-form.php?errorlog=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "s", $childID);
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);

        $dDate = array();
        // put days ordered in array
        while ($row = mysqli_fetch_array($results)) {
            $dDate[] = $row['dueDate'];
        }

        foreach ($listDays as $key => $value) {
            //add 7 hours
            $value = $value." +7 hour";
            // print_r($value);
            if(in_array(date("Y-m-d H:i:s",strtotime($value)), $dDate)){
                echo("<option value='".date("Y-m-d H:i:s",strtotime($value))."' disabled>".date("l, d-M-Y", strtotime($value))."</option>");            
            }else{
                echo("<option value='".date("Y-m-d H:i:s", strtotime($value))."'>".date("l, d-M-Y", strtotime($value))."</option>");            
            }
        }
    }

   
}