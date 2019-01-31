<?php
require "header.php";
require "includes/account-verify-session.inc.php";   
require 'includes/child-view.inc.php';
?>

    <main>
        <div class="main-child-container">
            <h1>
                <?php 
                if (isset($_GET['status'])) {
                    if($_GET['status'] == "edit"){
                        echo ("Edit Children");
                    }else {
                        echo ("View Children");
                    }
                } else {
                    echo ("View Children");
                }
                ?>
            </h1>
            <div class="grid-container">
                <?php
                // echo sizeof($arrChild);
                ?><?php
                    $count = 0;
                    if(sizeof($arrChild)<=0){
                        echo("<h2>You have no children added!</h2>");
                    }else{
                        for ($i = 0; $i < sizeof($arrChild); $i++) {
                            $child = $arrChild[$i];
                            $childId = $child[0];
                            $firstName = $child[1];
                            $lastName = $child[2];
                            $grade = $child[3];
                            $class = $child[4];
                            if ($count == 0) {
                                ?>
                            <div class="child-row">
                            <?php

                            }
                        ?>
                        <div class="child-info-conatiner">
                            <div class="child-info">
                                <div class="child-first-name" style="font-size:30px;"><?php echo $firstName; ?></div>
                                <div class="child-last-name" style="font-size:30px; margin-bottom:20px;"><?php echo $lastName; ?></div>
                                <div class="child-grade" style="font-size:17px;">Grade: <span style="font-weight:600;"><?php echo $grade; ?></span></div>
                                <div class="child-class" style="font-size:17px;">Class: <span style="font-weight:600;"><?php echo $class; ?></span></div>
                                <div id="child-id" style="visibility: hidden;"><?php echo $childId; ?></div>
                            </div>
                            <div class="child-edit-button">
                                <form method="post">
                                <?php 
                                if (isset($_GET['status']) == "edit") {
                                    if($_GET['status'] == "edit"){
                                    ?>
                                    <button name="edit-child" type="button"
                                        onclick="location.href='edit-child.php?status=edit&cid=<?php echo $childId;?>&fn=<?php echo $firstName;?>&ln=<?php echo $lastName;?>&gr=<?php echo $grade;?>&cl=<?php echo $class;?>'">
                                        Edit
                                    </button>
                                    <?php
                                    }else{
                                        header("Location: ERROR/404.php");
                                        exit();
                                    }
                                } else {
                                    ?>
                                    <button name="order-form-submit" type="submit"
                                        formaction="includes/order-prepare-form.inc.php?cid=<?php echo $childId;?>"
                                    >Order</button>
                                    <?php
                                }
                            ?>
                            </form>
                        </div>
                    </div>
                <?php
                    // echo $count;
                $count++;
                if ($count == 3) {
                    echo "</div>";
                    $count = 0;
                }

            }
            if ($count != 0) {
                echo "</div>";
            }
        }
            ?>
                
            </div>
            <div class="children-buttons">
            <?php 
                if(isset($_GET['status'])){
                    if($_GET['status']=="edit"){
                        ?>
                             <div class="back-button">
                                <a class="main-button" href="children.php">Back</a>
                            </div>
                        <?php
                    }
                }else{
                    if(sizeof($arrChild)>0){
                        ?>
                        <div class="edit-child-button">
                            <a href="children.php?status=edit">edit</a>
                        </div>
                        <?php
                    }
                    ?>
                        
                        <div class="add-child-button">
                            <a href="add-child.php">Add Child</a>
                        </div>
                    <?php
                }
            ?>
                
            </div>      
        </div>
    </main>

<?php
require "footer.php";
?>