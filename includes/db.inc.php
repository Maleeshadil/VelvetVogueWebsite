<?php
//Databse Connection
$dbServer = "localhost";
$dbUser = "root";
$dbpass = "";
$database = "velvet_vogue_db";

$conn = mysqli_connect($dbServer, $dbUser, $dbpass, $database);

//
if (!$conn) {
    die("MySql Connection Failed" . mysqli_connect_error());
}
