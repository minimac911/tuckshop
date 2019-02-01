<?php

if (isset($_POST['add-order-cart'])) {
    session_start();
    require 'dbh.inc.php';

    //storing the information that the user enter
    $numItems = $_POST['numItemsOrderSummary'];
    if(empty($numItems)){
        header("Location: ../order-form.php?cid=".$_POST['cid']);
        exit();
    }else{
        echo($numItems);
        $items = array();
        $ttlPrice = $_POST['ttlPrice'];
        $ttlPrice = ltrim($ttlPrice, 'R ');
        $cid = $_POST['cid'];
        echo($ttlPrice);
        for($i = 0; $i < $numItems; $i++){
            $itemDetails = array();
            $itemDetails["id"] = $_POST['id_'.$i];
            // echo($_POST['qty_'.$i]);
            $itemDetails["qty"] = $_POST['qty_'.$i];
            // // echo($_POST['name_'.$i]);
            // $itemDetails["name"] = $_POST['name_'.$i];
            // echo($_POST['price_'.$i]);
            $itemDetails["price"] = $_POST['price_'.$i];
            $items[$i] = $itemDetails;
        }
        //checking that parent doesnt have 2 children
        $parentId = $_SESSION['userId'];
        $date = "";


        //create a new order id 
        $sql = "INSERT INTO `tblorders`(`dateOrdered`, `dueDate`, `idChild`, `idParent`, `totalPrice`) VALUES (STR_TO_DATE('$date', '%m/%d/%Y'), STR_TO_DATE('$date', '%m/%d/%Y'), ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo("error");
            header("Location: ../order-form.php?error=sqlerror2&cid=".$_POST['cid']);
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "iii", $_POST['cid'], $parentId, $ttlPrice);            
            mysqli_stmt_execute($stmt);


            //get orderid
            $sql = "SELECT `idOrder` FROM `tblorders` WHERE `idChild` = ? AND `idParent` = ? ORDER BY idOrder DESC";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo("error");
                header("Location: ../order-form.php?error=sqlerror2&cid=".$_POST['cid']);
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ii", $_POST['cid'], $parentId);            
                mysqli_stmt_execute($stmt);

                $results = mysqli_stmt_get_result($stmt);
                //SECURITY CHECK (no if statment checking if there are any rows)
                // create an array
                $row = mysqli_fetch_row($results);
                $orderId = $row[0];   
           
                
                //put items from cart into cart table with new order id
                $sql = "INSERT INTO `tblorder_cart`(`idOrder`, `idItem`, `quantity`, `price`) VALUES ($orderId,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../order-form.php?error=sqlerror1&cid=".$_POST['cid']);
                    exit();
                } else {
                    foreach($items as $key=>$value){
                        mysqli_stmt_bind_param($stmt, "iii", $items[$key]["id"], $items[$key]["qty"],  $items[$key]["price"]);            
                        mysqli_stmt_execute($stmt);
                    }
                    header("Location: ../add-child.php?add=success");
                    exit();
                }
            }
        }
    }
} else {
    header("Location: ../add-child.php");
    exit();
}