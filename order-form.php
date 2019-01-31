<?php
require "header.php";
//error checking
require "includes/account-verify-session.inc.php";
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
                while($count<sizeof($_SESSION['child']) && $found != true){
                    if(isset($_GET['cid'])){
                        if($_SESSION['child'][$count]['childId'] == $_GET['cid']){
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
            <table>
                <thead>
                    <tr class="heading-row">
                        <th class="qty">Qty</th>
                        <th class="name">Desc</th>
                        <th class="price">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- this is where the order summary goes -->
                </tbody>
            </table>
            <div class="order-total">
                <p>Total</p>
                <h3 class="total"></h3>
            </div>
            <div>
                <button>Save Order</button>
                <button>Proceed</button>
            </div>
        </div>

    <!-- main order form -->
        <div class="main-order-container">
            <div class="head-order-form">
                <h2>Menu (Gr: <?php echo($_SESSION['child'][$posArray]['childGrade']);?>)</h2>
                <!-- search bar -->
                <input type="text" id="myInput" onkeyup="searchItem()" placeholder="Search for Item.." title="Type in a item">
            </div>
            <?php
            require "includes/dbh.inc.php";
            
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
                <form method="post" action="index.php?action=add&code=<?php echo $arrProduct[$key]["idItem"]; ?>">
                    <table id="tblOrderForm">
                        <thead class="heading-item">
                            <tr>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Total</th>
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
                        <th class="product-title">
                            <?php echo $arrProduct[$key]["nameItem"]; ?>
                            <!-- add category for easy searching -->
                            <span style="display: none;"><?php echo $arrProduct[$key]["categoryItem"]; ?></span>
                        </th>
                        <th class="product-price">R <span><?php echo $arrProduct[$key]["priceItem"]; ?></span></th>
                        <th class="qty-action">
                            <button type="button" id="sub" class="sub">-</button>
                            <input type="number" name="quantity" class="product-quantity" id="count" value="0" min="0" max="20" readonly/>
                            <button type="button" id="add" class="add">+</button>
                        </th>
                        <th class="total-product-price"><span></span></th>
                    </tr>
                <?php
                    }   
                    ?>
                    </table>
                </form>
                <?php
            }
            ?>
        </div>

        <?php echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
        // echo($_SERVER['REQUEST_URI']);
        ?>

    </main>

<?php
require "footer.php";
?>