<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "Shyam@1908"; // Your MySQL password
$dbname = "planting_guide";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the data sent via POST request
$location = $_POST['location'] ?? '';
$avg_temp = $_POST['avg_temp'] ?? '';
$sunlight = $_POST['sunlight'] ?? '';
$water_availability = $_POST['water_availability'] ?? '';
$humidity = $_POST['humidity'] ?? '';
$soil_quality = $_POST['soil_quality'] ?? '';
$soil_ph = $_POST['soil_ph'] ?? '';

// Prepare SQL query to find suitable plants based on input conditions
$sql = "SELECT plant_name FROM plants 
        WHERE location = ? 
        AND avg_temp_min <= ? AND avg_temp_max >= ?
        AND sunlight = ?
        AND water_availability = ?
        AND humidity = ?
        AND soil_quality = ?
        AND soil_ph_min <= ? AND soil_ph_max >= ?
        ORDER BY plant_name"; // Order the results by plant name

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "sssssssdd", 
    $location, 
    $avg_temp, $avg_temp, 
    $sunlight, 
    $water_availability, 
    $humidity, 
    $soil_quality, 
    $soil_ph, $soil_ph
);

$stmt->execute();
$result = $stmt->get_result();

$plants = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $plants[] = $row['plant_name'];
    }
}

// Return the result as an HTML table
header('Content-Type: text/html');
if (count($plants) > 0) {
    echo "<table style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th style='border: 1px solid #000; padding: 8px;'>Recommended Plants</th></tr>";
    foreach ($plants as $plant) {
        echo "<tr><td style='border: 1px solid #000; padding: 8px;'>" . htmlspecialchars($plant) . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No suitable plants found.";
}

$stmt->close();
$conn->close();
?>
