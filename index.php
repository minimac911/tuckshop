<?php
    require_once "header.php";
?>

    <main>
        <?php
            if(isset($_SESSION['userId'])){
                echo '<p>You are logged in!</p>';
            }else{
                echo '<p>You are logged out!</p>';
            }
            

        ?>
        <div class="items-container">

        </div>
        
    </main>

<?php
    require_once "footer.php";
?>