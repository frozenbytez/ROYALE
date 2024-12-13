<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'login_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // User/Admin Query
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            if ($user['is_admin'] == 1) {
                $_SESSION['admin'] = $user['first_name'];
                header("Location: pages/dashboard.php");
                exit();
            } else {
                $_SESSION['user'] = $user['first_name'];
                header("Location: home.php");
                exit();
            }
        } else {
            $error = "Invalid email or password!";
        }
    } else {
        $error = "Invalid email or password!";
    }
    $stmt->close();
}
$conn->close();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Upcoming</title>
    <link rel="stylesheet" href="Asset/css/comingSoon.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <div class="container-fluid">
        <a class="navbar-brand fs-4" href="home.php">
            <img src="Asset/images/whitelogo.png" alt="Logo" style="height: 40px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-start" id="offcanvasNavbar">
            <div class="offcanvas-header">
                <h5>LOGO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="nowshowing.php">Now Showing</a></li>
                    <li class="nav-item"><a class="nav-link" href="comingSoon.php">Upcoming</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                    <?php if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])): ?>
                        <li class="nav-item"><a class="nav-link" href="login2.php">Login</a></li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <?= $_SESSION['user'] ?? $_SESSION['admin']; ?>
    </a>
    <ul class="dropdown-menu" aria-labelledby="userDropdown">
        <li><a class="dropdown-item" href="history.php">View History</a></li>
        <li><a class="dropdown-item" href="?logout=true">Logout</a></li>
    </ul>
</li>

                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>



<!-------------------------------------------------------------------------UPCOMING MOVIES--------------------------------------------------->
<br> <br> <br>

    <main>
        <section class="coming-soon">
            <h1>
                <span class="coming">COMING</span> <span class="soon">SOON</span>
            </h1>

        <!---------------------------------------------------------------MOANA 2 MOVIE DETAILS-------------------------------------------------------->
                <!---Movie Poster--->
                <div class="container py-4">
                    <div class="row movie-card">
                        <div class="col-12 col-md-4 text-center movie-poster">
                            <img src="Asset/images/cs4.jpg" class="img-fluid mb-3" alt=" Moan 2 Photo">
                            <div data-bs-toggle="tooltip" data-bs-placement="top" title="Price: ₱350" class="button">
                                <div class="button-wrapper">
                                    <div class="text">Get Ticket</div>
                                    <span class="icon">
                                        <svg viewBox="0 0 16 16" class="bi bi-cart2" fill="currentColor" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                
                       
                        <div class="col-12 col-md-8 movie-info">
                            <hr />
                            <h2 class="text-center text-md-left">MOANA 2</h2>
                            <a href="https://youtu.be/hDZ7y8RP5HE?si=FS3xGeFpTNTZb35C" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#moanaTrailerModal">Watch trailer</a>
                            
                            <!--- Movie Details--->
                            <p><strong>Runtime:</strong>1 hr, 55 mins</p>
                            <p>Moana sets off on a new journey across the Pacific to discover new islands, meet allies, and face unknown challenges.</p>
                            <p><strong>Director:</strong> Ron Clements, John Musker</p>
                            <p><strong>Rating:</strong> TBA</p>
                            <p><strong>Cast:</strong>Auli'i Cravalho, Dwayne Johnson</p>
                            <p><strong>Rating:</strong> RATED-PG</p>
                        </div>
                    </div>
                </div>
                
                <!--- Movie Trailer Modal--->
                <div class="modal fade" id="moanaTrailerModal" tabindex="-1" aria-labelledby="moanaTrailerModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="moanaTrailerModalLabel">Trailer - Moana 2</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="ratio ratio-16x9">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/hDZ7y8RP5HE?si=FS3xGeFpTNTZb35C" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                  
<?php
include('Asset/connection/config.php');  


$query = "SELECT * FROM movies WHERE status = 'comingSoon'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    
    while ($movie = mysqli_fetch_assoc($result)) {
    $movie_id = $movie['id'];  
    $movie_title = $movie['title'];  
    $movie_description = $movie['description'];  
    $movie_runtime = $movie['runtime'];  
    $movie_director = $movie['director'];  
    $movie_cast = $movie['cast'];  
    $movie_rating = $movie['rating'];  
    $movie_trailer = $movie['trailer_link'];  
    $movie_image = isset($movie['image_url']) ? $movie['image_url'] : 'default_image.jpg';  
    $movie_start_date = $movie['start_date'];  
    $movie_end_date = $movie['end_date'];  
    $movie_time1 = date("h:i A", strtotime($movie['time1']));  
    $movie_time2 = date("h:i A", strtotime($movie['time2']));  
    $movie_time3 = date("h:i A", strtotime($movie['time3']));  

    
    $image_path = "../Asset/images/" . $movie_image; 

    
    if (file_exists($image_path)) {
        $image_tag = "<img src='$image_path' class='img-fluid mb-3' alt='$movie_title'>";
    } else {
        $image_tag = "<p>Image not found</p>";  
    }

    
    $movie_idTrailerModal = "trailerModal" . $movie['id'];  
    $movie_idTrailerModalLabel = "trailerModalLabel" . $movie['id'];  

    
    echo "
    <div class='container py-4'>
        <div class='row movie-card'>
            <div class='col-12 col-md-4 text-center movie-poster'>
                $image_tag
                <div data-bs-toggle='tooltip' data-bs-placement='top' title='Price: ₱350' class='button'>
                    <div class='button-wrapper'>
                        <div class='text'>Get Ticket</div>
                        <span class='icon'>
                            <svg viewBox='0 0 16 16' class='bi bi-cart2' fill='currentColor' height='16' width='16' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z'></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            
            <div class='col-12 col-md-8 movie-info'>
                <hr />
                <h2 class='text-center text-md-left'>$movie_title</h2>
                <a href='$movie_trailer' class='trailer-link d-block text-center text-md-left' data-bs-toggle='modal' data-bs-target='#$movie_idTrailerModal'>Watch trailer</a>
                
                <!--- Movie Details--->
                <p><strong>Runtime:</strong> $movie_runtime</p>
                <p>$movie_description</p>
                <p><strong>Director:</strong> $movie_director</p>
                <p><strong>Cast:</strong> $movie_cast</p>
                <p><strong>Rating:</strong> $movie_rating <strong>Genre:</strong> {$movie['genre']}</p>
                <p><strong>Airing Date:</strong> $movie_start_date <strong>-</strong> $movie_end_date </p>
                <p><strong>Airing Time:</strong> $movie_time1 / $movie_time2 / $movie_time3 </p>
                                                  
            </div>
        </div>
    </div>
    
    <!--- Movie Trailer Modal--->
    <div class='modal fade' id='$movie_idTrailerModal' tabindex='-1' aria-labelledby='$movie_idTrailerModalLabel' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='$movie_idTrailerModalLabel'>Trailer - $movie_title</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    <div class='ratio ratio-16x9'>
                        <iframe width='560' height='315' src='https://www.youtube.com/embed/".basename($movie_trailer)."' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ";
    }
} else {
    echo "No movies available!";
}
?>
                    </section>
                </main>

            
            

  <!--------------------------------------------------------------FOOTER------------------------------------------------------------------->

  <footer class="footer">
    <div class="footer-container">

        <div class="footer-section">
            <img src="Asset/images/whitelogo.png" alt="Logo" class="logo">
            <p>Enjoy Watching with us</p>
            <div class="social-icons">
                <a href="#" class="social-link">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="social-link">
                    <i class="fab fa-facebook"></i>
                </a>
            </div>
        </div>
        
        <div class="footer-section">
            <h4>Get In Touch</h4>
            <p>support@pagedone.com</p>
            <p>+91 945 658 3256</p>
            <p>Caloocan City</p>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-links">
            <a href="#">Terms</a>
            <a href="#">Privacy</a>
            <a href="#">Cookies</a>
        </div>
        <p>&copy; 2024 Pagedone, All rights reserved.</p>
    </div>
</footer>

<!--------------------------------------------------------------------------JAVASCRIPT------------------------------------------------------------>
    <script>

        document.addEventListener("DOMContentLoaded", function () {
                            
             var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
            });
                        
                          
                const modalElements = document.querySelectorAll('.modal');
                    modalElements.forEach(modal => {
                         modal.addEventListener('hidden.bs.modal', function () {
                           const iframe = modal.querySelector('iframe');
                            iframe.src = iframe.src; 
                     });
                });
            });
                        
                      
            function toggleDropdown() {
                const dropdownMenu = document.getElementById("dropdownMenu");
                   if (dropdownMenu.style.display === "block") {
                        dropdownMenu.style.display = "none";
                            } else {
                            dropdownMenu.style.display = "block";
                         }
                    }
                        
            function changeVideo(url, modalId) {
                const modal = document.getElementById(modalId);
                 const iframe = modal.querySelector('iframe');
                    iframe.src = url;
            }
                            
             </script>
                     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
                     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>  
                     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+9iDf5jHMGb4a3BY5BZmI8bwe50k2" crossorigin="anonymous"></script>


        </body>
 </html>
    </php>