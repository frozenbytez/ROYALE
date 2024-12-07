<?php
// Database connection settings
$servername = "localhost";  // Typically 'localhost' for local development
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password
$dbname = "movies";         // The database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character set to ensure proper character handling
$conn->set_charset("utf8mb4");
?>