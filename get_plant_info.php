<?php
require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plant_name = strtolower(trim($_POST['plant_name']));

    $sql = "SELECT name, sunlight_requirement AS weather, soil_quality AS soil FROM plants WHERE LOWER(name) = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $plant_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode(["success" => true, "data" => $row]);
    } else {
        echo json_encode(["success" => false, "message" => "No plant found with the name '$plant_name'."]);
    }
    $stmt->close();
}
$conn->close();
?>
