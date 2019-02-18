<?php


if(isset($_GET['oid'])){
    session_start();
    require 'dbh.inc.php';

    $s = $_GET['oid'];
    $a = "";

    $arrOID = explode("-",$s);
    $sql = "INSERT INTO tblinvoice (idOrder, datePaid, idParent) VALUES";
    foreach ($arrOID as $k => $v) {
        $sql .= "( ?, now(), ?),";  
        $a .= "ii";
        $a_bind_params[] = $v;
        $a_bind_params[] = $_SESSION['userId'];
    } 
    $sql = substr($sql, 0, -1);

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
    }else{
        /* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */
        call_user_func_array(array($stmt, 'bind_param'), $a_params);
            
        /* Execute statement */
        $stmt->execute();



// UPDATE tblorders TO SHOW THAT IT WAS PAID----------------------------------------------------------------------
        $sql = "UPDATE tblorders SET paid = 1 WHERE ";
        $a = "";
        foreach ($arrOID as $k => $v) {
            $sql .= "idOrder = ? OR";  
            $a .= "i";
            $a_bind_params[] = $v;
        } 
        $sql = substr($sql, 0, -2);

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
        }else{
            /* use call_user_func_array, as $stmt->bind_param('s', $param); does not accept params array */
            call_user_func_array(array($stmt, 'bind_param'), $a_params);
                
            /* Execute statement */
            $stmt->execute();
            header("Location: ../invoices.php?paid=success");
            exit();
        }

    }
    header("Location: ../invoices.php");
    exit();
    

}else{
    header("Location: ../checkout.php");
    exit();
}

