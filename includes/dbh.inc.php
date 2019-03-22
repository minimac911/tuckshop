<?php

// $servername = "localhost";
// $dBUsername = "root";
// $dBPassword = "";
// $dBName = "dbtuckshop";

// $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

$servername = "localhost:3306";
$dBUsername = "root";
$dBPassword = "root";
$dBName = "dbtuckshop";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}

