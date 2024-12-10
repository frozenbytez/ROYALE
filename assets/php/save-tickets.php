<?php 
// Enhanced error reporting and logging
error_reporting(E_ALL);
ini_set('display_errors', 1);
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

// Enhanced connection error handling
if ($conn->connect_error) {
    http_response_code(500);
    error_log("Database connection failed: " . $conn->connect_error);
    echo json_encode([
        'success' => false, 
        'message' => 'Database connection error'
    ]);
    exit;
}

// Decode JSON data
$rawInput = file_get_contents('php://input');
$data = json_decode($rawInput, true);

// Comprehensive input validation
if (!$data || 
    !isset($data['seats']) || 
    !isset($data['movie_id']) || 
    !isset($data['date']) || 
    !isset($data['time'])) {
    
    http_response_code(400);
    error_log("Invalid input: " . print_r($data, true));
    echo json_encode([
        'success' => false, 
        'message' => 'Invalid or missing input parameters'
    ]);
    exit;
}

try {
    // Begin transaction
    $conn->begin_transaction();

    $successfulBookings = [];
    $failedBookings = [];

    // Prepare statements for checking and updating seat status
    $stmtCheck = $conn->prepare("SELECT status FROM movie_seats WHERE seat_row = ? AND seat_col = ? AND movie_id = ? AND date = ? AND time = ?");
    $stmtUpdate = $conn->prepare("UPDATE movie_seats SET status = 'booked' WHERE seat_row = ? AND seat_col = ? AND movie_id = ? AND date = ? AND time = ? AND status = 'available'");

    // Loop through the selected seats
    foreach ($data['seats'] as $seat) {
        $row = intval($seat['row']);
        $col = intval($seat['col']);
        $movie_id = intval($data['movie_id']);
        $date = $data['date'];
        $time = $data['time'];
        
        // Bind parameters for seat availability check
        $stmtCheck->bind_param("iiiss", $row, $col, $movie_id, $date, $time);
        $stmtCheck->execute();
        $result = $stmtCheck->get_result();
        
        if ($result->num_rows === 0) {
            error_log("Seat $row-$col does not exist");
            $failedBookings[] = $seat;
            continue;
        }

        $seatData = $result->fetch_assoc();
        
        // Check if the seat is already booked
        if ($seatData['status'] !== 'available') {
            error_log("Seat $row-$col is already booked");
            $failedBookings[] = $seat;
            continue;
        }

        // Bind parameters for updating seat status
        $stmtUpdate->bind_param("iiiss", $row, $col, $movie_id, $date, $time);
        
        // Update the seat status to 'booked'
        if ($stmtUpdate->execute() && $stmtUpdate->affected_rows > 0) {
            $successfulBookings[] = $seat;
        } else {
            error_log("Failed to book seat $row-$col");
            $failedBookings[] = $seat;
        }
    }

    // Close the statements
    $stmtCheck->close();
    $stmtUpdate->close();

    // Handle the booking results
    if (!empty($failedBookings)) {
        $conn->rollback();
        http_response_code(409);
        echo json_encode([
            'success' => false, 
            'message' => 'Some seats could not be booked',
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
    http_response_code(500);
    error_log("Booking exception: " . $e->getMessage());
    
    echo json_encode([
        'success' => false, 
        'message' => 'Booking error occurred'
    ]);
} finally {
    // Close the connection
    $conn->close();
}
?>