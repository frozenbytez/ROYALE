
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
    <title>🎞️ Royale Cinema - Now Showing Movies</title>
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}
body {
    background-color: #1e1e2d;
    color: #f2f2f2;
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
@media(max-width: 991px) {
    .sidebar {
        background-color: rgba(225, 225, 225, 0.15);
        backdrop-filter: blur(10px);
    }
}
.now-showing {
    text-align: center;
    padding: 40px 20px;
}
.now-showing h1 {
    font-family: Arial, sans-serif; 
    font-weight: bold;
    font-size: 3.5rem;
  }
.now {
    color: white;
  }
.showing {
    color: #a341f1;
  }
/* STYLE FOR GET TICKET BUTTON */
.button {
    --width: 100px;
    --height: 35px;
    --tooltip-height: 35px;
    --tooltip-width: 90px;
    --gap-between-tooltip-to-button: 18px;
    --button-color: #222;
    --tooltip-color: #fff;
    width: var(--width);
    height: var(--height);
    background: var(--button-color);
    position: relative;
    text-align: center;
    border-radius: 0.45em;
    font-family: "Arial";
    transition: background 0.3s;
}
.tooltip-inner {
    background-color: rgba(0, 0, 0, 0.9) !important; 
    color: #fff; 
}
.button::after {
    position: absolute;
    content: '';
    width: 0;
    height: 0;
    border: 10px solid transparent;
    border-top-color: #555;
    left: calc(50% - 10px);
    bottom: calc(100% + var(--gap-between-tooltip-to-button) - 10px);
}
.button::after,.button::before {
    opacity: 0;
    visibility: hidden;
    transition: all 0.5s;
}
.text {
    display: flex;
    align-items: center;
    justify-content: center;
}
.button-wrapper,.text,.icon {
    overflow: hidden;
    position: absolute;
    width: 100%;
    height: 100%;
    left: 0;
    color: #fff;
}
.button::before {
    position: absolute;
    content: attr(data-tooltip);
    width: var(--tooltip-width);
    height: var(--tooltip-height);
    background-color: transparent; 
    font-size: 0.9rem;
    color: #fff; 
    border-radius: .25em;
    line-height: var(--tooltip-height);
    bottom: calc(var(--height) + var(--gap-between-tooltip-to-button) + 10px);
    left: calc(50% - var(--tooltip-width) / 2);
}
.button:hover:before, .button:hover:after {
    opacity: 1;
    visibility: visible;
}
.button:hover:after {
    bottom: calc(var(--height) + var(--gap-between-tooltip-to-button) - 20px);
}
.button:hover:before {
    bottom: calc(var(--height) + var(--gap-between-tooltip-to-button));
}
.text {
    top: 0
}
.text,.icon {
    transition: top 0.5s;
}
.icon {
    color: #fff;
    top: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.icon svg {
    width: 24px;
    height: 24px;
}
.button:hover {
    background: #222;
}
.button:hover .text {
    top: -100%;
}
.button:hover .icon {
    top: 0;
}
.button:hover:before,.button:hover:after {
    opacity: 1;
    visibility: visible;
}
/*------------------------------------------------------------------------*/
.movie-card {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    gap: 20px;
    padding: 10px;
    background-color: #f2f2f2;
    border-radius: 15px;
    color: #1e1e2d;
    max-width: 800px;
    margin: 2px auto;
    transition: transform 0.3s ease-in-out;
}
.movie-card:hover {
    transform: translateY(-10px);
    box-shadow: 0px 10px 15px rgba(0, 0, 0, 0.1);
}
.movie-poster img {
    width: 250px;
    border-radius: 10px;
}   
.movie-info {
    max-width: 450px;
    text-align: left;
}
.movie-info h2 {
    font-size: 1.8em;
    margin-bottom: 10px;
}
.movie-poster {
    text-align: center;
    position: relative;
}
.movie-poster .button {
    margin-top: 10px; 
    display: inline-block;
}
.trailer-link {
    color: red;
    text-decoration: none;
    font-size: 1em;
    margin-bottom: 10px;
    display: inline-block;
}
.modal-title {
    color: black;
}
@media (max-width: 768px) {
    .movie-card {
        flex-direction: column;
        align-items: center;
        margin-bottom: 20px; 
    }
    .movie-info {
        text-align: center;
    }
    .nav-links {
        display: none;
    }
    .dropdown {
        display: block;
    }
}

/*STYLE FOR FOOTER*/
.footer {
    background-color: #02162a;
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
    }
    .footer-bottom p,
    .footer-links a {
        font-size: 12px;
    }
}
    </style>
    
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
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link active" arie-cureent="page" href="nowshowing.php">Now Showing</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="comingSoon.php">Upcoming</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="login2.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-----------------------------------------------------------------------------NOW SHOWING MOVIES------------------------------------------------------->
<br> <br> <br>

    <main>
        <section class="now-showing">
            <h1>
                <span class="now">NOW</span> <span class="showing">SHOWING</span>
            </h1>

        <!---------------------------------------------------------------HELLO, LOVE, AGAIN MOVIE DETAILS-------------------------------------------------------->
                <!---Movie Poster--->
    <div class="container py-4">
        <div class="row movie-card">
            <div class="col-12 col-md-4 text-center movie-poster">
                <img src="../../Asset/images/hello_love_again.jpg" class="img-fluid mb-3" alt="Hello Love Again Photo">
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
                <h2 class="text-center text-md-left">HELLO, LOVE, AGAIN</h2>
                <a href="https://youtu.be/uRBHJPic9zc?si=s2nsExPLCNZYOwsT" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#hlaTrailerModal">Watch trailer</a>
                
                <!--- Movie Details--->
                <p><strong>Runtime:</strong> 1 hr, 49 mins</p>
                <p>After fighting for their love to conquer time, distance, and a global situation that kept them apart, Joy and Ethan meet again in Canada but realize they have also changed a lot individually.</p>
                <p><strong>Director:</strong> Cathy Garcia-Molina</p>
                <p><strong>Rating:</strong> TBA</p>
                <p><strong>Cast:</strong>Kathryn Bernardo, Alden Richards, Valerie Concepcion, Anna Katharina Cruz, Bryce Eusebio</p>
                <p><strong>Rating:</strong> RATED-PG</p>
            </div>
        </div>
    </div>
    
    <!--- Movie Trailer Modal--->
    <div class="modal fade" id="hlaTrailerModal" tabindex="-1" aria-labelledby="hlaTrailerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hlaTrailerModalLabel">Trailer - Hello, Love, Again</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="ratio ratio-16x9">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/uRBHJPic9zc?si=s2nsExPLCNZYOwsT" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

       <!-----------------------------------------------------------DEADPOOL AND WOLVERINE MOVIE DETAILS-------------------------------------------->
              <!--- Movie Poster --->
            <div class="container py-4">
                <div class="row movie-card">
                    <div class="col-12 col-md-4 text-center movie-poster">
                        <img src="../../Asset/images/deadpool_and_wolverine.jpg" class="img-fluid mb-3" alt="Deadpool and Wolverine">
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
                        <h2 class="text-center text-md-left">DEADPOOL AND WOLVERINE</h2>
                        <a href="#" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#deadpoolTrailerModal">Watch trailer</a>
                        
                        <!---Movie Details--->
                        <p><strong>Runtime:</strong> 2 hrs, 10 mins</p>
                        <p>Deadpool and Wolverine team up in this comedic action-packed adventure, battling enemies while clashing in their unique styles.</p>
                        <p><strong>Director:</strong> Shawn Levy</p>
                        <p><strong>Cast:</strong> Ryan Reynolds, Hugh Jackman</p>
                        <p><strong>Rating:</strong> RATDE-R</p>
                    </div>
                </div>
            </div>
            
            <!---Movie Trailder Modal --->
            <div class="modal fade" id="deadpoolTrailerModal" tabindex="-1" aria-labelledby="deadpoolTrailerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deadpoolTrailerModalLabel">Trailer - Deadpool and Wolverine</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/73_1biulkYk?si=OxTcC08YoiFVpc3B" title="YouTube video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!--------------------------------------------------------------------THW WILD ROBOT MOVIE DETAILS------------------------------------------->
    
                <!--- Movie Poster --->
        <div class="container py-4">
                <div class="row movie-card">
                    <div class="col-12 col-md-4 text-center movie-poster">
                        <img src="../../Asset/images/the_wild_robot.jpg" class="img-fluid mb-3" alt="The Wild Robot">
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
                        <h2 class="text-center text-md-left">THE WILD ROBOT</h2>
                        <a href="#" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#wildRobotTrailerModal">Watch trailer</a>
                       
                       <!--- Movie Details --->
                        <p><strong>Runtime:</strong> 1 hr, 40 mins</p>
                        <p>In a stunning forest setting, a robot begins to understand the intricacies of life, forging deep connections with nature.</p>
                        <p><strong>Director:</strong> Doug Sweetland</p>
                        <p><strong>Cast:</strong> John C. Reilly, Emma Thompson</p>
                        <p><strong>Rating:</strong> RATED-PG</p>
                    </div>
                </div>
            </div>

            <!---Movie Trailer Modal --->
            <div class="modal fade" id="wildRobotTrailerModal" tabindex="-1" aria-labelledby="wildRobotTrailerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="wildRobotTrailerModalLabel">Trailer - The Wild Robot</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="ratio ratio-16x9">
                                <iframe id="video-frame" width="560" height="315" 
                                src="https://www.youtube.com/embed/67vbA5ZJdKQ" 
                                frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                                allowfullscreen></iframe>
                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-----------------------------------------------------------------------------------OPPENHEIMER MOVIE--------------------------------------------------------->    
             <!--- Movie Poster --->
            <div class="container py-4">
                <div class="row movie-card">  
                    <div class="col-12 col-md-4 text-center movie-poster">
                        <img src="../../Asset/images/oppenheimer.jpg" class="img-fluid mb-3" alt="The Wild Robot">
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
                        <h2 class="text-center text-md-left">OPPENHEIMER</h2>
                        <a href="https://youtu.be/uYPbbksJxIg?si=IfWpezIfEScS3vTF" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#oppenheimerTrailerModal">Watch trailer</a>

                       <!---Movie Details --->
                        <p><strong>Runtime:</strong> 3 hrs</p>
                        <p>The story of J. Robert Oppenheimer, the scientist behind the atomic bomb, and the weight of his discovery on the world and himself.</p>
                        <p><strong>Director:</strong> Christopher Nolan</p>
                        <p><strong>Cast:</strong> Cillian Murphy, Emily Blunt, Matt Damon</p>
                        <p><strong>Rating:</strong> RATED-R</p>
                    </div>
                </div>
            </div>

            <!--- Movie Trailer Modal --->
            <div class="modal fade" id="oppenheimerTrailerModal" tabindex="-1" aria-labelledby="oppenheimerTrailerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="oppenheimerTrailerModalLabel">Trailer - Oppenheimer</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="ratio ratio-16x9">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/uYPbbksJxIg?si=IfWpezIfEScS3vTF" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--------------------------------------------------------------------THE SUPER MARIO BROS2 MOVIE DETAIL------------------------------------------------------->
            <!---Movie Poster-->
            <div class="container py-4">
                <div class="row movie-card">
                    <div class="col-12 col-md-4 text-center movie-poster">
                        <img src="../../Asset/images/the_super_mario_bros2.jpg" class="img-fluid mb-3" alt="The Super Mario Bros 2">
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
                        <h2 class="text-center text-md-left">THE SUPER MARIO BROS 2</h2>
                        <a href="https://youtu.be/bqQhPeVMvcY?si=CHE1BskFm3NG_0YS" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#marioTrailerModal">Watch trailer</a>
            
                        <!--- Movie Details --->
                        <p><strong>Runtime:</strong> 1 hr, 32 mins</p>
                        <p>Mario and Luigi embark on a new journey to save the Mushroom Kingdom from an even bigger threat.</p>
                        <p><strong>Director:</strong> Aaron Horvath, Michael Jelenic</p>
                        <p><strong>Cast:</strong> Chris Pratt, Anya Taylor-Joy, Charlie Day</p>
                        <p><strong>Rating:</strong> RATED-PG</p>
                    </div>
                </div>
            </div>
            
            <!---- Movie Trailer Modal --->
            <div class="modal fade" id="marioTrailerModal" tabindex="-1" aria-labelledby="marioTrailerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="marioTrailerModalLabel">Trailer - The Super Mario Bros 2</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="ratio ratio-16x9">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/bqQhPeVMvcY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-----------------------------------------------------------THE NUN 2 MOVIE DETAILS-------------------------------------------------------------->
           <!--- Movie Poster --->
            <div class="container py-4">
                <div class="row movie-card">
                    <div class="col-12 col-md-4 text-center movie-poster">
                        <img src="../../Asset/images/the_nun2.jpg" class="img-fluid mb-3" alt="The Nun 2">
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
                        <h2 class="text-center text-md-left">THE NUN 2</h2>
                        <a href="https://youtu.be/QF-oyCwaArU?si=va0I_Mh-R8BoG2_D" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#theNunTrailerModal">Watch trailer</a>
            
                        <!--- Movie Details --->
                        <p><strong>Runtime:</strong> 1 hr, 50 mins</p>
                        <p>A terrifying force resurfaces as the demon Valak returns to haunt those who defied it before.</p>
                        <p><strong>Director:</strong> Michael Chaves</p>
                        <p><strong>Cast:</strong> Taissa Farmiga, Jonas Bloquet</p>
                        <p><strong>Rating:</strong> R</p>
                    </div>
                </div>
            </div>
            
            <!--- Movie Trailer Modal --->
            <div class="modal fade" id="theNunTrailerModal" tabindex="-1" aria-labelledby="theNunTrailerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="theNunTrailerModalLabel">Trailer - The Nun 2</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="ratio ratio-16x9">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/QF-oyCwaArU?si=va0I_Mh-R8BoG2_D" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!---------------------------------------------------SPIDER MAN ACROSS SPIRDER VERSE MOVIE DETAILS------------------------------------------------------------------------>
                  
            <!--- Movie Poster --->
            <div class="container py-4">
                <div class="row movie-card">
                    <div class="col-12 col-md-4 text-center movie-poster">
                        <img src="../../Asset/images/spider_man_across_spider_verse.jpg" class="img-fluid mb-3" alt="The Spider Man Across Spider Verse">
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
                        <h2 class="text-center text-md-left">SPIDER-MAN ACROSS THE SPIDER-VERSE</h2>
                        <a href="https://youtu.be/shW9i6k8cB0?si=J0R4iNYtgYxOz6ma" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#theSpiderTrailerModal">Watch trailer</a>
            
                        <!--- Movie Details --->
                        <p><strong>Runtime:</strong>2 hrs, 20 mins</p>
                        <p>Miles Morales embarks on a multiverse adventure, teaming up with other Spider-heroes to face a new threat.</p>
                        <p><strong>Director:</strong> Joaquim Dos Santos, Kemp Powers</p>
                        <p><strong>Cast:</strong>Shameik Moore, Hailee Steinfeld</p>
                        <p><strong>Rating:</strong> PG</p>
                    </div>
                </div>
            </div>
            
            <!---- Movie Trailer Modal --->
            <div class="modal fade" id="theSpiderTrailerModal" tabindex="-1" aria-labelledby="theSpiderTrailerModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="theSpiderTrailerModalLabel">Trailer - The Spider Man Across The Spider verse</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="ratio ratio-16x9">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/shW9i6k8cB0?si=J0R4iNYtgYxOz6ma" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!------------------------------------------------------VENOM THE LAST DANCE MOVIE DETAILS------------------------------------>
            <!---Movie Poster --->
            <div class="container py-4">
                <div class="row movie-card">
                    <div class="col-12 col-md-4 text-center movie-poster">
                        <img src="../../Asset/images/venom_last_dance.jpg" class="img-fluid mb-3" alt="Venom The Last Dance">
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
                        <h2 class="text-center text-md-left">VENOM: LAST DANCE</h2>
                        <a href="https://youtu.be/__2bjWbetsA?si=2lgrCc3CVBDS5gCa" class="trailer-link d-block text-center text-md-left" data-bs-toggle="modal" data-bs-target="#venomTrailerModal">Watch trailer</a>
                        
                        <!--- Movie Details --->
                        <p><strong>Runtime:</strong> 1 hr, 55 mins</p>
                        <p>In the latest chapter of his journey, Venom faces off against a powerful new foe, pushing Eddie Brock to his limits.</p>
                        <p><strong>Director:</strong> Andy Serkis</p>
                        <p><strong>Cast:</strong>Tom Hardy</p>
                        <p><strong>Rating:</strong> RATED-PG-13</p>
                    </div>
                </div>
            </div>
            
            <!-- Movie Trailer Modal -->
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

                <?php
    include('../../Asset/connection/config.php');  
    $query = "SELECT * FROM movies WHERE status = 'nowshowing'";
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
        $sanitized_title = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($movie_title));

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
                <a href='../movie_details/$sanitized_title.php' class='button'>
                    <div class='button-wrapper'>
                        <div class='text'>Get Ticket</div>
                        <span class='icon'>
                            <svg viewBox='0 0 16 16' class='bi bi-cart2' fill='currentColor' height='16' width='16' xmlns='http://www.w3.org/2000/svg'>
                                <path d='M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l1.25 5h8.22l1.25-5H3.14zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z'></path>
                            </svg>
                        </span>
                    </div>
                </a>
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
                <img src="../../Asset/images/whitelogo.png" alt="Logo" class="logo">
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

<!---------------------------------------------------------------------JAVASCRIPT--------------------------------------------------------->
    
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