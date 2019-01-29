<?php
    require "header.php";
?>

    <main>
        <?php
            if(isset($_SESSION['userId'])){
                echo '<p>You are logged in!</p>';
            }else{
                echo '<p>You are logged out!</p>';
            }
            echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

        ?>
        <div class="items-container">

        </div>
        
    </main>

<?php
    require "footer.php";
?>