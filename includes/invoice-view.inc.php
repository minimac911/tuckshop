<?php

require 'dbh.inc.php';

$sql = "SELECT * FROM (((tblinvoice 
        INNER JOIN invoice_bridge ON invoice_bridge.idInvoice = tblinvoice.idInvoice)
        INNER JOIN tblorders ON tblorders.idOrder = invoice_bridge.idOrder)
        INNER JOIN tblchildren ON tblorders.idChild = tblchildren.idChild)
        WHERE tblorders.idParent = ?
        ORDER BY tblinvoice.datePaid DESC";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: children.php?errorlog=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['userId']);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
    //SECURITY CHECK (no if statment checking if there are any rows)
    // create an array
    $arrChild = array();
    while ($row = mysqli_fetch_array($results)) {
        $arrChild[] = $row;
    }      
    // echo '<pre>'; print_r($arrChild); echo '</pre>';
}