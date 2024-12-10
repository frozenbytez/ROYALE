<?php
// Set headers for JSON response
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Allow cross-origin requests if needed
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movies";

// Enhanced error response function
function sendErrorResponse($statusCode, $message) {
    http_response_code($statusCode);
    echo json_encode([
        'success' => false,
        'message' => $message
    ]);
    exit;
}

// Create connection with error handling
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    sendErrorResponse(500, 'Database connection failed: ' . $conn->connect_error);
}

// Handle OPTIONS preflight request for CORS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Ensure it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorResponse(405, 'Method Not Allowed');
}

// Get raw POST data
$rawInput = file_get_contents('php://input');

// Validate JSON input
$data = json_decode($rawInput, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    sendErrorResponse(400, 'Invalid JSON input: ' . json_last_error_msg());
}

// Comprehensive input validation
$validationErrors = [];

// Validate movie_id
if (!isset($data['movie_id']) || 
    !filter_var($data['movie_id'], FILTER_VALIDATE_INT)) {
    $validationErrors[] = 'Invalid or missing movie ID';
}

// Validate date
if (!isset($data['date']) || 
    !preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['date']) ||
    !strtotime($data['date'])) {
    $validationErrors[] = 'Invalid date format. Use YYYY-MM-DD';
}

// Validate time
if (!isset($data['time']) || 
    !preg_match('/^\d{2}:\d{2}(:\d{2})?$/', $data['time'])) {
    $validationErrors[] = 'Invalid time format. Use HH:MM or HH:MM:SS';
}

// If there are validation errors, return them
if (!empty($validationErrors)) {
    sendErrorResponse(400, implode(', ', $validationErrors));
}

// Sanitize inputs
$movie_id = intval($data['movie_id']);
$date = $conn->real_escape_string($data['date']);
$time = $conn->real_escape_string($data['time']);

// Prepare and execute query with error handling
try {
    $stmt = $conn->prepare("SELECT seat_row, seat_col FROM movie_seats WHERE movie_id = ? AND date = ? AND time = ? AND status = 'booked'");
    
    // Bind parameters
    $stmt->bind_param("iss", $movie_id, $date, $time);
    
    // Execute query
    $stmt->execute();
    
    // Get results
    $result = $stmt->get_result();
    
    // Fetch booked seats
    $bookedSeats = [];
    while ($row = $result->fetch_assoc()) {
        $bookedSeats[] = $row;
    }
    
    // Return booked seats
    echo json_encode([
        'success' => true,
        'bookedSeats' => $bookedSeats
    ]);
} catch (Exception $e) {
    // Catch any unexpected errors
    sendErrorResponse(500, 'Query execution error: ' . $e->getMessage());
} finally {
    // Close statement and connection
    if (isset($stmt)) $stmt->close();
    $conn->close();
}
?>