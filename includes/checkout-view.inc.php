<?php

require 'dbh.inc.php';
require 'checkout-expire.inc.php';
//geting the orders information from tblorders
//getting the items info from tblshopitems
//geting items in order from tblorder_cart
$sql = "SELECT tblorders.idOrder, tblorder_cart.idItem, tblshopitems.nameItem, tblorder_cart.quantity, 
    tblshopitems.category, tblorder_cart.price, tblorders.totalPrice,
    tblorders.dueDate, tblorders.idChild, tblorders.idParent, tblorders.dueDate 
    FROM ( ( tblorder_cart INNER JOIN tblorders ON tblorder_cart.idOrder = tblorders.idOrder ) 
    INNER JOIN tblshopitems ON tblorder_cart.idItem = tblshopitems.idItem )
    WHERE tblorders.idParent = ? AND tblorders.paid = 0 AND tblorders.expired = 0 
    ORDER BY tblorders.dueDate";
    
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: index.php?errorlog=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['userId']);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);

    //SECURITY CHECK (no if statment checking if there are any rows)
    $arrOrders = array();

    while ($row = mysqli_fetch_array($results)) {
        $orderId = $row['idOrder'];
        $childId = $row['idChild'];
        $arrOrders[$orderId]['idChild'] = $row['idChild'];
        $arrOrders[$orderId][] = $row;
        $orderDueDate[$orderId] = $row['dueDate'];
    }
    // echo '<pre>'; print_r($orders); echo '</pre>';
}