<?php
session_start();
// Include the database connection file
require_once 'connect.php'; // This ensures that the connection is available

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the required fields are set
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare SQL query to prevent SQL injection
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);

        if ($stmt) {
            $stmt->bind_param('s', $username); // 's' indicates the parameter is a string
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                // Verify the password
                if (password_verify($password, $user['password'])) {
                    // Store user information in session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['loggedIn'] = true;
                    // Redirect to the index page after successful login
                    header('Location: index.php');
                    exit();
                } else {
                    echo "Invalid password.";
                }
            } else {
                echo "No user found with that username.";
            }

            $stmt->close(); // Close the statement when done
        } else {
            // Handle preparation error
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        // Handle missing form fields
        echo "Please fill in all required fields.";
    }
    
}

// Connection automatically closes when the script ends

?>