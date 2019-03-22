<?php

//function to get boolean if order has already been placed for that day by the child
function dayFree($childId, $date){
    require 'dbh.inc.php';

    //sql statment
    $sql = "SELECT dueDate from tblorders where idChild = ?";
        
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../order-form.php?error=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $childId);
        mysqli_stmt_execute($stmt);
        $results = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_array($results)) {
            // echo('<p>');
            // echo($row['dueDate']);
            // echo(" == ");
            // echo(date("Y-m-d H:i:s", strtotime($date)));
            // echo("</p>\n");

            if($row['dueDate'] == date("Y-m-d H:i:s", strtotime($date))){
                return false;
            }
        }
        return true;
    }
}