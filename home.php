<?php
include('Asset/connection/config.php'); 


$query = "SELECT * FROM movies WHERE status = 'index'";
$result = mysqli_query($conn, $query);
?>

<?php
session_start();

// Database connections
$conn_user = new mysqli('localhost', 'root', '', 'login_system');
$conn_admin = new mysqli('localhost', 'root', '', 'admin_system');

if ($conn_user->connect_error) {
    die("Connection failed: " . $conn_user->connect_error);
}

if ($conn_admin->connect_error) {
    die("Connection failed: " . $conn_admin->connect_error);
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // User query
    $stmt_user = $conn_user->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt_user->bind_param('ss', $email, $password);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    // Admin query
    $stmt_admin = $conn_admin->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt_admin->bind_param('ss', $email, $password);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin->num_rows === 1) {
        $user = $result_admin->fetch_assoc();
        if ($user['is_admin'] == 1) {
            $_SESSION['admin'] = $user['first_name'];
            header("Location: pages/dashboard.php");
            exit();
        }
    } elseif ($result_user->num_rows === 1) {
        $user = $result_user->fetch_assoc();
        $_SESSION['user'] = $user['first_name'];
        header("Location: home.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }

    $stmt_user->close();
    $stmt_admin->close();
}

$conn_user->close();
$conn_admin->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Home Page</title>
    <style>
        
body {
    background-color: rgb(0, 0, 0);
    color: #FFFFFF;
    font-family: Arial, sans-serif;
    padding-top: 50px;
}
@media(max-width: 991px) {
    .sidebar {
        background-color: rgba(225, 225, 225, 0.15);
        backdrop-filter: blur(10px);
    }
}
.navbar {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1050;
    background: transparent;
    height: 60px;
    font-family: 'Arial', sans-serif;
    font-size: 1rem; 
    color: #ffffff;
}
.navbar-nav .nav-item .nav-link {
    position: relative; 
    padding: 10px 15px;
    color: #ffffff;
    text-decoration: none;
    transition: all 0.3s ease;
}
.navbar-nav .nav-item .nav-link:hover {
    color: #7acaff; 
}
.navbar-nav .nav-item .nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 1px;
    background-color: #f3f7ec; 
    transform: scaleX(0);
    transform-origin: bottom right;
    transition: transform 0.3s ease-out;
}
.navbar-nav .nav-item .nav-link:hover::after {
    transform: scaleX(1); 
    transform-origin: bottom left;
}
.navbar .nav-link.active {
    background-color: #e3eaf31d; 
    color: white; 
    padding: 7px 7px;
    border-radius: 5px;
}
/*STYLE FOR FOOTER*/
.footer {
    background-color: #333456;
    padding: 40px 20px;
    text-align: center;
}
.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    max-width: 1200px;
    margin: auto;
    gap: 20px;
}
.footer-section {
    flex: 1;
    min-width: 250px;
}
.footer-section h4 {
    font-size: 18px;
    margin-bottom: 10px;
}
.footer-section p,
.footer-section a {
    font-size: 14px;
    color: #ffffff;
    text-decoration: none;
    margin-bottom: 8px;
    display: block;
}
.logo {
    width: 80px;
    margin-bottom: 10px;
}
.social-icons {
    display: flex;
    gap: 10px;
    justify-content: center;
}
.social-icons a {
    margin: 0 10px;
    color: #555;
    text-decoration: none;
    font-size: 24px;
    transition: color 0.3s;
}
.social-icons a:hover {
    color: #308bed; 
}
.footer-bottom {
    margin-top: 20px;
}
.footer-bottom p {
    font-size: 14px;
    color: #ffffff;
    margin-top: 10px;
}
.footer-links {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 10px;
}
.footer-links a {
    font-size: 14px;
    color: #ffffff;
    text-decoration: none;
}
.footer-section input[type="email"] {
    width: calc(100% - 100px);
    padding: 8px;
    margin-bottom: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}
.footer-section button[type="submit"] {
    padding: 8px 15px;
    background-color: #007bff;
    color: rgb(255, 255, 255);
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
.footer-section button[type="submit"]:hover {
    background-color: #0056b3;
}
@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .footer-section {
        min-width: unset;
    }

    .footer-section input[type="email"] {
        width: 100%;
    }
}
@media (max-width: 576px) {
    .footer-section h4 {
        font-size: 16px;
    }
    .footer-section p,
    .footer-section a {
        font-size: 13px;
    .footer-bottom p,
    .footer-links a {
        font-size: 12px;
    }
}
}
.custom-pagination {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
    display: flex;
    align-items: center;
    gap: 10px;
}
.custom-pagination .page-link {
    background-color: transparent;
    color: white;
    border: 2px solid transparent; 
    border-radius: 50%; 
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    transition: background-color 0.3s, border-color 0.3s;
}
.custom-pagination .page-link:hover {
    background-color: rgba(255, 255, 255, 0.7);
    color: black;
}
.custom-pagination .page-active {
    background-color: transparent;
    color: white; 
    border-color: rgb(255, 255, 255); 
    border-radius: 30px;
    border: 1px solid rgb(239, 231, 231); 
}
.arrow-button {
    background-color: rgba(0, 0, 0, 0.5);
    border: none;
    color: white;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background-color 0.3s;
}
.arrow-button:hover {
    background-color: rgba(255, 255, 255, 0.7);
    color: black;
}
.arrow-icon {
    font-size: 20px;
    line-height: 0;
}
.card-img-top{
    border-radius: 20px;
    padding: 5px;
}
.card{
    background-color:#26263e; ;
    height: 100%;
    border-radius: 20px;
}
.card-body{
    padding: 25px;
    margin-top: -15px;
}
.btn-primary{
    border-radius: 50px;
    width: 120px;
}
.btn-primary:hover{
    background-color: black;
    border: none;
}
h3{
    color: rgb(255, 255, 255);
    font-weight: bolder
}
.movie-gallery {
    letter-spacing: 5px; 
    text-transform: uppercase; 
    font-weight: bold; 
    font-size: 5rem;
    color: #474545; 
    text-align: center; 
    width: 100%; 
}
.card-title {
    color: white;
}
.card img {
    object-fit: fill;
    height: 400px;  
}
.card:hover {
    border-color: #e4dddd; 
    box-shadow: 3px 5px 8px rgba(26, 25, 25, 0.5); 
    transform: scale(1.01);
    transition: transform 0.3s ease, box-shadow 0.3s ease; 
    filter: none;
    }
#moreDetailsButton {
    padding: 3px 3px;
    background-color: transparent;
    color: #E94560;
    border: 1px solid #E94560;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
} 
#moreDetailsButton:hover {
    background-color: #E94560;
    color: #FFFFFF;
}
.btn.active {
    background-color: #007bff; 
    color: white; 
}
#carouselExampleAutoplaying1 {
    margin-left: auto;   
    margin-right: auto;  
    width: 70%;         
    position: relative;  
}
.carousel-control-prev {
    left: -7vw;  
}
.carousel-control-next {
    right: -7vw; 
     color: black;
}
.carousel-control-prev, .carousel-control-next {
    position: absolute;
    top: 50%;              
    transform: translateY(-50%); 
    z-index: 10;          
    transition: transform 0.3s ease, background-color 0.3s ease; 
}
.carousel-control-prev-icon, .carousel-control-next-icon {
    background-color: rgb(255, 255, 255); 
    color: black;
    border-radius: 50%;
    width: 40px;  
    height: 40px; 
    transition: transform 0.3s ease, background-color 0.3s ease; 
}
.carousel-control-prev:hover .carousel-control-prev-icon, 
.carousel-control-next:hover .carousel-control-next-icon {
    background-color: rgb(251, 251, 251); 
    transform: scale(1.1); 
} 
@media (max-width: 768px) {
    .carousel-control-prev, .carousel-control-next {
        left: -3vw; 
        right: -3vw; 
    }
}
@media (max-width: 480px) {
    .carousel-control-prev, .carousel-control-next {
        left: -2vw; 
        right: -2vw; 
    }
}
#NowShowing, #ComingSoon {
    margin-right: 20px;
    font-size: 1.2rem;  
    padding: 10px 40px; 
    border-radius: 10px; 
    transition: all 0.3s ease; 
    font-weight:lighter;
}
#NowShowing {
    background-color: transparent; 
    color: white; 
    border: 2px solid #f5a623; 
}
#NowShowing:hover {
    font-weight:bolder;
    background-color: #d48d20; 
    border-color: #d48d20; 
    transform: scale(1.07); 
}
#ComingSoon {
    background-color: transparent;
    color: white; 
    border: 2px solid #3a7bbd; 
}
#ComingSoon:hover {
    font-weight: bolder;
    background-color: #1f5e8c; 
    border-color: #1f5e8c; 
    transform: scale(1.07); 
}
#NowShowing.active {
    background-color: #d48d20;
    border-color: #fcfcfc; 
    font-weight: bold; 
}
#ComingSoon.active {
    background-color: #1f5e8c; 
    border-color: #fcfcfc; 
    font-weight: bold; 
}
.group {
    display: flex;
    line-height: 28px;
    align-items: center;
    position: relative;
    max-width: 190px;
  }
  .input {
    font-family: "Montserrat", sans-serif;
    width: 100%;
    height: 45px;
    padding-left: 2.5rem;
    box-shadow: 0 0 0 1.5px #2b2c37, 0 0 25px -17px #000;
    border: 0;
    border-radius: 12px;
    background-color: #16171d;
    outline: none;
    color: #bdbecb;
    transition: all 0.25s cubic-bezier(0.19, 1, 0.22, 1);
    cursor: text;
    z-index: 0;
  }
  .input::placeholder {
    color: #bdbecb;
  }
  .input:hover {
    box-shadow: 0 0 0 2.5px #2f303d, 0px 0px 25px -15px #000;
  }
  .input:active {
    transform: scale(0.95);
  }
  .input:focus {
    box-shadow: 0 0 0 2.5px #2f303d;
  }
  .search-icon {
    position: absolute;
    left: 1rem;
    fill: #bdbecb;
    width: 1rem;
    height: 1rem;
    pointer-events: none;
    z-index: 1;
  }
.full-width-image {
    width: 100vw;       
    height: auto;     
    margin: 0;         
    overflow: hidden;    
}
.full-width-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;   
}
.body, .full-width-container {
    padding: 0;
    margin: 0;
}
    </style>
</head>
<body>

    <!-------------------------------------------------------- ROYALE NAVBAR------------------------------------------------------------------------------------------------------>
   
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <div class="container-fluid">
        <a class="navbar-brand fs-4" href="home.php">
            <img src="Asset/images/whitelogo.png" alt="Logo" style="height: 40px;">
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
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
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

                    <!-- Show login/signup links if the user is not logged in -->
                    <?php if (!isset($_SESSION['user']) && !isset($_SESSION['admin'])): ?>
    <li class="nav-item mx-2">
        <a class="nav-link" href="login2.php">Login</a>
    </li>
<?php else: ?>
    <!-- Display the user's first name if logged in -->
    <li class="nav-item mx-2 dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <?php echo $_SESSION['user'] ?? $_SESSION['admin']; ?>
        </a>
        <ul class="dropdown-menu" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="history.php">View History</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
        </ul>
    </li>
<?php endif; ?>

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
    
document.getElementById('NowShowing').addEventListener('click', function() {
    const nowShowing = document.querySelectorAll('.now-showing');
    const comingSoon = document.querySelectorAll('.coming-soon');

  
    nowShowing.forEach(movie => movie.classList.remove('d-none'));
    comingSoon.forEach(movie => movie.classList.add('d-none'));

   
    document.getElementById('NowShowing').classList.add('active');
    document.getElementById('ComingSoon').classList.remove('active');
});

document.getElementById('ComingSoon').addEventListener('click', function() {
    const nowShowing = document.querySelectorAll('.now-showing');
    const comingSoon = document.querySelectorAll('.coming-soon');

    nowShowing.forEach(movie => movie.classList.add('d-none'));
    comingSoon.forEach(movie => movie.classList.remove('d-none'));

  
    document.getElementById('ComingSoon').classList.add('active');
    document.getElementById('NowShowing').classList.remove('active');
});

    </script>

</body>
</html>