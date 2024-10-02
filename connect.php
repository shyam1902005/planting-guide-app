<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Default XAMPP username for MySQL
$password = "Shyam@1908"; // Default XAMPP password for MySQL (usually empty)
$dbname = "planting_guide"; // Replace with your database name

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>