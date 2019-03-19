<?php
require "header.php";
require "includes/account-verify-session.inc.php";
require "includes/checkout-view.inc.php";


unset($_SESSION['checkoutARR']);    
// foreach ($arrOrders as $key => $value) {
//     setcookie('arrOrder['.$key.']', '', time()-3600);
//     setcookie('arrOrder['.$key.']', '', time()+3600);
// }

?>

    <main>
        <div class="main-view-order-container">
            <h1>
                Checkout
            </h1>
            <!-- Show order sumary with -->
            <div class="view-order-pay-container">
                <form action="includes/checkout-pay.inc.php" method="POST">
                    <div class="view-order-pay-info">
                        <h2>SUMMARY CHECKOUT</h2>
                        <table >
                            <thead>
                                <th>Child</th>
                                <th>collection date</th>
                                <th>order total</th>
                            </thead>
                            <tbody id="table-summary">

                            </tbody>
                        </table>
                        <p>Checkout Total: <span id="checkout-total"></span></p>
                        <div class="checkout-button">
                            <button type="submit" name="check-pay">Checkout now</button>
                        </div>
                    </div>
                </form>
            </div> 
            <!-- show orders that are in cart -->
            <div class="grid-container">
                <?php
                if (count($arrOrders) == 0) {
                    echo ("<h2>You have no orders in checkout area!</h2>");
                } else {
                    // loop through each childs order

                    // delete datat in order Id
                    unset($_SESSION['arrOrderId']);
                    $count=-1; // create count for using arrOrderId

                    //loop through the orders in cart
                    foreach ($arrOrders as $orderId => $order) {
                            
                        // add order ids to session
                        $_SESSION['arrOrderId'][] = $orderId;

                        // $items = $order;
                        ?>
                        <div class="view-order-info-container">
                            <form action="" id="form<?php echo($count);?>" method="post">

                                <div>
                                    <h3>
                                        <!-- Order number: <?php echo($orderId); ?> -->
                                    </h3>
                                </div>
                                <div class="order-details">
                                    <h3>
                                        FOR: 
                                        <?php
                                        //get childs information
                                            foreach ($_SESSION["child"] as $key => $childValue) {
                                                if($childValue['childId']==$order['idChild']){
                                                    $childName = $childValue["childFirstName"]." ".$childValue["childLastName"];
                                                    echo("<span style='float: right;'>".$childValue["childFirstName"]." ".$childValue["childLastName"]."</span>");
                                                }
                                            }
                                        ?>
                                    </h3>
                                    <h3>
                                        COLLECTION DATE: <?php 
                                            $date = date("l, d-M-Y", strtotime($orderDueDate[$orderId]));
                                            echo("<span style='float: right;'>".date("l, d-M-Y", strtotime($orderDueDate[$orderId]))."</span>"); 
                                            ?>
                                    </h3>
                                </div>

                                <!-- displaying ordered items -->
                                <div class="disp-items">   

                                    <table class="item-details">
                                        <?php
                                        //loop through each item in the childs order
                                        foreach ($order as $key => $value) {
                                            if(is_array($value)){
                                                ?>
                                                <!-- item info -->
                                                    <tr class="view-order-item-details">
                                                    <?php
                                                    if($value["quantity"]<=1){
                                                    ?>
                                                        <td class="qty"><?php echo($value["quantity"]."x");?></td>
                                                        <td class="name"><?php echo($value["nameItem"]." (".$value["categoryItem"].")");?></td>
                                                        <td class="price" style="text-align: right;"><?php echo("R ".number_format((float)$value["price"], 2, '.', ''));?></td>
                                                    <?php
                                                    }else{
                                                        ?>
                                                        <td class="qty"><?php echo($value["quantity"]."x");?></td>
                                                        <td class="name"><?php echo($value["nameItem"]." (".$value["categoryItem"].")");?></td>
                                                        <td class="price" style="text-align: right;"><span style="font-size: 13px;">(<?php echo("R ".number_format((float)($value["price"]/$value["quantity"]), 2, '.', '')); ?>)</span><?php echo("R ".number_format((float)$value["price"], 2, '.', ''));?></td>
                                                        <?php
                                                    }
                                                    ?>
                                                        </tr>
                                                </div>  
                                                <?php
                                            }

                                        }
                                        ?>
                                        <tfoot>
                                            <tr class="view-order-total" style="text-align: right;">
                                                <td colspan="3" class="qty"><h4>Total: R <?php 
                                                $total = number_format((float)$value["totalPrice"], 2, '.', '');
                                                echo(number_format((float)$value["totalPrice"], 2, '.', ''));
                                                ?></h4></td>
                                            </tr>
                                        </tfoot>
                                    </table>

                                    <div class="checkout-button">
                                        <?php $count++; ?>
                                        <!-- confirm if the user wants to delete the order -->
                                        <button type="button" class="delete-button"
                                        onclick="Confirm('Delete Order', 'Are you sure you want to delete this order', 'Yes', 'Cancel', 'delete-order', 'includes/order-delete.inc.php?oid=<?php echo($count); ?>');">
                                            REMOVE
                                        </button>
                                        <button class="btn-add-checkout" name="add-checkout" type="button"
                                        onclick="addToCheckOut('<?php echo $orderId;?>','<?php echo $childName;?>','<?php echo $date;?>','<?php echo $total;?>','form<?php echo $count-1;?>')">
                                            Add to Checkout
                                        </button>
                                    </div>
                                </div> <!-- END DISPLAY ITEMS -->
                            </div>
                        </form>
                        <?php
                    }
                }
                ?>
                
            </div>
                
        </div>
    </main>
    
<?php
        // echo '<pre>' . print_r($arrOrders, TRUE) . '</pre>';
require "footer.php";
?>