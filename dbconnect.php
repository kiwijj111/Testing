<?php

$server = "localhost"; // Including port
$username = "root";
$password = ""; // If password is blank, try using ""
$database = "Foodfusion";

$connect = new mysqli($server, $username, $password, $database);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error); // Corrected the error message
} 
else {
    //  echo "Connection Success!";
}
?>