<?php
header('Content-Type: application/json');

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movies";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed: ' . $conn->connect_error]);
    exit;
}

// Get the raw POST data
$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

// Validate input
if (!$data || !isset($data['date']) || !isset($data['time'])) {
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

// Prepare SQL to get booked seats
$stmt = $conn->prepare("SELECT seat_row, seat_col FROM tickets WHERE show_date = ? AND show_time = ?");
$stmt->bind_param("ss", $data['date'], $data['time']);
$stmt->execute();
$result = $stmt->get_result();

$bookedSeats = [];
while ($row = $result->fetch_assoc()) {
    $bookedSeats[] = $row;
}

echo json_encode($bookedSeats);

$stmt->close();
$conn->close();
?>