<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "Shyam@1908";
$dbname = "planting_guide";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle AJAX requests
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'];

    if ($action === "getPlantInfo") {
        // Fetch plant info by name
        $plantName = strtolower(trim($_POST['plantName']));
        $sql = "SELECT name, sunlight_requirement, min_temp_celsius, max_temp_celsius, soil_quality, water_requirement
                FROM plants WHERE LOWER(name) = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $plantName);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $plantData = $result->fetch_assoc();
            echo json_encode($plantData);
        } else {
            echo json_encode(["error" => "No plant found"]);
        }
    } elseif ($action === "getLocationBasedPlants") {
        // Fetch suitable plants based on location and conditions
        $location = trim($_POST['location']);
        $avgTemp = intval($_POST['avgTemp']);
        $sunlight = $_POST['sunlight'];
        $soilColor = $_POST['soilColor'];
        $soilPH = floatval($_POST['soilPH']);

        $sql = "SELECT p.name 
                FROM plants p
                JOIN soil_data s ON s.location = ?
                WHERE p.min_temp_celsius <= ? AND p.max_temp_celsius >= ?
                AND p.sunlight_requirement = ?
                AND s.soil_quality = ?
                AND s.ph_level BETWEEN ? AND ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siiissd", $location, $avgTemp, $avgTemp, $sunlight, $soilColor, $soilPH, $soilPH);
        $stmt->execute();
        $result = $stmt->get_result();

        $plants = [];
        while ($row = $result->fetch_assoc()) {
            $plants[] = $row['name'];
        }

        if (!empty($plants)) {
            echo json_encode($plants);
        } else {
            echo json_encode(["error" => "No plants found for the given conditions"]);
        }
    }
}
$conn->close();
?>
