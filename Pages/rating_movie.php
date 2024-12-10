<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Movie Ratings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Asset/css/rating-movie.css">
 
</head>
<body>
    
  <!-- Sidebar Toggle Button -->
<button class="toggle-sidebar-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>

<div class="sidebar p-3">
    <!--------------LOGO------------------>
    <a class="navbar-brand fs-4" href="home.html">
        <img src="../Asset/images/lllogo.png" alt="Royale Logo" style="height: 50px; width: auto;">
    </a>
    
    <!-- Navigation Menu -->
    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a class="nav-link" href="dashboard.html"><i class="fas fa-home"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="rating_movie.php"><i class="fas fa-chart-line"></i> Analytics</a>
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

<!---------------------------------------------------------------ADD MOVIE CONTENT---------------------------------------------------------->

<div class="main-content">
    <div class="container-fluid full-width-container">
        <div class="row g-0">
            <div class="col-12">
                <div class="full-width-image">
                    <img src="../Asset/images/movie_gross (1).png" alt="Sample Image">
                </div>
            </div>
        </div>
  
        <div class="container mt-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card mb-3 movie-card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="../Asset/images/deadpool_and_wolverine.jpg" class="img-fluid rounded-start" alt="Deadpool and Wolverine">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title movie-title">Deadpool and Wolverine</h5>
                                    <p class="card-text">Total Gross: $500M</p>
                                    <p class="card-text"><small>Day Released: 2024-01-12</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="card mb-3 movie-card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="../Asset/images/cs3.jpg" class="img-fluid rounded-start" alt="Deadpool and Wolverine">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title movie-title">Wicked</h5>
                                    <p class="card-text">Total Gross: $40M</p>
                                    <p class="card-text"><small>Day Released: 2024-25-11</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                    <div class="col-md-4">
                        <div class="card mb-3 movie-card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="../Asset/images/cs2.jpg" class="img-fluid rounded-start" alt="Deadpool and Wolverine">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title movie-title">We Live in Time</h5>
                                        <p class="card-text">Total Gross: $30M</p>
                                        <p class="card-text"><small>Day Released: 2024-12-10</small></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                <div class="col-md-4">
                    <div class="card mb-3 movie-card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="../Asset/images/cs1.jpg" class="img-fluid rounded-start" alt="Deadpool and Wolverine">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title movie-title">SANA: Let me hear</h5>
                                    <p class="card-text">Total Gross: $5M</p>
                                    <p class="card-text"><small>Day Released: 2024-11-12</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="card mb-3 movie-card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="../Asset/images/ns3.jpg" class="img-fluid rounded-start" alt="Deadpool and Wolverine">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title movie-title">Oppenheimer</h5>
                                    <p class="card-text">Total Gross: $90M</p>
                                    <p class="card-text"><small>Day Released: 2024-05-11</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="col-md-4">
                    <div class="card mb-3 movie-card">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="../Asset/images/ns5.jpg" class="img-fluid rounded-start" alt="Deadpool and Wolverine">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title movie-title">The Nun 2</h5>
                                    <p class="card-text">Total Gross: $10M</p>
                                    <p class="card-text"><small>Day Released: 2024-17-11</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        
            </div> 
        </div> 
        

<script>
    function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar'); 
    sidebar.classList.toggle('open'); 
}
    </script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
