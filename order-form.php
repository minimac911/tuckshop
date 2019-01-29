<?php
require "header.php";
//error checking
require "includes/account-verify-session.inc.php";
if(empty($_SESSION['child'][0]['childId'])){
    header ("Location: children.php");
    exit();
}
?>

    <main>  
        <div class="order-frm-change">
            <h1>Orderding for: <i><?php 
                $count = 0;
                $found = false;
                while($count<sizeof($_SESSION['child']) && $found != true){
                    if(isset($_GET['cid'])){
                        if($_SESSION['child'][$count]['childId'] == $_GET['cid']){
                            $found = true;
                            echo($_SESSION['child'][$count]['childFirstName']." ".$_SESSION['child'][$count]['childLastName']);
                        }else{
                            $count++;
                        }
                    } else {
                        $found = true;
                        echo($_SESSION['child'][0]['childFirstName']." ".$_SESSION['child'][0]['childLastName']);
                    }
                }
            ?></i></h1>
            <form action="">
                <button>Change</button>
            </form>
        </div>
        <?php echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
        // echo($_SERVER['REQUEST_URI']);
        ?>
    </main>

<?php
require "footer.php";
?>