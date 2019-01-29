<?php
session_start();
//add childrens id to the session
$sql = "SELECT * FROM tblChildren WHERE idUsers = ?;";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../login-signup.php?errorlog=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $_SESSION['userId']);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);
    //SECURITY CHECK (no if statment checking if there are any rows)
    // create an array
    $child = array();
    while ($row = mysqli_fetch_array($results)) {
        $child[] = array(
                    "childId" => $row["idChild"],
                    "childFirstName" => $row["firstNameChild"],
                    "childLastName" => $row["lastNameChild"],
                    "childGrade" => $row["gradeChild"],
                    "childClass" => $row["classChild"]
                );
    }      
    //checking that the array is not empty    
    $_SESSION['child'] = $child;                              
    // if (!empty($child[])) {
        
    // }
}
