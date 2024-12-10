<?php
include('../Asset/connection/config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $runtime = mysqli_real_escape_string($conn, $_POST['runtime']);
    $director = mysqli_real_escape_string($conn, $_POST['director']);
    $cast = mysqli_real_escape_string($conn, $_POST['cast']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);
    $genre = mysqli_real_escape_string($conn, $_POST['genre']);
    $trailer_link = mysqli_real_escape_string($conn, $_POST['trailer_link']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);
    $time1 = mysqli_real_escape_string($conn, $_POST['time1']);
    $time2 = mysqli_real_escape_string($conn, $_POST['time2']);
    $time3 = mysqli_real_escape_string($conn, $_POST['time3']);

     $cinema = intval($_POST['cinema']); 
        $cinema_check_query = "SELECT * FROM movies WHERE cinema = $cinema AND status = 'nowshowing'";
        $cinema_check_result = mysqli_query($conn, $cinema_check_query);
        if (mysqli_num_rows($cinema_check_result) > 0) {
            echo "Error: Cinema $cinema already has a movie assigned. Please choose a different cinema.";
        } else {

    $image_url = ''; 
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = mysqli_real_escape_string($conn, $_FILES['image']['name']); 
        $image_tmp = $_FILES['image']['tmp_name'];
        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_new_name = uniqid('movie_', true) . '.' . $image_ext;
        $image_dir = '../Asset/images/' . $image_new_name;

        if (!is_dir('../Asset/images')) {
            mkdir('../Asset/images', 0777, true); 
        }

       
        if (move_uploaded_file($image_tmp, $image_dir)) {
            $image_url = $image_new_name; 
        } else {
            echo "Error uploading image."; 
        }
    }

  
       $query = "INSERT INTO movies (title, status, image_url, trailer_link, runtime, description, director, cast, rating, genre, start_date, end_date, time1, time2, time3, cinema)
       VALUES ('$title', '$status', '$image_url', '$trailer_link', '$runtime', '$description', '$director', '$cast', '$rating', '$genre', '$start_date', '$end_date', '$time1', '$time2', '$time3', $cinema)";


if (mysqli_query($conn, $query)) {
    $filename = preg_replace('/[^a-zA-Z0-9_]/', '_', strtolower($title)) . '.php';
    $filepath = '../user/movie_details/' . $filename;


       
        $file_content = '<?php
    include(\'../pages/config.php\');
 // Get movie details from the database
    $movie_title = "' . htmlspecialchars($title) . '";
    $stmt = $conn->prepare("SELECT * FROM movies WHERE title = ?");
    $stmt->bind_param("s", $movie_title);
    $stmt->execute();
    $result = $stmt->get_result();
    $movie = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/guest/details.css">
    <title><?= htmlspecialchars($movie["title"]) ?></title>
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

    <div class="movie-title">
        <div class="content">
            <h1><?= htmlspecialchars($movie["title"]) ?></h1>
            <div class="movie-info">
                <p><i class="fas fa-clock"></i><strong>Runtime:</strong> <?= htmlspecialchars($movie["runtime"]) ?></p>
                <p><?= htmlspecialchars($movie["description"]) ?></p>
                <p><i class="fas fa-film"></i><strong>Director:</strong> <?= htmlspecialchars($movie["director"]) ?></p>
                <p><i class="fas fa-users"></i><strong>Cast:</strong> <?= htmlspecialchars($movie["cast"]) ?></p>
            </div>
        </div>
        
        <div class="poster-section">
            <img src="../../../assets/images/<?= htmlspecialchars($movie["image_url"]) ?>" alt="<?= htmlspecialchars($movie["title"]) ?>" class="poster">
            <a href="<?= htmlspecialchars($movie["trailer_link"]) ?>" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#trailerModal">Watch trailer</a>
        </div>
    </div>

    <!-- Trailer Modal -->
    <div class="modal fade" id="trailerModal" tabindex="-1" aria-labelledby="trailerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="trailerModalLabel">Trailer - <?= htmlspecialchars($movie["title"]) ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe width="560" height="315" src="<?= htmlspecialchars($movie["trailer_link"]) ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
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
                </div>
            </div>

            <div class="col-lg-4 mt-3 mt-lg-0">
                <div class="receipt card p-4" style="background-color: #222; color: white; border-radius: 50px;">
                    <h3 class="text-center mb-3">Your Basket</h3>

                    <div class="mb-3">
                        <label for="date-select" class="form-label">Select Date:</label>
                        <select id="date-select" class="form-select">
                            <option value="<?= htmlspecialchars($movie["start_date"]) ?>"><?= date("F j, Y", strtotime($movie["start_date"])) ?></option>
                            <option value="<?= htmlspecialchars($movie["end_date"]) ?>"><?= date("F j, Y", strtotime($movie["end_date"])) ?></option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="time-select" class="form-label">Select Time:</label>
                        <select id="time-select" class="form-select">
                            <option value="<?= htmlspecialchars($movie["time1"]) ?>"><?= date("h:i A", strtotime($movie["time1"])) ?></option>
                            <option value="<?= htmlspecialchars($movie["time2"]) ?>"><?= date("h:i A", strtotime($movie["time2"])) ?></option>
                            <option value="<?= htmlspecialchars($movie["time3"]) ?>"><?= date("h:i A", strtotime($movie["time3"])) ?></option>
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

    <script src="../../../assets/js/details.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>';



        
 if (file_put_contents($filepath, $file_content)) {
    echo "Movie added successfully and page generated!";
} else {
    echo "Movie added, but failed to generate page.";
}
} else {
echo "Error adding movie: " . mysqli_error($conn);
}
}

}

$status_filter = isset($_POST['status']) ? $_POST['status'] : 'nowshowing'; // Default to 'nowshowing'
$query = "SELECT id, title, genre, runtime, start_date, status FROM movies WHERE status = '$status_filter' ORDER BY start_date";
$result = mysqli_query($conn, $query);
?>

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
    <title>Admin Dashboard - Add Movie</title>
    <link rel="stylesheet" href="../Asset/css/add_movie.css">


    
</head>
<body>

<button class="toggle-sidebar-btn" onclick="toggleSidebar()">
    <i class="fas fa-bars"></i>
</button>


<div class="sidebar p-3">
    <a class="navbar-brand fs-4" href="home.html">
        <img src="../Asset/images/lllogo.png" alt="Royale Logo" style="height: 50px; width: auto;">
    </a>
    
    <ul class="nav flex-column mt-4">
        <li class="nav-item">
            <a class="nav-link" href="dashboard.html"><i class="fas fa-home"></i> Dashboard</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="rating_movie.php"><i class="fas fa-chart-line"></i> Analytics</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" id="manageMoviesDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
                    <img src="../Asset/images/add-bg.png" alt="Sample Image">
                </div>
            </div>
        </div>
  
        <div class="container" style="max-width: 100%; padding: 0 5%;">
            
        <div class="row justify-content-center">
    <div class="col-12 col-md-10 col-lg-8"> 
        <div class="content p-4 shadow-sm rounded">

            <form action="add_movie.php" method="POST" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="title" class="form-label">Movie Title:</label>
                        <input type="text" name="title" class="form-control" placeholder="Movie Title" required>
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label">Description:</label>
                        <textarea name="description" class="form-control" placeholder="Movie Description" required></textarea>
                    </div>

            
                    <div class="col-12">
                        <label for="director" class="form-label">Director:</label>
                        <input type="text" name="director" class="form-control" placeholder="Director" required>
                    </div>

     
                    <div class="col-12">
                        <label for="cast" class="form-label">Cast:</label>
                        <input type="text" name="cast" class="form-control" placeholder="Cast" required>
                    </div>

     
                    <div class="col-12">
                        <label for="rating" class="form-label">Rating:</label>
                        <input type="text" name="rating" class="form-control" placeholder="Rating" required>
                    </div>

       
                    <div class="col-12">
                        <label for="genre" class="form-label">Genre:</label>
                        <input type="text" name="genre" class="form-control" placeholder="e.g., Action, Drama" required>
                    </div>

               
                    <div class="col-12">
                        <label for="runtime" class="form-label">Runtime:</label>
                        <input type="text" name="runtime" class="form-control" placeholder="Runtime" required>
                    </div>

          
                    <div class="col-12">
                        <label for="trailer_link" class="form-label">Trailer Link:</label>
                        <input type="url" name="trailer_link" class="form-control" placeholder="Trailer Link" required>
                    </div>

                    <div class="col-12">
                        <label for="image" class="form-label">Image:</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label for="status" class="form-label">Select Page to Add:</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="nowshowing">Now Showing</option>
                            <option value="comingsoon">Coming Soon</option>
                            <option value="index">Home</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="start_date" class="form-label">Start Date:</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <label for="end_date" class="form-label">End Date:</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>

                    <div class="col-12">
    <label for="cinema" class="form-label">Select Cinema:</label> 
    <select id="cinema" name="cinema" class="form-select" required> 
        <option value="">Select Cinema</option>
        <?php for ($i = 1; $i <= 8; $i++) { ?>
            <option value="<?= $i ?>">Cinema <?= $i ?></option>
        <?php } ?>
    </select>
</div>

                    <div class="col-md-4">
                        <label for="time1" class="form-label">Airing Time 1:</label>
                        <input type="time" name="time1" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="time2" class="form-label">Airing Time 2:</label>
                        <input type="time" name="time2" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label for="time3" class="form-label">Airing Time 3:</label>
                        <input type="time" name="time3" class="form-control" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100">Add Movie</button>
                    </div>
                </div>
            </form>
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