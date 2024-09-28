<?php
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = "Shyam@1908"; // Your database password
$dbname = "planting_guide"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
