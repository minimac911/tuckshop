<?php
session_start();

require_once 'classes/classes.inc.php';
$db = new db();
//add childrens id to the session
$sql = "SELECT * FROM tblChildren WHERE idUser = ?;";
// check if the sql query is valid
if(!$db->validQuery($sql)){
    header("Location: ../login-signup.php?errorlog=sqlerror");
    exit();
}else{
    $results = $db->query($sql, $_SESSION['userId'])->fetchAll();

    //SECURITY CHECK (no if statment checking if there are any rows)
    // create an array
    $child = array();
    foreach ($results as $key => $value) {
        $child[] = array(
            "childId" => $value["idChild"],
            "childFirstName" => $value["firstNameChild"],
            "childLastName" => $value["lastNameChild"],
            "childGrade" => $value["gradeChild"],
            "childClass" => $value["classChild"]
        );
    }
    //checking that the array is not empty    
    $_SESSION['child'] = $child;

    //close connection to database
    $db->close();
}