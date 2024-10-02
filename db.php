<?php
// db.php

$host = 'localhost'; // Your database host
$dbname = 'planting_guide'; // Your database name
$username = 'root'; // Your MySQL username
$password = 'Shyam@1908'; // Your MySQL password

// Create a new PDO instance
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Set the PDO error mode to exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>