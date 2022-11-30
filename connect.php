<?php
//Host local
$host = "localhost";
$username = "root";
$password = "";
$database_name = "cart";

$conn = new mysqli($host, $username, $password, $database_name);
if (!$conn) {
    echo "Connected to MYSQL error";
    die(mysqli_error($conn));
}
