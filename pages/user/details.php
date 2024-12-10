<?php
session_start();  // Start the session to use session variables
include('../../assets/php/config.php');  // Include database connection

$loggedIn = isset($_SESSION['user']) || isset($_SESSION['admin']);
$first_name = $_SESSION['user'] ?? $_SESSION['admin'] ?? '';

// Fetch the movie ID from the URL
if (isset($_GET['movie_id'])) {
    $movie_id = $_GET['movie_id'];

    // Query the database to fetch details for the selected movie
    $query = "SELECT * FROM movies WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $movie_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a movie was found
    if ($result->num_rows > 0) {
        $movie = $result->fetch_assoc();  // Fetch movie details
    } else {
        echo "Movie not found!";
        exit;
    }
} else {
    echo "No movie selected!";
    exit;
}

// Access the movie details
$movie_title = $movie['title'];
$movie_runtime = $movie['runtime'];
$movie_description = $movie['description'];
$movie_director = $movie['director'];
$movie_cast = $movie['cast'];
$movie_trailer = $movie['trailer_link'];
$movie_image = isset($movie['image_url']) ? $movie['image_url'] : 'default_image.jpg';

$startDate = new DateTime($movie['start_date']);
$endDate = new DateTime($movie['end_date']);
$dateInterval = new DateInterval('P1D');
$dateRange = new DatePeriod($startDate, $dateInterval, $endDate->modify('+1 day'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/user/style.css">
    <style>
    .seats-container.loading {
    opacity: 0.5;
    pointer-events: none;
}
.seats-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  padding: 20px;
  background-color: #f4f4f4;
  border-radius: 10px;
}

.seat-row {
  display: flex;
  align-items: center;
  width: 100%;
  max-width: 800px;
}

.row-label {
  width: 30px;
  text-align: right;
  margin-right: 15px;
  font-weight: bold;
  color: #666;
}

.seat-row-container {
  display: flex;
  align-items: center;
  flex-grow: 1;
}

.seat-half {
  display: flex;
  gap: 10px;
}

.middle-gap {
  width: 50px;
  height: 1px;
}

.seat {
  width: 30px;
  height: 30px;
  cursor: pointer;
  transition: transform 0.2s;
}

.seat:hover {
  transform: scale(1.1);
}

.seat.selected {
  fill: #4CAF50;
}

.seat.booked {
  opacity: 0.3;
  cursor: not-allowed;
}

.screen {
  width: 80%;
  height: 10px;
  background-color: #333;
  margin: 20px auto;
  border-radius: 5px;
}
    </style>
    <title><?php echo htmlspecialchars($movie_title); ?> - Movie Details</title>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fs-4" href="home.html">
                <img src="stylesheet/images/logo.png" alt="Logo" style="height: 40px;">
            </a>
            <button class="navbar-toggler shadow-none border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="sidebar offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header text-white border-bottom">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">LOGO</h5>
                    <button type="button" class="btn-close btn-close-white shadow-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body d-flex flex-column p-4">
                    <ul class="navbar-nav justify-content-center justify-content-lg-end align-items-center fs-5 flex-grow-1 pe-3">
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="pages/nowshowing.php">Now Showing</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="comingSoon.php">Upcoming</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="contact.php">Contact Us</a>
                        </li>
                        <li class="nav-item mx-2">
                            <?php if ($loggedIn): ?>
                                <a class="nav-link" href="../guest/logout.php">Logout (<?php echo htmlspecialchars($first_name); ?>)</a>
                            <?php else: ?>
                                <a class="nav-link" href="../guest/login.php">Login</a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</head>
<body>
    <div class="movie-title">
        <div class="content">
            <h1><?php echo htmlspecialchars($movie_title); ?></h1>
            <div class="movie-info">
                <p><i class="fas fa-clock"></i><strong>Runtime:</strong> <?php echo htmlspecialchars($movie_runtime); ?></p>
                <p><?php echo htmlspecialchars($movie_description); ?></p>
                <p><i class="fas fa-film"></i><strong>Director:</strong> <?php echo htmlspecialchars($movie_director); ?></p>
                <p><i class="fas fa-users"></i><strong>Cast:</strong> <?php echo htmlspecialchars($movie_cast); ?></p>
            </div>
        </div>

        <div class="poster-section">
            <img src="../../assets/images/<?php echo htmlspecialchars($movie_image); ?>" alt="Movie Poster" class="poster">
            <a href="<?php echo htmlspecialchars($movie_trailer); ?>" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#trailerModal">Watch trailer</a>
        </div>
    </div>

    <!-- Trailer Modal -->
    <div class="modal fade" id="trailerModal" tabindex="-1" aria-labelledby="trailerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trailerModalLabel">Trailer - <?php echo htmlspecialchars($movie_title); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo basename($movie_trailer); ?>" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Seat Selection Section -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="seat-chart">
                    <div class="screen text-center my-3">SCREEN</div>
                    <div id="seats-container" class="d-flex flex-wrap justify-content-center"></div>
                </div>
            </div>

            <div class="col-lg-4 mt-3 mt-lg-0">
                <div class="receipt card p-4" style="background-color: #222; color: white; border-radius: 50px;">
                    <h3 class="text-center mb-3">Your Basket</h3>

                    <!-- Date Selection -->
                    <div class="mb-3">
                        <label for="date-select" class="form-label">Select Date:</label>
                        <select id="date-select" class="form-select">
                            <?php
                            foreach ($dateRange as $date) {
                                echo '<option value="' . $date->format('Y-m-d') . '">' . $date->format('F j, Y') . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Time Selection -->
                    <div class="mb-3">
                        <label for="time-select" class="form-label">Select Time:</label>
                        <select id="time-select" class="form-select">
                            <?php
                            if (!empty($movie['time1'])) {
                                echo '<option value="' . $movie['time1'] . '">' . date("g:i A", strtotime($movie['time1'])) . '</option>';
                            }
                            if (!empty($movie['time2'])) {
                                echo '<option value="' . $movie['time2'] . '">' . date("g:i A", strtotime($movie['time2'])) . '</option>';
                            }
                            if (!empty($movie['time3'])) {
                                echo '<option value="' . $movie['time3'] . '">' . date("g:i A", strtotime($movie['time3'])) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <ul id="selected-seats" class="list-unstyled mb-3"></ul>
                    <p class="total-cost">Total Cost: ₱<span id="total-cost">0</span></p>
                    <button class="btn btn-primary w-100" id="confirm-btn" disabled>Confirm Selection</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<script>
 document.addEventListener('DOMContentLoaded', () => {
    const seatsContainer = document.getElementById('seats-container');
    const selectedSeats = document.getElementById('selected-seats');
    const totalCostElement = document.getElementById('total-cost');
    const confirmBtn = document.getElementById('confirm-btn');
    const dateSelect = document.getElementById('date-select');
    const timeSelect = document.getElementById('time-select');

    const seatPrice = 440;
    const maxSeats = 10;
    let selectedSeatsCount = 0;

    const movieId = <?php echo $movie_id; ?>; // Pass the movie ID from PHP to JavaScript

    const seatSVG = 
      '<svg viewBox="0 0 24 24"><path d="M18 19H6c-1.1 0-2 .9-2 2v1h16v-1c0-1.1-.9-2-2-2zM18 10c-.55 0-1 .45-1 1v5h-1v-5c0-.55-.45-1-1-1H9c-.55 0-1 .45-1 1v5H7v-5c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1z"/></svg>';

    // Create seat grid - KEEP YOUR ORIGINAL SEAT CREATION LOGIC
    // Replace the existing seat creation logic with this
const rows = 5;
const columns = 10;
for (let row = 1; row <= rows; row++) {
  const rowDiv = document.createElement('div');
  rowDiv.classList.add('seat-row');
  
  // Add row letter
  const rowLabelDiv = document.createElement('div');
  rowLabelDiv.classList.add('row-label');
  rowLabelDiv.textContent = String.fromCharCode(64 + row);
  rowDiv.appendChild(rowLabelDiv);

  // Create a container for seats with a gap in the middle
  const seatContainer = document.createElement('div');
  seatContainer.classList.add('seat-row-container');

  // First half of seats
  const firstHalf = document.createElement('div');
  firstHalf.classList.add('seat-half');
  for (let col = 1; col <= columns/2; col++) {
    const seat = createSeat(row, col);
    firstHalf.appendChild(seat);
  }

  // Middle gap
  const middleGap = document.createElement('div');
  middleGap.classList.add('middle-gap');

  // Second half of seats
  const secondHalf = document.createElement('div');
  secondHalf.classList.add('seat-half');
  for (let col = columns/2 + 1; col <= columns; col++) {
    const seat = createSeat(row, col);
    secondHalf.appendChild(seat);
  }

  // Assemble the row
  seatContainer.appendChild(firstHalf);
  seatContainer.appendChild(middleGap);
  seatContainer.appendChild(secondHalf);
  rowDiv.appendChild(seatContainer);
  
  seatsContainer.appendChild(rowDiv);
}

// Seat creation helper function
function createSeat(row, col) {
  const seat = document.createElement('div');
  seat.classList.add('seat');
  seat.dataset.row = row;
  seat.dataset.col = col;
  seat.innerHTML = seatSVG; 
  seat.addEventListener('click', handleSeatClick);
  return seat;
}           

    // Fetch and mark booked seats
    function fetchBookedSeats() {
        // Reset all seats before fetching new booking status
        document.querySelectorAll('.seat').forEach(seat => {
            seat.classList.remove('booked');
            seat.style.opacity = '1';
            seat.style.pointerEvents = 'auto';
        });

        const date = dateSelect.value;
        const time = timeSelect.value;

        fetch('../../assets/php/get-booked-seats.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({ 
        movie_id: movieId, 
        date: dateSelect.value, 
        time: timeSelect.value 
    })
})
.then(response => {
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json();
})
.then(data => {
    if (data.success) {
        data.bookedSeats.forEach(seat => {
            const bookedSeat = document.querySelector(
                `.seat[data-row="${seat.seat_row}"][data-col="${seat.seat_col}"]`
            );
            if (bookedSeat) {
                bookedSeat.classList.add('booked');
                bookedSeat.style.opacity = '0.3';
                bookedSeat.style.pointerEvents = 'none';
            }
        });
    } else {
        console.error('Failed to fetch booked seats:', data.message);
        alert('Failed to load seat availability: ' + data.message);
    }
})
.catch(error => {
    console.error('Error fetching booked seats:', error);
    alert('An error occurred while fetching seat availability.');
})
    }

    // Seat click handler
    function handleSeatClick() {
      if (this.classList.contains('booked')) return;

      if (selectedSeatsCount >= maxSeats && !this.classList.contains('selected')) {
        alert('You can only select up to ' + maxSeats + ' seats.');
        return;
      }

      this.classList.toggle('selected');
      updateBasket();
    }

    // Update basket details
    function updateBasket() {
        const selected = Array.from(document.querySelectorAll('.seat.selected'));
        selectedSeats.innerHTML = '';
        selectedSeatsCount = selected.length;

        selected.forEach(seat => {
            const seatInfo = document.createElement('li');
            seatInfo.textContent = `Row ${seat.dataset.row}, Seat ${seat.dataset.col}`;
            selectedSeats.appendChild(seatInfo);
        });

        const totalCost = selectedSeatsCount * seatPrice;
        totalCostElement.textContent = totalCost;
        confirmBtn.disabled = selectedSeatsCount === 0;
    }

    // Confirm booking
    confirmBtn.addEventListener('click', () => {
        const selectedSeatElements = document.querySelectorAll('.seat.selected');
        const selectedSeatsData = Array.from(selectedSeatElements).map(seat => ({
            row: parseInt(seat.dataset.row),
            col: parseInt(seat.dataset.col)
        }));

        const date = dateSelect.value;
        const time = timeSelect.value;

        fetch('../../assets/php/save-tickets.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                movie_id: movieId,
                date,
                time,
                seats: selectedSeatsData
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Tickets successfully booked!');
                selectedSeatElements.forEach(seat => {
                    seat.classList.add('booked');
                    seat.classList.remove('selected');
                    seat.style.opacity = '0.3';
                    seat.style.pointerEvents = 'none';
                });

                selectedSeats.innerHTML = '';
                totalCostElement.textContent = '0';
                confirmBtn.disabled = true;
                
                // Refresh booked seats after successful booking
                fetchBookedSeats();
            } else {
                alert('Booking failed: ' + (data.message || 'Unknown error'));
            }
        })
        .catch(error => {
            console.error('Booking error:', error);
            alert('An error occurred while booking tickets. Please try again.');
        });
    });

    // Add event listeners for date and time changes to refresh booked seats
    dateSelect.addEventListener('change', fetchBookedSeats);
    timeSelect.addEventListener('change', fetchBookedSeats);

    // Initial fetch of booked seats
    fetchBookedSeats();
});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>