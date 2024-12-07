<?php
// Database connection configuration
$host = 'localhost'; // Database server (use '127.0.0.1' or 'localhost')
$dbname = 'login_system'; // Name of your database
$username = 'root'; // Your database username
$password = ''; // Your database password (leave blank if no password)

// Establish the database connection
try {
    $db = new mysqli($host, $username, $password, $dbname);

    // Check for connection errors
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }
} catch (Exception $e) {
    die("Database connection error: " . $e->getMessage());
}
?>
