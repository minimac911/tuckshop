<?php
require_once "header.php";
require_once "includes/account-verify-session.inc.php";

?>

<main>
    <div class="main-child-container">
        <div class="form-grid">
        <?php
        $cid = "";
        $fName = "";
        $lName = "";
        $grade = "";
        $class = "";
        if (isset($_GET['status'])) {
            if ($_GET['status'] == "edit") {
                $cid =$_GET['cid'];
                $fName = $_GET['fn'];
                $lName = $_GET['ln'];
                $grade = $_GET['gr'];
                $class = $_GET['cl'];
            } 
        } else {
            header("Location: children.php?status=edit");
            exit();
        }
        ?>
            <h1 class="form-heading">Edit Your Child!</h1>
            <div class="form">
                <?php 
                    // if(isset($_GET['error'])=="childadded"){
                    //     if($_GET['error']=="childadded"){
                    //         echo "<p class='signup-error'>Child Already Added</p>";
                    //     }
                    // }
                ?>
                <form  method="post" autocomplete="off">
                    <div class="form-split">
                        <input type="text" name="firstName" placeholder="First Name" value="<?php echo $fName?>" require_onced> 
                        <input type="text" name="lastName" placeholder="Last Name" value="<?php echo $lName?>" require_onced> 
                    </div>
                    <div class="grade-container">
                        <p class="grade-heading">Grade: </p>
                        <select id="drop-down-grade" name="grade" class="drop-selector" onchange="changeOptions()" require_onced>
                        <?php 
                        $output = "<option value='RR' >RR</option>
                            <option value='R'  >R</option>
                            <option value='1'  >1</option>
                            <option value='2'  >2</option>
                            <option value='3'  >3</option>
                            <option value='4'  >4</option>
                            <option value='5'  >5</option>
                            <option value='6'  >6</option>";
                        $pos = strpos($output,"value='".$grade."'")+10;
                        $str_to_insert = "selected";
                        $newOutput = substr_replace($output, $str_to_insert, $pos, 0);
                        echo($newOutput);
                        ?>
                        </select> 
                    </div>

                    <div class="class-container">
                        <p class="class-heading">Class: </p>
                        <select id="drop-down-class" name="class" class="drop-selector" require_onced>
                            <!-- getting the classes for the grade of the child that is 
                            being eddited -->
                            <!-- give the class also the class, this will set the option as selected -->
                            <option disabled selected value> -- select an option -- </option>
                            <?php
                            echo "<script type='text/javascript'>changeOptions('".$grade."', '".$class."');</script>";
                            ?>
                        </select> 
                    </div>
                   
                    <div class="edit-child-buttons">
                        <button type="submit" name="update-child-submit" 
                            <?php
                            $output = "includes/child-update.inc.php?status=update";
                            $output .= "&cid=$cid&fn=$fName&ln=$lName&gr=$grade&cl=$class";
                            echo("formaction='$output'");
                        ?>>Save</button>
                        <button type="button" name="cancel-child-submit" onclick="location.href='children.php?status=edit'">Cancel</button>
                        <button type="button" name="delete-child-submit" class="button-default link"
                        <?php
                            $output = "includes/child-delete.inc.php?status=delete";
                            $output .= "&cid=$cid&fn=$fName&ln=$lName&gr=$grade&cl=$class";
                        ?>
                        onclick="Confirm('Delete Child', 'Are you sure you want to Delete this child', 'Yes', 'Cancel', 'delete-child', '<?php echo($output);?>');"
                        >Delete</button>
                    </div>
                </form>
                
            </div>
        </div> 
        <!-- <div class="children-buttons">
            <div class="back-button">
                <a class="main-button" href="children.php?status=edit">Back</a>
            </div>

        </div>   -->
    </div>  
</main>

<?php
require_once "footer.php";
?>