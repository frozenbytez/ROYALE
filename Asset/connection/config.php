<?php
// Database connection settings
$servername = "localhost";  // Usually 'localhost' if the database is on the same server
$username = "root";         // Your MySQL username
$password = "";             // Your MySQL password (empty by default for local development)
$dbname = "movies";         // The name of your database

// Create a connection to MySQL database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully"; // This can be commented out once everything works fine
?>
