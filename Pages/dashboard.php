<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Asset/css/dashboard.css">
    <title>Admin Panel - Dashboard</title>


</head>
<body>
   <!--------------------------------------------------------------- Sidebar Toggle Button -------------------------------------------------------->
  
  <button class="toggle-sidebar-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
  </button>

  <!----------------------------------------------------------------------------------------------------------------------------------------------->

  <!---------------------------------------------------------------------SIDE BAR------------------------------------------------------------------>
  
  <div class="sidebar p-3">
    <!--------------LOGO------------------>
    <a class="navbar-brand fs-4" href="home.html">
        <img src="../Asset/images/lllogo.png" alt="Royale Logo" style="height: 50px; width: auto;">
    </a>
    
    <!-- Navigation Menu -->
    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a class="nav-link active" href="dashboard.html"><i class="fas fa-home"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="rating_movie.php"><i class="fas fa-chart-line"></i> Analytics</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="manageMoviesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-film"></i> Manage Movies
            </a>
            <ul class="dropdown-menu" aria-labelledby="manageMoviesDropdown">
                <li><a class="dropdown-item" href="add_movie.php">Add Movies</a></li>
                <li><a class="dropdown-item" href="update_movie.php">Update Movies</a></li>
                <li><a class="dropdown-item" href="delete_movie.php">Delete Movies</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="available2.html"><i class="fas fa-play"></i> Available Movies</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#"><i class="fas fa-calendar-alt"></i> Edit Screening</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
</div>

    

    <div class="main-content">
        <div class="d-flex align-items-center mb-4">
            <img src="../Asset/images/profile.gif" alt="Profile Picture" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover; margin-right: 15px;">
            <div>
                <p class="m-0" style="font-size: 18px; font-weight: 600; color: white;">Abegail Araneta</p>
                <small style="color: #ffffff;">Manager</small>
            </div>
        </div>

        <h1 id="dashboard-text">Royale Cinema Dashboard</h1>

<!--------------------------------------------------------------------CONTAINER FOR SALES---------------------------------------------------------->
        <div class="dashboard-cards-container">
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="dashboard-card revenue-card">
                        <div class="card-content">
                            <div class="icon">
                                <i id="revenue-icon" class="fas fa-wallet"></i>
                            </div>
                            <div class="text">
                                <h3>Total Revenue</h3>
                                <p>₱100,000</p>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Time Period
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Week</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="dashboard-card customer-card">
                        <div class="card-content">
                            <div class="icon">
                                <i id="customers-icon" class="fas fa-users"></i>
                            </div>
                            <div class="text">
                                <h3>Total Customers</h3>
                                <p>369</p>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Time Period
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Week</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="dashboard-card movies-card">
                        <div class="card-content">
                            <div class="icon">
                                <i id="movie-icon" class="fas fa-film"></i>
                            </div>
                            <div class="text">
                                <h3>Available Movies</h3>
                                <p>10</p>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Time Period
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                                <li><a class="dropdown-item" href="#">This Year</a></li>
                                <li><a class="dropdown-item" href="#">This Month</a></li>
                                <li><a class="dropdown-item" href="#">This Week</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 id="popular-movies-text" class="mt-5">
            <span id="popular-text">POPULAR</span>
            <span id="movie-text">MOVIES</span>
        </h3>
        
        <div class="row mt-3">
            <div class="col-md-8">
                <div class="popular-movies-container">
                    <div class="popular-movies-left">
                        <img src="../Asset/images/venom.png" alt="Featured Movie">
                    </div>
                    <div class="popular-movies-right">
                        <img src="../Asset/images/cs1.jpg" alt="Movie 1">
                        <img src="../Asset/images/cs2.jpg" alt="Movie 2">
                        <img src="../Asset/images/cs3.jpg" alt="Movie 3">
                        <img src="../Asset/images/cs4.jpg" alt="Movie 4">
                    </div>
                </div>
            </div>
        
            <div class="col-md-4">
                <div class="dashboard-card ticket-sold-card tickets-card">
                    <div class="icon-wrapper">
                        <i id="tickets-icon" class="fas fa-ticket-alt"></i>
                    </div>
                    <div class="text">
                        <h3>Total Tickets Sold</h3>
                        <p>512</p>
                    </div>
                    <div class="ticket-dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Select Time Period
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Week</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

<!---------------------------------------------------------------------SCRIPT---------------------------------------------------------------------->
        <script>
            function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar'); 
            sidebar.classList.toggle('open'); 
        }
            </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>