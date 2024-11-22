<?php
$host = 'localhost'; // Server host
$user = 'root';      // Username database
$password = '';      // Password database
$dbname = 'products_db'; // Nama database

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
