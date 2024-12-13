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
    <title>Home</title>
    <link rel="stylesheet" href="Asset/css/home.css">
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

    <!--------------------------------------------------FIRST CAROUSEL------------------------------------------------------------------------------------------->
    <div id="customCarouselExample" class="carousel slide">
        
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Asset/images/venom.png" class="d-block w-100" alt="Venom">
            </div>
            <div class="carousel-item">
                <img src="Asset/images/starwars.jpg" class="d-block w-100" alt="starwars">
            </div>
            <div class="carousel-item">
                <img src="Asset/images/moana.jpg" class="d-block w-100" alt="moana">
            </div>
        </div>
    
    
        <nav aria-label="Page navigation example" class="custom-pagination d-flex justify-content-center align-items-center mt-2">
            <button class="arrow-button" id="prevPage" aria-label="Previous" data-bs-target="#customCarouselExample" data-bs-slide="prev">
                <span class="arrow-icon">&lt;</span>
            </button>
            <ul class="pagination m-0">
                <li class="page-item"><a class="page-link page-active" href="#" id="page1">1</a></li>
                <li class="page-item"><a class="page-link" href="#" id="page2">2</a></li>
                <li class="page-item"><a class="page-link" href="#" id="page3">3</a></li>
            </ul>
            <button class="arrow-button" id="nextPage" aria-label="Next" data-bs-target="#customCarouselExample" data-bs-slide="next">
                <span class="arrow-icon">&gt;</span>
            </button>
        </nav>
    </div>
    
    <br>

    <hr style="height: 2px; border: none; background-color: white; margin: 10px 0;">
<br> 

    <!---------------------------------------- NOW SHOWING AND UPCOMING MOVIES IN ROYALE CINEMA-------------------------------------------------------------------------------->

    <!--------------------------------------------------------NOW SHOWING MOVIES----------------------------------------------------------------->
    <div class="container py-5">
        <div class="d-flex justify-content-between mb-3">
            <h3 class="movie-gallery">
                <i class="bi bi-film"></i> Buy Your Tickets Now!
            </h3>
        </div>
        <br>
        <div class="mb-3 d-flex justify-content-center">
            <button id="NowShowing" class=" me-4">Now Showing</button>
            <button id="ComingSoon" class=" me-4">Coming Soon</button>
        </div> 

            <!--------------------------------------------------------SEARCH BAR----------------------------------------------------------------->

            <div class="group">
                <svg viewBox="0 0 24 24" aria-hidden="true" class="search-icon" onclick="handleSearch()">
                  <g>
                    <path
                      d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"
                    ></path>
                  </g>
                </svg>
            
                <input
                  id="query"
                  class="input"
                  type="search"
                  placeholder="Search..."
                  name="searchbar"
                />
              </div>
            
            
    
        <div class="row row-cols-1 row-cols-md-4 g-4 py-5">
        <div class="col">
            <div class="card now-showing text-center">
                <img src="Asset/images/ns1.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <p class="card-title">DeadPool & Wolverine</p>
                    <a href="pages/details.php" class="btn btn-primary" id="moreDetailsButton">More Details</a>
                </div>
            </div>
        </div>
    
        <div class="col now-showing text-center">
            <div class="card">
                <img src="Asset/images/ns2.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <p class="card-title">The Wild Robot</p>
                    <a href="#" class="btn btn-primary" id="moreDetailsButton">More Details</a>
                </div>
            </div>
        </div>
    
        <div class="col now-showing text-center">
            <div class="card text-center">
                <img src="Asset/images/ns3.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <p class="card-title">Oppenheimer</p>
                    <a href="#" class="btn btn-primary" id="moreDetailsButton">More Details</a>
                </div>
            </div>
        </div>
    
        <div class="col now-showing text-center">
            <div class="card">
                <img src="Asset/images/ns4.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <p class="card-title">The Super MArie Bros2</p>
                    <a href="#" class="btn btn-primary" id="moreDetailsButton">More Details</a>
                </div>
            </div>
        </div>
    
        <div class="col now-showing text-center">
            <div class="card">
                <img src="Asset/images/ns5.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <p class="card-title">The Nun2</p>
                    <a href="#" class="btn btn-primary" id="moreDetailsButton">More Details</a>
                </div>
            </div>
        </div>
    
        <div class="col">
            <div class="card now-showing text-center">
                <img src="Asset/images/ns6.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <p class="card-title">Spider-Man Across Spider-Verse</p>
                    <a href="#" class="btn btn-primary" id="moreDetailsButton">More Details</a>
                </div>
            </div>
        </div>
    
        <div class="col">
            <div class="card now-showing text-center">
                <img src="Asset/images/ns7.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <p class="card-title">Venom The Last Dance</p>
                    <a href="#" class="btn btn-primary" id="moreDetailsButton">More Details</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card now-showing text-center">
                <img src="Asset/images/ns8.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <p class="card-title">Hello, Love, Again</p>
                    <a href="#" class="btn btn-primary" id="moreDetailsButton">More Details</a>
                </div>
            </div>
        </div> 


            <!-------------------------------------------UPCOMING MOVIES----------------------------------------------> 

            <div class="col coming-soon d-none"  style="margin-top: 3px;">
                <div class="card text-center">
                    <img src="Asset/images/cs4.jpg" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Movie Title</h5>
                        <a href="#" class="btn btn-primary" id="moreDetailsButton">More Details</a>
                    </div>
                </div>
            </div>

            <div class="col coming-soon d-none" style="margin-top: 3px;" >
                <div class="card text-center">
                    <img src="Asset/images/cs2.jpg" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Movie Title</h5>
                        <a href="#" class="btn btn-primary" id="moreDetailsButton">More Details</a>
                    </div>
                </div>
            </div>
      
            <div class="col coming-soon d-none" style="margin-top: 3px;">
                <div class="card text-center">
                    <img src="Asset/images/cs3.jpg" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Movie Title</h5>
                        <a href="#" class="btn btn-primary" id="moreDetailsButton">More Details</a>
                    </div>
                </div>
            </div>

                  
            <div class="col coming-soon d-none" style="margin-top: 3px;">
                <div class="card text-center">
                    <img src="Asset/images/cs4.jpg" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Movie Title</h5>
                        <a href="#" class="btn btn-primary" id="moreDetailsButton">More Details</a>
                    </div>
                </div>
            </div>

        </div>
    </div> 
<!------------------------------------------------------------MOVIE SNACKS LABEL--------------------------------------------->

    <div class="container-fluid full-width-container">
        <div class="row g-0"> 
          <div class="col-12">
            <div class="full-width-image">
              <img src="Asset/images/snacks3.png" alt="Sample Image">
            </div>
          </div>
        </div>
      </div>
      
<!-----------------------------------------------------------CAROUSEL FOR SNACKSS--------------------------------------------->   

    <div id="carouselExampleAutoplaying1" class="carousel slide" data-bs-ride="carousel" style="width: 70%; margin: 0 auto;">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Asset/images/popcorn.png" class="d-block w-100 carousel-image" alt="Pop Corn">
            </div>
            <div class="carousel-item">
                <img src="Asset/images/drinks.png" class="d-block w-100 carousel-image" alt="Drinks">
            </div>
            <div class="carousel-item">
                <img src="Asset/images/hot snacks.png" class="d-block w-100 carousel-image" alt="Hot Snacks">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying1" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying1" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!--------------------------------------------------------------FOOTER------------------------------------------------------------------->

    <footer class="footer">
        <div class="footer-container">

            <!--- Royale Cinema Media --->
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
            
            <!---Royale Cinema Contacts--->
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
      
<!----------------------------------------------------------JAVASCRIPT---------------------------------------------------------------->
<script>
        
var carousel = new bootstrap.Carousel(document.getElementById('customCarouselExample'));

function removeActiveClasses() {
    const pageLinks = document.querySelectorAll('.custom-pagination .page-link');
    pageLinks.forEach(link => {
        link.classList.remove('page-active');
    });
}

function updateActiveClass(slideIndex) {
    removeActiveClasses();
    document.getElementById('page' + (slideIndex + 1)).classList.add('page-active');
}

function goToSlide(slideIndex) {
    carousel.to(slideIndex);
    updateActiveClass(slideIndex);
}


document.getElementById('page1').addEventListener('click', function() {
    goToSlide(0);
});
document.getElementById('page2').addEventListener('click', function() {
    goToSlide(1);
});
document.getElementById('page3').addEventListener('click', function() {
    goToSlide(2);
});


document.getElementById('prevPage').addEventListener('click', function() {
    carousel.prev();
    const activeIndex = Array.from(document.querySelectorAll('#customCarouselExample .carousel-item')).findIndex(item => item.classList.contains('active'));
    updateActiveClass(activeIndex);
});

document.getElementById('nextPage').addEventListener('click', function() {
    carousel.next();
    const activeIndex = Array.from(document.querySelectorAll('#customCarouselExample .carousel-item')).findIndex(item => item.classList.contains('active'));
    updateActiveClass(activeIndex);
});


document.getElementById('customCarouselExample').addEventListener('slid.bs.carousel', function () {
    const activeIndex = Array.from(document.querySelectorAll('#customCarouselExample .carousel-item')).findIndex(item => item.classList.contains('active'));
    updateActiveClass(activeIndex);
});


<!--------------------------------------------------------------------------------------------------------------------------------->
    


    </script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>