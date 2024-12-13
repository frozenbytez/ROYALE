<?php
// Database Connection
$host = 'localhost';
$dbname = 'movies';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}

// Debugging: Print out table structure
function printTableColumns($pdo, $tableName) {
    $stmt = $pdo->query("DESCRIBE $tableName");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Columns in $tableName: " . implode(', ', $columns);
}

// Uncomment these to debug table structures
// printTableColumns($pdo, 'tickets');
// printTableColumns($pdo, 'movies');
// printTableColumns($pdo, 'ticket_seats');
// exit;

// User Authentication (Placeholder - replace with your actual authentication logic)
session_start();
$user_id = $_SESSION['user_id'] ?? 1; // Default to user 1 for demonstration

// Fetch Comprehensive Booking History
try {
    $stmt = $pdo->prepare("
        SELECT 
            tickets.id AS ticket_id,
            tickets.booking_date,
            tickets.screening_time,
            tickets.total_price,
            tickets.booking_timestamp,
            movies.title,
            movies.image_url,
            movies.runtime,
            movies.genre,
            movies.rating,
            GROUP_CONCAT(DISTINCT CONCAT(ticket_seats.seat_row, ticket_seats.seat_col) SEPARATOR ', ') AS seats,
            COUNT(ticket_seats.seat_row) AS ticket_quantity
        FROM 
            tickets
        JOIN 
            movies ON tickets.movie_id = movies.id
        LEFT JOIN 
            ticket_seats ON ticket_seats.ticket_id = tickets.id
        WHERE 
            tickets.user_id = :user_id
        GROUP BY 
            tickets.id
        ORDER BY 
            tickets.booking_timestamp DESC
    ");
    $stmt->execute(['user_id' => $user_id]);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Detailed error logging
    echo "Query Error: " . $e->getMessage();
    // You might want to log this error to a file in a production environment
    exit;
}

// Rest of the previous code remains the same
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .booking-card {
            transition: all 0.3s ease;
            background: rgba(45, 55, 72, 0.7);
            backdrop-filter: blur(10px);
        }
        .booking-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }
        .ticket-badge {
            background: linear-gradient(to right, #4299e1, #3182ce);
        }
    </style>
</head>
<body class="min-h-screen py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-white mb-4">
                <i class="fas fa-ticket-alt mr-3 text-blue-400"></i>Booking History
            </h1>
            <p class="text-gray-400">Relive your cinematic moments</p>
        </div>

        <?php if (empty($bookings)): ?>
            <div class="text-center bg-gray-800 p-12 rounded-lg">
                <i class="fas fa-film text-6xl text-gray-600 mb-4"></i>
                <p class="text-gray-400 text-xl">No booking history found</p>
            </div>
        <?php else: ?>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($bookings as $booking): ?>
                    <div class="booking-card rounded-2xl overflow-hidden shadow-2xl transform hover:scale-105">
                        <div class="relative">
                            <img 
                                src="../../Asset/images/<?= htmlspecialchars($booking['image_url'] ?: 'placeholder.jpg') ?>"
                                alt="<?= htmlspecialchars($booking['title']) ?>" 
                                class="w-full h-64 object-cover"
                            >
                            <div class="absolute top-0 left-0 w-full p-4 bg-gradient-to-b from-black to-transparent">
                                <h2 class="text-white text-2xl font-bold">
                                    <?= htmlspecialchars($booking['title']) ?>
                                </h2>
                            </div>
                            <div class="ticket-badge absolute top-4 right-4 px-3 py-1 rounded-full text-white text-sm">
                                Ref: <?= $booking['ticket_id'] ?>
                            </div>
                        </div>
                        
                        <div class="p-6 text-gray-300">
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <i class="fas fa-calendar-alt text-blue-400 mr-2"></i>
                                    <span class="font-semibold">Booking Date:</span>
                                </div>
                                <div><?= date('Y-m-d H:i', strtotime($booking['booking_date'])) ?></div>

                                <div>
                                    <i class="fas fa-film text-green-400 mr-2"></i>
                                    <span class="font-semibold">Genre:</span>
                                </div>
                                <div><?= htmlspecialchars($booking['genre']) ?></div>

                                <div>
                                    <i class="fas fa-star text-yellow-400 mr-2"></i>
                                    <span class="font-semibold">Rating:</span>
                                </div>
                                <div><?= htmlspecialchars($booking['rating']) ?></div>

                                <div>
                                    <i class="fas fa-clock text-purple-400 mr-2"></i>
                                    <span class="font-semibold">Runtime:</span>
                                </div>
                                <div><?= htmlspecialchars($booking['runtime']) ?> mins</div>

                                <div>
                                    <i class="fas fa-chair text-indigo-400 mr-2"></i>
                                    <span class="font-semibold">Seats:</span>
                                </div>
                                <div><?= htmlspecialchars($booking['seats']) ?></div>

                                <div>
                                    <i class="fas fa-dollar-sign text-green-500 mr-2"></i>
                                    <span class="font-semibold">Total Price:</span>
                                </div>
                                <div>$<?= number_format($booking['total_price'], 2) ?></div>
                            </div>

                            <div class="flex justify-between items-center mt-4">
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    Screening: <?= date('Y-m-d H:i', strtotime($booking['screening_time'])) ?>
                                </span>
                                <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full text-sm">
                                    <i class="fas fa-print mr-2"></i>Print Ticket
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Optional: Add subtle animations and interactions
        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.booking-card');
            
            cards.forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'scale(1.05) translateY(-10px)';
                });
                
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'scale(1) translateY(0)';
                });
            });
        });
    </script>
</body>
</html>