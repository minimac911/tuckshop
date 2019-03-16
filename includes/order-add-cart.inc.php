<?php

if (isset($_POST['add-order-cart'])) {
    session_start();
    require_once 'dbh.inc.php';

    //storing the information that the user enter
    $numItems = $_POST['numItemsOrderSummary'];
    $cid = $_POST['cid'];
    if(empty($numItems)){
        header("Location: ../order-form.php?cid=".$cid);
        exit();
    }else{

        $parentId = $_SESSION['userId'];
        $orderDate = $_POST['order-date'];
        $ttlPrice = $_POST['ttlPrice'];
        $ttlPrice = ltrim($ttlPrice, 'R ');
        $items = array();

        $ttlPrice = 0;
        require_once "order-placed.inc.php";
        //check that there isnt already an order placed for that day by the child
        if(dayFree($cid,$orderDate)){
            for($i = 0; $i < $numItems; $i++){
                $itemDetails = array();
                $itemDetails["id"] = $_POST['id_'.$i];
                $itemDetails["qty"] = $_POST['qty_'.$i];
                $itemDetails["price"] = $_POST['price_'.$i];
                $ttlPrice += $itemDetails["price"]; 
                $items[$i] = $itemDetails;
            }

            require_once "order-validate.inc.php";
            echo validOrderAddCart($items);
            // checking if the details of the order is valid
            if(validOrderAddCart($items)){
                //create a new order id 
                $sql = "INSERT INTO `tblorders`(`dateOrdered`, `dueDate`, `idChild`, `idParent`, `totalPrice`) VALUES (now(), '$orderDate', ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo("error");
                    header("Location: ../order-form.php?error=sqlerror2&cid=".$cid);
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "iii", $cid, $parentId, $ttlPrice);            
                    mysqli_stmt_execute($stmt);
    
    
                    //get orderid
                    $sql = "SELECT `idOrder` FROM `tblorders` WHERE `idChild` = ? AND `idParent` = ? ORDER BY idOrder DESC";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo("error");
                        header("Location: ../order-form.php?error=sqlerror2&cid=".$cid);
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "ii", $cid, $parentId);            
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
                            header("Location: ../order-form.php?error=sqlerror1&cid=".$cid);
                            exit();
                        } else {
                            foreach($items as $key=>$value){
                                mysqli_stmt_bind_param($stmt, "iii", $items[$key]["id"], $items[$key]["qty"],  $items[$key]["price"]);            
                                mysqli_stmt_execute($stmt);
                            }
                            require_once 'session-add.inc.php';
                            header("Location: ../checkout.php?add=success");
                            exit();
                        }
                    }
                }
            }else{
                header("Location: ../order-form.php?error=invlaidItems");
                exit();
            }
        }else{
            header("Location: ../order-form.php?error=alreadyorder");
            exit();
        }
    }
} else {
    header("Location: ../children.php");
    exit();
}