<?php
session_start();
include('../../assets/php/config.php');

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

// Validate input and session
if (!isset($_SESSION['user_id']) || !$data) {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$user_id = $_SESSION['user_id'];
$movie_id = $data['movie_id'];
$date = $data['date'];
$time = $data['time'];
$seats = $data['seats'];

$total_price = count($seats) * 440; // Price per seat

// Start transaction
$conn->begin_transaction();

try {
    // Insert ticket
    $query = "INSERT INTO tickets (user_id, movie_id, booking_date, screening_time, total_price) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iissd", $user_id, $movie_id, $date, $time, $total_price);
    $stmt->execute();
    $ticket_id = $conn->insert_id;

    // Insert seat details
    $seat_query = "INSERT INTO ticket_seats (ticket_id, seat_row, seat_col) VALUES (?, ?, ?)";
    $seat_stmt = $conn->prepare($seat_query);

    foreach ($seats as $seat) {
        $seat_stmt->bind_param("iii", $ticket_id, $seat['row'], $seat['col']);
        $seat_stmt->execute();
    }

    // Commit transaction
    $conn->commit();

    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}