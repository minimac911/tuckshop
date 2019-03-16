<?php
require_once "header.php";
//error checking
require_once "includes/account-verify-session.inc.php";
require_once 'includes/verify-account.inc.php';
if(empty($_SESSION['child'][0]['childId'])){
    header ("Location: children.php");
    exit();
}
?>
    <main class="main-order-form">  

    <!-- order form heading and change button -->
        <div class="order-form-change">
            <h1>Order Form For: <i><?php 
                $count = 0;
                $found = false;
                $posArray = 0;
                while($count<count($_SESSION['child']) && $found != true){
                    if(isset($_GET['cid'])){
                        $childID = $_GET['cid'];

                        if(!isValidChilID($childID)){
                            header("Location: children.php?error=notchild");
                            exit();
                        }else if($_SESSION['child'][$count]['childId'] == $childID){
                            $found = true;
                            $posArray = $count;
                            echo($_SESSION['child'][$count]['childFirstName']." ".$_SESSION['child'][$count]['childLastName']);
                        }else{
                            $count++;
                        }
                    } else {
                        $found = true;
                        $posArray = 0;
                        echo($_SESSION['child'][0]['childFirstName']." ".$_SESSION['child'][0]['childLastName']);
                    }
                }
            ?></i></h1>
            <form class="order-form-change-button" action="">
                <button formaction="children.php">Change</button>
            </form>
            <hr>
        </div>

    <!-- side bar displaying order summary -->
        <div class="sidebar-main-container"> 
            <h2>Order Summary</h2>
            <form method="post" action='includes/order-add-cart.inc.php'>
            <table>
                <thead>
                    <tr class="heading-row">
                        <th class="qty">Qty</th>
                        <th class="name">Desc</th>
                        <th class="price">Price</th>
                        <td style="display:none;"><input type="hidden" class="numItemsOrderSummary" name="numItemsOrderSummary"></td>
                        <td style="display:none;"><input type="hidden" class="cid" name="cid" value=<?php if(isset($_GET['cid'])){
                            echo($_GET['cid']);
                            $childID = $_GET['cid'];
                            
                            // require_once "includes/verify-account.inc.php";
                            if(!isValidChilID($childID)){  
                                header("Location: children.php?error=nochild");
                                exit();
                            }
                        }else{
                            echo($_SESSION['child'][0]['childId']);
                            $childID = $_SESSION['child'][0]['childId'];
                        } ?>></td>
                    </tr>
                </thead>
                <tbody>
                    <!-- this is where the order summary goes -->
                </tbody>
            </table>
            <div class="order-total">
                <p>Total</p>
                <h3><input type="text" class="total" name="ttlPrice" readonly></h3>
            </div>
            
        <!-- START ORDER DATE  -->
            <div class="order-day">
                <div class="order-day-content">
                    <select id="drop-down-date" name="order-date" require_onced>
                        <option disabled selected value> -- choose a date -- </option>
                        <!-- get oreder days for specific grade -->
                        <?php 
                        $gradeOrderDay = $_SESSION['child'][$posArray]['childGrade'];
                        $orderDay = "";
                        
                        require_once "includes/order-get-days.inc.php";
                        ?>
                    </select>
                    <?php
                    // require_once "includes/order-get-days.inc.php";
                    ?>
                </div>
            </div>

            <div>
                <button type="submit" name="add-order-cart">Add Order To Cart</button>
            </div>
            </form>
        </div>

    <!-- START ORDER FORM -->    
        <div class="main-order-container">
            <div id="order-form">    
                <div class="head-order-form">
                    <h2>Menu (Gr: <?php echo($_SESSION['child'][$posArray]['childGrade']);?>)</h2>
                    <!-- search bar -->
                    <input type="text" id="myInput" onkeyup="searchItem()" placeholder="Search for Item.." title="Type in a item">
                </div>
                <?php
                require_once "includes/dbh.inc.php";
                
                $sql = "SELECT * FROM tblShopItems ";           
                switch ($_SESSION['child'][$posArray]['childGrade']) {
                    case 'RR':
                        $sql .= "WHERE isGrRRItem = 1 ";   
                        break;
                    case 'R':
                    case '1':
                    case '2':  
                        $sql .= "WHERE isGrRTo2Items = 1 ";
                        break;
                    case '3':
                    case '4':
                    case '5':
                    case '6':
                        $sql .= "WHERE isGr3AndUpItems = 1 ";
                        break;
                    default:
                        header("Location: ../children.php?error=nograde");
                        exit();
                }
                $sql .= ";";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../children.php?errorlog=sqlerror");
                    exit();
                } else {
                    mysqli_stmt_execute($stmt);
                    $results = mysqli_stmt_get_result($stmt);
                    //SECURITY CHECK (no if statment checking if there are any rows)
                    // create an array
                    $arrProduct = array();   
                    $arrCategory = array();   
                    while ($row = mysqli_fetch_array($results)) {
                        $arrProduct[] = $row; 
                        $arrCategory[] = $row['categoryItem'];
                    }      
                    $arrUniqueCat = array_unique($arrCategory);
                }
                if (!empty($arrProduct)) { 
                    $countCat = 0;
                    $uniqueCat = "";
                    ?>
                    <!-- table for order form -->
                    <form>
                        <table id="tblOrderForm">
                            <thead class="heading-item">
                                <tr>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th >Qty</th>
                                    <th style="width: 70px;">Total</th>
                                </tr>
                            </thead>
                        <?php
                        foreach($arrProduct as $key=>$value){
                            if($uniqueCat !== $arrProduct[$key]["categoryItem"]){
                                $uniqueCat = $arrProduct[$key]["categoryItem"];
                                ?>
                                <thead class="tableHead thItem">
                                    <tr>
                                        <th colspan="5"><h2><b><?php echo $uniqueCat?></b></h2></th>
                                    </tr>
                                </thead>
                                <tbody class="tableBody">
                                <?php
                            }else{
                                $countCat++;
                                // echo($countCat);
                            }
                    ?>
                        <tr class="product-item">
                            <td class="product-id" style="display:none;"><?php echo $arrProduct[$key]["idItem"];?></td>
                            <td class="product-title">
                                <?php echo $arrProduct[$key]["nameItem"]; ?>
                                <!-- add category for easy searching -->
                                <span style="display: none;"> (<?php echo $arrProduct[$key]["categoryItem"]; ?>)</span>
                            </td>
                            <td class="product-price">R <span><?php echo $arrProduct[$key]["priceItem"]; ?></span></td>
                            <td class="qty-action">
                                <button type="button" id="sub" class="sub">-</button>
                                <p class="product-quantity" id="count">0</p>
                                <button type="button" id="add" class="add">+</button>
                            </td>
                            <td class="total-product-price"><span></span></td>
                        </tr>
                    <?php
                        }   
                        ?>
                        <tfoot>
                            <tr>
                                <th class="no-results" colspan="4" style="display: none"><h1><i>No Results</i></h1></th>
                            </tr>
                        </tfoot>
                        </table>
                    </form>
                    <?php
                }
                ?>
            </div><!--End of order form-->
        </div><!--End of main container-->

    </main>

<?php
    echo($gradeOrderDay);
    echo '<pre>'; print_r($listDays); echo '</pre>';
require_once "footer.php";
?>