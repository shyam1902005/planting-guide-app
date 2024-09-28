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

// Fetch the plant name sent via POST request
$plant_name = $_POST['plant_name'] ?? '';

// Prepare SQL query to find the plant details based on the plant name
$sql = "SELECT * FROM plants WHERE LOWER(plant_name) = LOWER(?)"; // Assuming plant names are case-insensitive
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $plant_name);
$stmt->execute();
$result = $stmt->get_result();

$plant_info = [];
if ($result->num_rows > 0) {
    // Fetch plant information
    $plant_info = $result->fetch_assoc();
}

// Return the result as HTML
header('Content-Type: text/html');
if (!empty($plant_info)) {
    echo "<h2>Details for " . htmlspecialchars($plant_info['plant_name']) . "</h2>";
    echo "<p><strong>Location:</strong> " . htmlspecialchars($plant_info['location']) . "</p>";
    echo "<p><strong>Average Temperature (Min):</strong> " . htmlspecialchars($plant_info['avg_temp_min']) . "°C</p>";
    echo "<p><strong>Average Temperature (Max):</strong> " . htmlspecialchars($plant_info['avg_temp_max']) . "°C</p>";
    echo "<p><strong>Sunlight:</strong> " . htmlspecialchars($plant_info['sunlight']) . "</p>";
    echo "<p><strong>Water Availability:</strong> " . htmlspecialchars($plant_info['water_availability']) . "</p>";
    echo "<p><strong>Humidity:</strong> " . htmlspecialchars($plant_info['humidity']) . "</p>";
    echo "<p><strong>Soil Quality:</strong> " . htmlspecialchars($plant_info['soil_quality']) . "</p>";
    echo "<p><strong>Soil pH:</strong> " . htmlspecialchars($plant_info['soil_ph_min']) . " to " . htmlspecialchars($plant_info['soil_ph_max']) . "</p>";
} else {
    echo "No information found for the specified plant.";
}

$stmt->close();
$conn->close();
?>
