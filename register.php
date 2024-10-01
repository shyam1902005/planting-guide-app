<?php
session_start();
require_once 'connect.php'; // Include the database connection

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? password_hash(trim($_POST['password']), PASSWORD_DEFAULT) : '';

    // Check if required fields are not empty
    if (!empty($email) && !empty($username) && !empty($password)) {
        // Check if the email already exists
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Email already exists
            echo "This email is already registered.";
        } else {
            // Prepare the insertion statement
            $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $email, $username, $password);

            // Execute the insertion statement
            if ($stmt->execute()) {
                // Registration successful, set session variables
                $_SESSION['loggedIn'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;

                // Redirect to login page after successful registration
                header("Location: login.html"); // Change this to your actual login page URL
                exit(); // Make sure to call exit after the redirect
            } else {
                // Insertion failed
                echo "Error: " . $stmt->error;
            }

            // Closing the statement
            $stmt->close();
        }
    } else {
        echo "Please fill all required fields.";
    }
} else {
    echo "Invalid request method.";
}

// Closing the database connection
$conn->close();
?>