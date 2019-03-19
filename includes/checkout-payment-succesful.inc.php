<?php
// TODO: Make it use the invoice_bridge

if(isset($_GET['oid'])){
    session_start();
    require 'dbh.inc.php';

    $s = $_GET['oid'];
    $a = "";

    $arrOID = explode("-",$s);

    //create new invoice
    $sql = "INSERT INTO tblinvoice (idUser, datePaid) VALUES (?, now());";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../checkout.php?errorlog=sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['userId']);
        mysqli_stmt_execute($stmt);

        //get the invoice id for the new invoice
        $sql = "SELECT idInvoice FROM tblinvoice WHERE idUser = ? ORDER BY datePaid DESC;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../checkout.php?errorlog=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "i", $_SESSION['userId']);
            mysqli_stmt_execute($stmt);
            $results = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($results);
            //the invoice id from the new invoice
            $inoviceID = $row[0];
            // echo($inoviceID);


            // put the orders into the invoice bridge
            $sql = "INSERT INTO invoice_bridge (idInvoice, idOrder) VALUES";
            foreach ($arrOID as $k => $oid) {
                $sql .= "( ?, ?),";  
                $a .= "ii";
                $a_bind_params[] = $inoviceID;
                $a_bind_params[] = $oid;
            } 
            $sql = substr($sql, 0, -1);
            echo($sql);


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
            }
        }

// UPDATE tblorders TO SHOW THAT IT WAS PAID----------------------------------------------------------------------
        $sql = "UPDATE tblorders SET paid = 1 WHERE ";
        $a = "";
        $a_bind_params = null;
        foreach ($arrOID as $k => $v) {
            $sql .= "idOrder = ? OR ";  
            $a .= "i";
            $a_bind_params[] = $v;
        } 
        $sql = substr($sql, 0, -3);

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

