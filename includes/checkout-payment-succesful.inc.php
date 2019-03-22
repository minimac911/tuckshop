<?php
// TODO: Make it use the invoice_bridge

if(isset($_GET['oid'])){
    session_start();
    // require 'dbh.inc.php';
    //get classes needed
    require_once "classes/classes.inc.php";
    //create new instance of database
    $db = new db();

    $s = $_GET['oid'];
    $a = "";

    $arrOID = explode("-",$s);

    //create new invoice
    $sql = "INSERT INTO tblinvoice (idUser, datePaid) VALUES (?, now());";
    if (!$db->validQuery($sql)) {
        header("Location: ../checkout.php?errorlog=sqlerror");
        exit();
    } else {
        $db->query($sql, $_SESSION['userId']);
    }

    //get the invoice id for the new invoice
    $sql = "SELECT idInvoice FROM tblinvoice WHERE idUser = ? ORDER BY datePaid DESC;";
    if (!$db->validQuery($sql)) {
        header("Location: ../checkout.php?errorlog=sqlerror");
        exit();
    } else {
        //get results from query
        $results = $db->query($sql, $_SESSION['userId'])->fetchAll();
        //the invoice id from the new invoice
        $inoviceID = $results[0]['idInvoice'];
    }

    // put the orders into the invoice bridge
    $sql = "INSERT INTO invoice_bridge (idInvoice, idOrder) VALUES";

    $params = array();
    //loop through all orders so that the can all be inserted
    foreach ($arrOID as $k => $oid) {
        $sql .= "( ?, ?),";
        $params[] = $inoviceID;
        $params[] = $oid;
    }
    //remove the extra comma at the end of sql
    $sql = substr($sql, 0, -1);

    if(!$db->validQuery($sql)){
        header("Location: ../checkout.php?errorlog=sqlerror");
        exit();
    }else{
        //exec query with parmeters
        $db->query($sql,$params);
    }

    // Update tblOrders to show that it was paid
    $sql = "UPDATE tblorders SET paid = 1 WHERE ";
    //reset array for params
    $params = null;
    //loop through all orders
    foreach ($arrOID as $k => $v) {
        $sql .= "idOrder = ? OR ";
        $params[] = $v;
    } 
    //remove the extra 'OR ' from sql
    $sql = substr($sql, 0, -3);

    if(!$db->validQuery($sql)){
        header("Location: ../checkout.php?errorlog=sqlerror");
        exit();
    }else{
        //exec query with parmeters
        $db->query($sql,$params);
        //close the connection to the database
        $db->close();

        header("Location: ../invoices.php?paid=success");
        exit();
    }
    //close the connection to the database
    $db->close();

    header("Location: ../invoices.php");
    exit();
}else{
    header("Location: ../checkout.php");
    exit();
}

