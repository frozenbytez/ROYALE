<?php
// Include the database connection file
include('../Asset/connection/config.php');

// Fetch movies with 'nowshowing' status from the database
$query = "SELECT * FROM movies WHERE status = 'comingsoon'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE php>
<php lang="en">
<head>          
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Royale Cinema - Upcoming Movies</title>
    <link rel="stylesheet" href="../Asset/css/comingSoon.css">
    
</head>
<body>

  <!-------------------------------------------------------- ROYALE NAVBAR------------------------------------------------------------------------------------------------------>
     <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class ="container-fluid">
            <a class="navbar-brand fs-4" href="#">LOGO</a>
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
                            <a class="nav-link" href="nowshowing.php">Now Showing</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link active" arian-content="page" href="comingSoon.php">Upcoming</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="contact.php">Contact Us</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="../login2.php">Login</a>
                        </li>
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
                            <img src="../Asset/images/cs4.jpg" class="img-fluid mb-3" alt=" Moan 2 Photo">
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
            
                   <!-----------------------------------------------------------WE LIVE IN TIME MOVIE DETAILS-------------------------------------------->
                          <!--- Movie Poster --->
                        <div class="container py-4">
                            <div class="row movie-card">
                                <div class="col-12 col-md-4 text-center movie-poster">
                                    <img src="../Asset/images/cs2.jpg" class="img-fluid mb-3" alt="Deadpool and Wolverine">
                                    <div data-bs-toggle="tooltip" data-bs-placement="top" title="Price: ₱370" class="button">
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
                                    <h2 class="text-center text-md-left">WE LIVE IN TIME</h2>
                                    <a href="https://youtu.be/MH02yagHaNw?si=CENz_z60AQJxW0Dv" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#deadpoolTrailerModal">Watch trailer</a>
                                    
                                    <!---Movie Details--->
                                    <p><strong>Runtime:</strong> 2 hrs</p>
                                    <p>A romantic drama that follows the journey of two people finding connection and love amid life's twists and turns.
                                    </p>
                                    <p><strong>Director:</strong>John Crowley</p>
                                    <p><strong>Cast:</strong>Florence Pugh, Andrew Garfield</p>
                                    <p><strong>Rating:</strong>TBA</p>
                                </div>
                            </div>
                        </div>
                        
                        <!---Movie Trailder Modal --->
                        <div class="modal fade" id="deadpoolTrailerModal" tabindex="-1" aria-labelledby="deadpoolTrailerModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deadpoolTrailerModalLabel">Trailer - We Live in Time</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ratio ratio-16x9">
                                            <iframe src="https://www.youtube.com/embed/MH02yagHaNw?si=CENz_z60AQJxW0Dv" title="YouTube video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--------------------------------------------------------------------------------THW WILD ROBOT MOVIE DETAILS------------------------------------------->
                
                            <!--- Movie Poster --->
                    <div class="container py-4">
                            <div class="row movie-card">
                                <div class="col-12 col-md-4 text-center movie-poster">
                                    <img src="../Asset/images/cs3.jpg" class="img-fluid mb-3" alt="The Wild Robot">
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
                                    <h2 class="text-center text-md-left">WICKED</h2>
                                    <a href="https://youtu.be/6COmYeLsz4c?si=Db5LKXcDbytMiiOe" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#wickedTrailerModal">Watch trailer</a>
                                   
                                   <!--- Movie Details --->
                                    <p><strong>Runtime:</strong>2 hrs, 15 mins</p>
                                    <p>The untold story of the witches of Oz, as Elphaba and Glinda's friendship is tested against the backdrop of magic and politics.</p>
                                    <p><strong>Director:</strong> Jon M. Chu</p>
                                    <p><strong>Cast:</strong>Cynthia Erivo, Ariana Grande</p>
                                    <p><strong>Rating:</strong> RATED-PG-13</p>
                                </div>
                            </div>
                        </div>
            
                        <!---Movie Trailer Modal --->
                        <div class="modal fade" id="wickedTrailerModal" tabindex="-1" aria-labelledby="wickedTrailerModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="wickedTrailerModalLabel">Trailer - Wicked</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="ratio ratio-16x9">
                                            <iframe id="video-frame" width="560" height="315" 
                                            src="https://www.youtube.com/embed/6COmYeLsz4c?si=Db5LKXcDbytMiiOe" 
                                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                            allowfullscreen></iframe>
                                    
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 

                        <?php
include('../config.php');  


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
            <img src="logo.png" alt="Logo" class="logo">
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

        <div class="footer-section">
            <a href="#">Home</a>
            <a href="#">Now Showing</a>
            <a href="#">Coming Soon</a>
            <a href="#">Contact</a>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-links">
            <a href="#">Terms</a>
            <a href="#">Privacy</a>
            <a href="#">Cookies</a>
        </div>
        <p>&copy; 2023 Pagedone, All rights reserved.</p>
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
                        
        </body>
    </php>