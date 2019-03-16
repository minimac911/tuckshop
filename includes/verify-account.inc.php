<?php
if(session_id() == ''){
    //session has not started
    session_start();
}

function isValidChilID($id){
    foreach ($_SESSION['child'] as $key => $value) {
        if($value['childId'] == $id)
        {
            return TRUE;
        }
    }
    return FALSE;
}

// function isValidUserID($id){
//     if($_SESSION['userId'] === $id)
//         return true;
//     return false;
// }