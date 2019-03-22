<?php

// $servername = "localhost";
// $dBUsername = "root";
// $dBPassword = "";
// $dBName = "dbtuckshop";

// $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

$servername = "127.0.0.1:3306";
$dBUsername = "root";
$dBPassword = "admin";
$dBName = "dbtuckshop";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
