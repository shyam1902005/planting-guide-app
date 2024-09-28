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
$sql = "
    SELECT p.*, GROUP_CONCAT(l.state_name SEPARATOR ', ') AS locations
    FROM plants p
    LEFT JOIN plant_locations pl ON p.id = pl.plant_id
    LEFT JOIN locations l ON pl.location_id = l.id
    WHERE LOWER(p.plant_name) = LOWER(?)
    GROUP BY p.id
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $plant_name);
$stmt->execute();
$result = $stmt->get_result();

$plant_info = [];
if ($result->num_rows > 0) {
    // Fetch plant information along with its associated locations
    $plant_info = $result->fetch_assoc();
}

// Return the result as plain text (with delimiter '|')
header('Content-Type: text/plain');
if (!empty($plant_info)) {
    // Gather plant details as plain text
    $details = "Location: " . htmlspecialchars($plant_info['locations']) . ", " .
               "Avg Temp: " . htmlspecialchars($plant_info['avg_temp_min']) . "°C to " . htmlspecialchars($plant_info['avg_temp_max']) . "°C, " .
               "Sunlight: " . htmlspecialchars($plant_info['sunlight']) . ", " .
               "Water Availability: " . htmlspecialchars($plant_info['water_availability']) . ", " .
               "Humidity: " . htmlspecialchars($plant_info['humidity']) . ", " .
               "Soil Quality: " . htmlspecialchars($plant_info['soil_quality']) . ", " .
               "Soil pH: " . htmlspecialchars($plant_info['soil_ph_min']) . " to " . htmlspecialchars($plant_info['soil_ph_max']);

    // Split the location and details with a delimiter (|) for JavaScript parsing
    echo $details . "|" . htmlspecialchars($plant_info['locations']);
} else {
    echo "No information found for the specified plant.|";
}

$stmt->close();
$conn->close();
?>
