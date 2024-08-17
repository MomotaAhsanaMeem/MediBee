<?php


$servername = "localhost";
$username = "root";
$password = "";
$database = "CareCompass";
$conn = new mysqli($servername, $username, $password, $database, 3306);

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}


