<?php

// $servername = "localhost";
// $dBUsername = "root";
// $dBPassword = "";
// $dBName = "dbtuckshop";

// $conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

$servername = "localhost:2206";
$dBUsername = "root";
$dBPassword = "admin";
$dBName = "dbtuckshop";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}

