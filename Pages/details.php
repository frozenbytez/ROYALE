<?php
session_start();
require('libs/fpdf.php'); 


$loggedIn = isset($_SESSION['user']) || isset($_SESSION['admin']);
$first_name = $_SESSION['user'] ?? $_SESSION['admin'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate_receipt'])) {
 
    $pricePerSeat = 440; 
    
    $movieTitle = "Deadpool & Wolverine";
    $cinemaName = "Royale Cinema";
    $cinemaRoom = "1";
    $showtime = htmlspecialchars($_POST['showtime']);
    $selectedSeats = htmlspecialchars($_POST['seats']); 
    
  
    $seatArray = explode(',', $selectedSeats); 
    $totalSeats = count($seatArray); 
    $totalCost = $pricePerSeat * $totalSeats; 

    $paymentMethod = "Credit Card"; 

    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    
  
    $pdf->SetTextColor(230, 126, 34);
    $pdf->Cell(0, 10, "RECEIPT", 0, 1, 'C');
    $pdf->Ln(5);

    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(52, 73, 94); 
    $pdf->Cell(0, 10, "Royale Cinema", 0, 1, 'C');
    $pdf->Cell(0, 10, "143 Royale Street, North Caloocan City", 0, 1, 'C');
    $pdf->Ln(5);


    $pdf->SetFont('Arial', '', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, 0, str_repeat('*', 40), 0, 1, 'C');
    $pdf->Ln(5);


    $pdf->SetFont('Arial', '', 12);
    $details = [
        "Cinema Name" => $cinemaName,
        "Cinema Room" => $cinemaRoom,
        "Movie Title" => $movieTitle,
        "Showtime" => $showtime,
        "Seats" => $selectedSeats,
        "Price per Seat" => "PHP " . number_format($pricePerSeat, 2) . " x " . $totalSeats,
    ];

    foreach ($details as $key => $value) {
        $pdf->Cell(50, 10, $key, 0, 0);
        $pdf->Cell(5, 10, ":", 0, 0);
        $pdf->Cell(0, 10, $value, 0, 1);
    }
    $pdf->Ln(5);


    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(50, 10, "Total", 0, 0);
    $pdf->Cell(5, 10, ":", 0, 0);
    $pdf->Cell(0, 10, "PHP " . number_format($totalCost, 2), 0, 1);
    $pdf->Ln(5);


    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(52, 73, 94);
    $pdf->Cell(0, 10, "Payment Method: " . $paymentMethod, 0, 1);
    $pdf->Ln(5);

    // Divider
    $pdf->Cell(0, 0, str_repeat('*', 40), 0, 1, 'C');
    $pdf->Ln(10);

    // Footer
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->SetTextColor(7, 21, 93); // Blue
    $pdf->Cell(0, 10, "Thank you for choosing Royale Cinema! Enjoy the movie!", 0, 1, 'C');

    // Save PDF to the receipts folder with a unique file name based on the current date and time
    $currentDateTime = date('Y-m-d_H-i-s'); 
    $receiptsDir = 'receipts'; 
    if (!is_dir($receiptsDir)) {
        mkdir($receiptsDir, 0777, true); 
    }
    $filePath = "$receiptsDir/receipt_$currentDateTime.pdf";
    $pdf->Output('F', $filePath);

   
    echo json_encode(['success' => true, 'file' => $filePath]);
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../Asset/css/details.css">

  <script>
    document.addEventListener('DOMContentLoaded', () => {
    const confirmBtn = document.getElementById('confirm-btn');
    
    confirmBtn.addEventListener('click', () => {
        const seats = Array.from(document.querySelectorAll('.seat.selected'))
            .map(seat => `${seat.dataset.row}-${seat.dataset.col}`).join(', ');
        const totalCost = document.getElementById('total-cost').innerText;
        const showtime = document.getElementById('time-select').value;

        fetch('details.php', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                'generate_receipt': true,
                'seats': seats,
                'total_cost': totalCost,
                'showtime': showtime
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.open(data.file, '_blank');
            } else {
                alert('Error generating receipt!');
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('There was an error generating the receipt. Please try again.');
        });
    });
});
    </script>

  
</head>

<body>
  <!-- Navbar Start -->
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
                <button 
                type="button" 
                class="btn-close btn-close-white shadow-none" 
                data-bs-dismiss="offcanvas" 
                aria-label="Close"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column p-4">
                <ul class="navbar-nav justify-content-center justify-content-lg-end align-items-center fs-5 flex-grow-1 pe-3">
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="../home.php">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="nowshowing.html">Now Showing</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="comingSoon.html">Upcoming</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item mx-2">
                    <?php if ($loggedIn): ?>
                        <a class="nav-link" href="logout.php">Logout (<?php echo htmlspecialchars($first_name); ?>)</a>
                    <?php else: ?>
                        <a class="nav-link" href="../login.php">Login</a>
                    <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

  <!-- Navbar End -->

  <div class="movie-title">
    <div class="content">
      <h1>Deadpool & Wolverine</h1>
      <div class="movie-info">
        <p><i class="fas fa-clock"></i><strong>Runtime:</strong> 2h 7m</p>
                    <p>
                        Deadpool's peaceful existence comes crashing down when the Time Variance Authority recruits him 
                        to help safeguard the multiverse. He soon unites with his would-be pal, Wolverine, to complete 
                        the mission and save his world from an existential threat.
                    </p>
                    <p><i class="fas fa-film"></i><strong>Director:</strong> Shawn Levy</p>
                    <p><i class="fas fa-users"></i><strong>Cast:</strong> Ryan Reynolds, Morena Baccarin</p>
      </div>
    </div>
    
    <div class="poster-section">
    <img src="../Asset/images/ns1.jpg" alt="Movie Poster" class="poster">
    <a href="https://youtu.be/__2bjWbetsA?si=2lgrCc3CVBDS5gCa" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#venomTrailerModal" >Watch trailer</a>
</div>

  </div>
  <div class="modal fade" id="venomTrailerModal" tabindex="-1" aria-labelledby="venomTrailerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="venomTrailerModalLabel">Trailer - Venom : The Last Dance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="ratio ratio-16x9">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/__2bjWbetsA?si=2lgrCc3CVBDS5gCa" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="seat-chart">
                <div class="screen text-center my-3">SCREEN</div>
                <div id="seats-container" class="d-flex flex-wrap justify-content-center"></div>
                <div class="text-center mt-3">
                <button type="button" class="btn btn-sm btn-available">Available Seat</button>
                <button type="button" class="btn btn-sm btn-taken">Taken</button>
                <button type="button" class="btn btn-sm btn-selected">Selected Seat</button>

                </div>
            </div>
        </div>

        <div class="col-lg-4 mt-3 mt-lg-0">
            <div class="receipt card p-4" style="background-color: #222; color: white;">
                <h3 class="text-center mb-3">Your Basket</h3>

                <div class="mb-3">
                    <label for="date-select" class="form-label">Select Date:</label>
                    <select id="date-select" class="form-select">
                        <option value="2024-11-13">November 13, 2024</option>
                        <option value="2024-11-14">November 14, 2024</option>
                        <option value="2024-11-15">November 15, 2024</option>
                        <option value="2024-11-16">November 16, 2024</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="time-select" class="form-label">Select Time:</label>
                    <select id="time-select" class="form-select">
                        <option value="13:00">1:00 PM</option>
                        <option value="15:30">3:30 PM</option>
                        <option value="18:00">6:00 PM</option>
                        <option value="20:30">8:30 PM</option>
                    </select>
                </div>

                <ul id="selected-seats" class="list-unstyled mb-3"></ul>
                <p class="total-cost">Total Cost: ₱<span id="total-cost">0</span></p>
                <button class="btn btn-primary w-100" id="confirm-btn" disabled>Confirm Selection</button>
            </div>
        </div>
    </div>
</div>


<div id="modal1"> 
  <div id="modal-content">
      <p>You can only select a maximum of 10 seats per transaction.</p>
      <button id="close-modal">Close</button>
  </div>
</div>
<?php include('../Asset/connection/config.php'); ?>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const seatsContainer = document.getElementById('seats-container');
    const selectedSeats = document.getElementById('selected-seats');
    const totalCostElement = document.getElementById('total-cost');
    const confirmBtn = document.getElementById('confirm-btn');
    const dateSelect = document.getElementById('date-select');
    const timeSelect = document.getElementById('time-select');
    const modal = document.getElementById('modal1');
    const closeModalBtn = document.getElementById('close-modal');

    const seatPrice = 440;
    const maxSeats = 10;
    let selectedSeatsCount = 0;

    const seatSVG = `
      <svg viewBox="0 0 24 24">
        <path d="M18 19H6c-1.1 0-2 .9-2 2v1h16v-1c0-1.1-.9-2-2-2zM18 10c-.55 0-1 .45-1 1v5h-1v-5c0-.55-.45-1-1-1H9c-.55 0-1 .45-1 1v5H7v-5c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1z"/>
      </svg>
    `;

    // Create seat grid
    const rows = 5;
    const columns = 10;
    for (let row = 1; row <= rows; row++) {
      const rowDiv = document.createElement('div');
      for (let col = 1; col <= columns; col++) {
        const seat = document.createElement('div');
        seat.classList.add('seat');
        seat.dataset.row = row;
        seat.dataset.col = col;
        seat.innerHTML = seatSVG; 
        seat.addEventListener('click', handleSeatClick);
        rowDiv.appendChild(seat);
      }
      seatsContainer.appendChild(rowDiv);
    }

    // Fetch and mark booked seats
    function fetchBookedSeats() {
      const date = dateSelect.value;
      const time = timeSelect.value;

      fetch('../Asset/connection/get-booked-seats.php', {  
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          date: date,
          time: time
        })
      })
      .then(response => response.json())
      .then(bookedSeats => {
        bookedSeats.forEach(seat => {
          const bookedSeat = document.querySelector(
            `.seat[data-row="${seat.seat_row}"][data-col="${seat.seat_col}"]`
          );
          if (bookedSeat) {
            bookedSeat.classList.add('booked');
            bookedSeat.style.opacity = '0.3';
            bookedSeat.style.pointerEvents = 'none';
          }
        });
      })
      .catch(error => {
        console.error('Error fetching booked seats:', error);
      });
    }

    // Seat click handler
    function handleSeatClick() {
      if (this.classList.contains('booked')) return;

      if (selectedSeatsCount >= maxSeats && !this.classList.contains('selected')) {
        modal.style.display = 'flex';
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

    // Close seat limit modal
    closeModalBtn.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    // Confirm booking
    confirmBtn.addEventListener('click', () => {
      const selectedSeatElements = document.querySelectorAll('.seat.selected');
      const selectedSeatsData = Array.from(selectedSeatElements).map(seat => ({
        row: parseInt(seat.dataset.row),
        col: parseInt(seat.dataset.col)
      }));

      const date = dateSelect.value;
      const time = timeSelect.value;
      const totalCost = selectedSeatsData.length * seatPrice;

      fetch('../Asset/connection/save-tickets.php', {  
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          seats: selectedSeatsData,
          date: date,
          time: time,
          totalCost: totalCost
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

    // Update booked seats on date/time change
    dateSelect.addEventListener('change', fetchBookedSeats);
    timeSelect.addEventListener('change', fetchBookedSeats);

    // Initial fetch of booked seats
    fetchBookedSeats();
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>