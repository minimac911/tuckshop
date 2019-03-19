<?php
require "header.php";
require "includes/account-verify-session.inc.php";
require "includes/invoice-view.inc.php";
require "includes/invoice-create-table.inc.php";
?>

    <main>
        <div class="invoice-main-container">
            <div class="invoice-upcoming">
                <h2>Upcoming</h2>
                <?php
                    creatInvoiceTable(true,$arrChild);
                ?>
            </div>

            <div class="invoice-history">
                <h2>History</h2>
                <?php
                    creatInvoiceTable(false,$arrChild);
                ?>
            </div>
        </div>
    </main>
    
<?php
    require "footer.php";
?>