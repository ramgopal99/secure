<?php
// Load environment variables (ensure you have a .env file or set in server config)
require_once 'vendor/autoload.php';  // Make sure you have phpdotenv installed

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from a POST request (use POST for login forms, not GET)
$user_input_username = $_POST['username'];

// Secure input sanitization
$user_input_username = htmlspecialchars($user_input_username, ENT_QUOTES, 'UTF-8');

$stmt->bind_param("ss", $user_input_username, $user_input_password); // 'ss' means both are strings

// Execute query
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Output login success
    echo "Login successful!";
} else {
    // Output invalid login
    echo "Invalid username or password!";
}

$stmt->close();
$conn->close();
?>
