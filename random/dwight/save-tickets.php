<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log errors to a file
ini_set('log_errors', 1);
ini_set('error_log', 'ticket_booking_errors.log');

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
    error_log("Connection failed: " . $conn->connect_error);
    echo json_encode([
        'success' => false, 
        'message' => 'Database connection error'
    ]);
    exit;
}

// Log the raw input for debugging
$rawInput = file_get_contents('php://input');
error_log("Raw input: " . $rawInput);

// Decode JSON data
$data = json_decode($rawInput, true);

// Detailed input validation
if (!$data) {
    error_log("JSON decoding failed. JSON error: " . json_last_error_msg());
    echo json_encode([
        'success' => false, 
        'message' => 'Invalid JSON input',
        'json_error' => json_last_error_msg()
    ]);
    exit;
}

if (!isset($data['seats']) || 
    !isset($data['date']) || 
    !isset($data['time']) || 
    !isset($data['totalCost'])) {
    
    error_log("Missing required fields");
    echo json_encode([
        'success' => false, 
        'message' => 'Missing required fields',
        'received_data' => $data
    ]);
    exit;
}

try {
    // Begin transaction
    $conn->begin_transaction();

    $successfulBookings = [];
    $failedBookings = [];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO tickets (seat_row, seat_col, show_date, show_time, total_cost) VALUES (?, ?, ?, ?, ?)");

    foreach ($data['seats'] as $seat) {
        $row = intval($seat['row']);
        $col = intval($seat['col']);
        
        // Bind parameters
        $stmt->bind_param("iissd", $row, $col, $data['date'], $data['time'], $data['totalCost']);

        // Execute the statement
        if ($stmt->execute()) {
            $successfulBookings[] = $seat;
        } else {
            error_log("Seat booking failed: " . $stmt->error);
            $failedBookings[] = $seat;
        }
    }

    $stmt->close();

    // Handle booking results
    if (!empty($failedBookings)) {
        $conn->rollback();
        error_log("Some seats could not be booked");
        echo json_encode([
            'success' => false, 
            'message' => 'Some seats could not be booked or may already be reserved',
            'failed_seats' => $failedBookings
        ]);
    } else {
        $conn->commit();
        echo json_encode([
            'success' => true, 
            'message' => 'All tickets booked successfully'
        ]);
    }

} catch (Exception $e) {
    // Rollback and log any unexpected errors
    $conn->rollback();
    error_log("Booking exception: " . $e->getMessage());
    
    echo json_encode([
        'success' => false, 
        'message' => 'Booking error: ' . $e->getMessage()
    ]);
}

// Close the connection
$conn->close();
?>