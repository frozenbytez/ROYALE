<?php
    include('../pages/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dfvdfvdfv</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
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
            padding: 0.2rem !important;
            min-height: 0;
        }
        
        .navbar-brand {
            font-size: 1.1rem !important;
            padding: 0 !important;
        }
        
        .nav-link {
            padding: 0.2rem 0.8rem !important;
            font-size: 0.9rem !important;
        }
        
        .container {
            padding-top: 45px;
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
            <a class="navbar-brand fs-4" href="../index.php">
                <img src="../stylesheet/images/logo.png" alt="Logo" style="height: 40px;">
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
                            <a class="nav-link" href="nowshowing.php">Now Showing</a>
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
                <img src="../pages/images/movie_674ef1b931fc77.56792135.jpg" alt="dfvdfvdfv" class="img-fluid rounded" style="max-width: 300px;">
            </div>
            
            <!-- Movie Title and Description -->
            <div class="movie-info">
                <h1>dfvdfvdfv</h1>
                <p class="runtime">Runtime: vdfvdvdfd</p>
                <p>dfvdvd</p>
                <p class="director">Director: fdv</p>
                <p class="cast">Cast: dfvd</p>
                
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
                <div class="receipt card p-4" style="background-color: #222; color: white; border-radius: 50px;">
                    <h3 class="text-center mb-3">Your Basket</h3>

                    <div class="mb-3">
                        <label for="date-select" class="form-label">Select Date:</label>
                        <select id="date-select" class="form-select"></select>
                    </div>

                    <div class="mb-3">
                        <label for="time-select" class="form-label">Select Time:</label>
                        <select id="time-select" class="form-select">
                            <option value="19:55">07:55 PM</option>
                            <option value="19:58">07:58 PM</option>
                            <option value="19:59">07:59 PM</option>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script.js"></script>
</body>
</html>