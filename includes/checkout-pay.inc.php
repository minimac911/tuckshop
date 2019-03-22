<?php
/*
    To do:  - setup Snapscan 
            - 
*/

if (isset($_POST['check-pay'])) {
    session_start();
    
    if(isset($_POST['size'])){
        $oid = 0;
        $size = $_POST['size'];
        for($i = 0; $i < $size; $i++){
            $orderDetails = array();
            $orderDetails["id"] = $_POST['id_'.$i];
            $orderDetails["pid"] =  $_SESSION['userId'];
            $orderDetails["date"] = $_POST['date_'.$i];

            $orderDetails["subTotal"] = $_POST['subTotal_'.$i];
            $orders[$i] = $orderDetails;
        }

        require "checkout-validate.inc.php";
        // make sure that the user has not tried to change anything
        if(validCheckOut($orders)){
            $s = "Location: checkout-payment-succesful.inc.php?oid=";
            foreach ($orders as $key => $value) {
                $s .= $value['id']."-";
            }
            $s = substr($s, 0, -1);
            //what should it do?
            //generate invoice and then pay?
            //pay before generating
            //probably first option
            // $snapscanlink = "Location: https://pos.snapscan.io/qr/z4qmRal9?id=".$orderDetails["id"]."&amount=".$orderDetails["subTotal"]*100;
            // header($snapscanlink);
            // exit();

            header($s);
            exit();
        }else{
            // header("Location: ../checkout.php?status=invalidItem");
            // exit();
        }
    }else{
        header("Location: ../checkout.php?status=noitem");
        exit();
    }
} else {
    header("Location: ../checkout.php?status=noclick");
    exit();
}