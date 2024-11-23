<?php
// Load environment variables
require_once 'config.php'; // Assuming this file sets environment variables securely

// Database connection
$servername = getenv('DB_SERVER');
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_NAME');

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user input from a GET request
$user_input_username = $_GET['username'] ?? '';
$user_input_password = $_GET['password'] ?? '';

// Validate input to prevent empty or invalid values
if (empty($user_input_username) || empty($user_input_password)) {
    die("Username and password cannot be empty.");
}

// Prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
if (!$stmt) {
    die("Prepare statement failed: " . $conn->error);
}

$stmt->bind_param("ss", $user_input_username, $user_input_password); // 'ss' means both are strings
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Login successful!";
} else {
    echo "Invalid username or password!";
}

$stmt->close();
$conn->close();
?>
