    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deadpool & Wolverine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <style>
        .navbar {
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
        background-color: #0c0f27 !important;
        padding: 0.2rem !important;        /* Even smaller overall padding */
        min-height: 0;                  /* Reduced minimum height */
        }
        
        .navbar-brand {
        font-size: 1.1rem !important;      /* Slightly smaller logo text */
        padding: 0 !important;             /* Remove padding from brand */
        }
        
        .nav-link {
        padding: 0.2rem 0.8rem !important; /* Compact padding for links */
        font-size: 0.9rem !important;      /* Smaller font size for links */
        }
        
        .container {
        padding-top: 45px;                 /* Adjusted content padding */
        }
        
        @media(max-width: 991px) {
        .sidebar {
            background-color: #0c0f27;
            backdrop-filter: blur(10px);
        }
        }
    </style>
    </head>

    <body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
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
                            <a class="nav-link active" aria-current="page" href="login.html">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Navbar End -->
    <div class="container">
        <div class="content d-flex align-items-center">
        <!-- Image on the left side -->
        <div class="image-container me-4">
            <img src="deadpool.jpg" alt="Deadpool & Wolverine" class="img-fluid rounded" style="max-width: 300px;">
        </div>
        
        <!-- Movie Title and Description -->
        <div class="movie-info">
            <h1>Deadpool & Wolverine</h1>
            <p class="runtime">Runtime: 2h 7m</p>
            <p>Deadpool's peaceful existence comes crashing down when the Time Variance Authority recruits him to help safeguard the multiverse. He soon unites with his would-be pal, Wolverine, to complete the mission and save his world from an existential threat.</p>
            <p class="director">Director: Shawn Levy</p>
            <p class="cast">Cast: Ryan Reynolds, Morena Baccarin</p>
            
            <!-- Button Under the Description -->
            <button class="btn btn-primary">Book Now</button>
        </div>
        </div>
    </div>
    

            
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="seat-chart">
                            <div class="screen text-center my-3">SCREEN</div>
                            <div id="seats-container" class="d-flex flex-wrap justify-content-center"></div>
                        </div>
                    </div>

        
                    <div class="col-lg-4 mt-3 mt-lg-0">
                        <div class="receipt card p-4" style="background-color: #222; color: white; border-radius: 50px; ">
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
        
            <div id="modal">
                <div id="modal-content">
                    <p>You can only select a maximum of 10 seats per transaction.</p>
                    <button id="close-modal">Close</button>
                </div>
            </div>

        
            <?php include('../pages/config.php'); ?>
        
        <script>
            const seatsContainer = document.getElementById('seats-container');
            const selectedSeats = document.getElementById('selected-seats');
            const totalCostElement = document.getElementById('total-cost');
            const confirmBtn = document.getElementById('confirm-btn');
            const dateSelect = document.getElementById('date-select');
            const timeSelect = document.getElementById('time-select');
            const modal = document.getElementById('modal');
            const closeModalBtn = document.getElementById('close-modal');
        
            const seatPrice = 440;
            const maxSeats = 10;
            let selectedSeatsCount = 0;
        
            const seatSVG = `
                <svg viewBox="0 0 24 24">
                    <path d="M18 19H6c-1.1 0-2 .9-2 2v1h16v-1c0-1.1-.9-2-2-2zM18 10c-.55 0-1 .45-1 1v5h-1v-5c0-.55-.45-1-1-1H9c-.55 0-1 .45-1 1v5H7v-5c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1z"/>
                </svg>
            `;
        
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
        
            function handleSeatClick() {
                if (selectedSeatsCount >= maxSeats && !this.classList.contains('selected')) {
                    showModal();
                    return;
                }
                this.classList.toggle('selected');
                updateBasket();
            }
        
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
        
            function showModal() {
                modal.style.display = 'flex';
            }
        
            closeModalBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });
        
            // Confirm Button Click Event
            document.getElementById('confirm-btn').addEventListener('click', () => {
            // Get all selected seats dynamically
            const selectedSeatElements = document.querySelectorAll('.seat.selected');
            const selectedSeats = Array.from(selectedSeatElements).map(seat => ({
                row: parseInt(seat.dataset.row),
                col: parseInt(seat.dataset.col)
            }));
        
            // Validate seat selection
            if (selectedSeats.length === 0) {
                alert('Please select at least one seat.');
                return;
            }
        
            // Get date and time
            const date = document.getElementById('date-select').value;
            const time = document.getElementById('time-select').value;
        
            // Calculate total cost
            const seatPrice = 440;
            const totalCost = selectedSeats.length * seatPrice;
        
            // Prepare data for submission
            const bookingData = {
                seats: selectedSeats,
                date: date,
                time: time,
                totalCost: totalCost
            };
        
            // Send booking request
            fetch('save-tickets.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(bookingData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Success scenario
                    alert('Tickets successfully booked!');
                    
                    // Optionally, disable booked seats
                    selectedSeatElements.forEach(seat => {
                        seat.classList.add('booked');
                        seat.classList.remove('selected');
                        seat.removeEventListener('click', handleSeatClick);
                    });
        
                    // Reset basket
                    selectedSeats.innerHTML = '';
                    document.getElementById('total-cost').textContent = '0';
                    document.getElementById('confirm-btn').disabled = true;
                } else {
                    // Error scenario
                    alert('Booking failed: ' + (data.message || 'Unknown error'));
                    console.error('Booking error:', data);
                }
            })
            .catch(error => {
                // Network or parsing error
                console.error('Booking error:', error);
                alert('An error occurred while booking tickets. Please try again.');
            });
        });
        
        // Modify existing handleSeatClick to prevent booking already booked seats
        function handleSeatClick() {
            // Check if seat is already booked
            if (this.classList.contains('booked')) {
                return;
            }
        
            if (selectedSeatsCount >= maxSeats && !this.classList.contains('selected')) {
                showModal();
                return;
            }
            this.classList.toggle('selected');
            updateBasket();
        }
        
        document.addEventListener('DOMContentLoaded', () => {
            const seatsContainer = document.getElementById('seats-container');
            const seatElements = seatsContainer.querySelectorAll('.seat');
        
            // Fetch booked seats when the page loads
            fetchBookedSeats();
        
            function fetchBookedSeats() {
                const date = document.getElementById('date-select').value;
                const time = document.getElementById('time-select').value;
        
                fetch('get-booked-seats.php', {
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
                    // Mark booked seats
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
        
            // Update booked seats when date or time changes
            document.getElementById('date-select').addEventListener('change', fetchBookedSeats);
            document.getElementById('time-select').addEventListener('change', fetchBookedSeats);
        
            const seatSVG = `
                <svg viewBox="0 0 24 24">
                    <path d="M18 19H6c-1.1 0-2 .9-2 2v1h16v-1c0-1.1-.9-2-2-2zM18 10c-.55 0-1 .45-1 1v5h-1v-5c0-.55-.45-1-1-1H9c-.55 0-1 .45-1 1v5H7v-5c0-.55-.45-1-1-1H5c-.55 0-1 .45-1 1v6c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-6c0-.55-.45-1-1-1z"/>
                </svg>
            `;
        
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
        
            const selectedSeats = document.getElementById('selected-seats');
            const totalCostElement = document.getElementById('total-cost');
            const confirmBtn = document.getElementById('confirm-btn');
        
            const seatPrice = 440;
            const maxSeats = 10;
            let selectedSeatsCount = 0;
        
            function handleSeatClick() {
                // Prevent clicking booked seats
                if (this.classList.contains('booked')) {
                    return;
                }
        
                if (selectedSeatsCount >= maxSeats && !this.classList.contains('selected')) {
                    showModal();
                    return;
                }
                this.classList.toggle('selected');
                updateBasket();
            }
        
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
        
            confirmBtn.addEventListener('click', () => {
                const selectedSeatElements = document.querySelectorAll('.seat.selected');
                const selectedSeatsData = Array.from(selectedSeatElements).map(seat => ({
                    row: parseInt(seat.dataset.row),
                    col: parseInt(seat.dataset.col)
                }));
        
                const date = document.getElementById('date-select').value;
                const time = document.getElementById('time-select').value;
                const totalCost = selectedSeatsData.length * seatPrice;
        
                fetch('save-tickets.php', {
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
                        
                        // Mark booked seats
                        selectedSeatElements.forEach(seat => {
                            seat.classList.add('booked');
                            seat.classList.remove('selected');
                            seat.style.opacity = '0.3';
                            seat.style.pointerEvents = 'none';
                            seat.removeEventListener('click', handleSeatClick);
                        });
        
                        // Reset basket
                        selectedSeats.innerHTML = '';
                        totalCostElement.textContent = '0';
                        confirmBtn.disabled = true;
        
                        // Refresh booked seats
                        fetchBookedSeats();
                    } else {
                        alert('Booking failed: ' + (data.message || 'Unknown error'));
                        console.error('Booking error:', data);
                    }
                })
                .catch(error => {
                    console.error('Booking error:', error);
                    alert('An error occurred while booking tickets. Please try again.');
                });
            });
        });
        
        
        </script>
        

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>