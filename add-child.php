<?php
require "header.php";
require "includes/account-verify-session.inc.php";
?>

    <main>
        <div class="form-grid">
            <?php
                if(isset($_GET['add'])=="success"){
                    ?>
                    <h1 class="form-heading">Child Added!</h1>
                    <div class="form add-another">
                        <div class="form-split">
                            <a href="add-child.php">Add Another</a>
                            <a href="children.php">View Children</a>
                        </div>                        
                    </div>
                    <?php
                }else{
                    ?>
                    <h1 class="form-heading">Now add your child!</h1>
                    <div class="form">
                        <?php 
                            if(isset($_GET['error'])=="childadded"){
                                if($_GET['error']=="childadded"){
                                    echo "<p class='signup-error'>Child Already Added</p>";
                                }
                            }
                        ?>
                        <form action="includes/child-add.inc.php" method="post" autocomplete="off">
                            <div class="form-split">
                                <input type="text" name="firstName" placeholder="First Name" required> 
                                <input type="text" name="lastName" placeholder="Last Name" required> 
                            </div>
                            <div class="grade-container">
                                <p class="grade-heading">Grade: </p>
                                <select id="drop-down-grade" name="grade" class="drop-selector" onchange="changeOptions()" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <option value="RR">RR</option>
                                    <option value="R">R</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select> 
                            </div>

                            <div class="class-container">
                                <p class="class-heading">Class: </p>
                                <select id="drop-down-class" name="class" class="drop-selector" required>
                                    <option disabled selected value> -- select an option -- </option>
                                    <option value="hedgehogs">Hedgehogs</option>
                                    <option value="squirrel">Squirrel</option>
                                </select> 
                            </div>
                            <button type="submit" name="add-child-submit">Add Child</button>
                        </form>
                        
                    </div>
                    <?php
                }   
            ?>
            
        </div> 
    </main>

<?php
    require "footer.php";
?>