<?php

if (isset($_POST['order-form-submit']) || isset($_POST['orderForm'])) {
    session_start();
    if(empty($_SESSION['child'][0]['childId'])){
        header("Location: ../children.php");
        exit();
    }else{
        //make sure that there is a child id for the url
        if(isset($_GET['cid'])){
            $childId = $_GET['cid'];
        }else{
            $childId = $_SESSION['child'][0]['childId'];
            if(isset($_GET['cid'])){
                $childId = $_GET['cid'];
            }
            echo($childId);
        }
        header("Location: ../order-form.php?cid=".$childId);
        exit();
    }

    echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
    echo(time()+3600);
    // echo(strpos($_SERVER['REQUEST_URI'], "children.php"));
} else {
    header("Location: ../children.php");
    exit();
}