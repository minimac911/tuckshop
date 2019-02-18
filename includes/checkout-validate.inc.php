<?php

// function to check if the items that are going to be added to cart are valid and 
// have not been altered
function validCheckOut($e){
    require 'dbh.inc.php';
    //count the amount of rows in query
    $sql = "SELECT COUNT(idOrder) as numItem FROM `tblorders` WHERE";

    for($i = 0; $i < sizeof($e); $i++){
        $sql .= " (idOrder = ? AND dueDate = ? AND totalPrice = ? AND idParent = ?) OR";
    }
    $sql = substr($sql, 0, -2).";";
    

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo("error");
        header("Location: ../order-form.php?error=sqlerror2&cid=".$cid);
        exit();
    } else {
        $a = "";
        $b = "";
        
        for($i = 0; $i < sizeof($e); $i++){
            $a .= "isdi";
            $a_bind_params[] = $e[$i]["id"];
            $a_bind_params[] = date("Y-m-d",strtotime($e[$i]["date"]));
            $a_bind_params[] = $e[$i]["subTotal"];
            $a_bind_params[] = $e[$i]["pid"];
        }

        $a_param_type = str_split($a);
        /* Bind parameters. Types: s = string, i = integer, d = double,  b = blob */
        $a_params = array();
        
        $param_type = '';
        $n = count($a_param_type);
        for($i = 0; $i < $n; $i++) {
            $param_type .= $a_param_type[$i];
        }
        
        /* with call_user_func_array, array params must be passed by reference */
        $a_params[] = & $param_type;
        
        for($i = 0; $i < $n; $i++) {
        /* with call_user_func_array, array params must be passed by reference */
            $a_params[] = & $a_bind_params[$i];
        }
        
        /* Prepare statement */
        $stmt = $conn->prepare($sql);
        if($stmt === false) {
            trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->errno . ' ' . $conn->error, E_USER_ERROR);
        }
        
        /* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */
        call_user_func_array(array($stmt, 'bind_param'), $a_params);
        
        /* Execute statement */
        $stmt->execute();
        
        $results = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_row($results);

        print_r($row);
        echo(sizeof($e));
        if($row[0] == sizeof($e)){
            return 1;
        }
    }
    return 0;
};  