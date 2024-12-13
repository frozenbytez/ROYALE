

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
    <link rel="stylesheet" href="../../assets/css/guest/nowshowing.css">
    
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
                        <a class="nav-link" href="index.php">Home</a>
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
                        <a class="nav-link" href="login.php">Login</a>
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
                <img src="../../assets/images/hello_love_again.jpg" class="img-fluid mb-3" alt="Hello Love Again Photo">
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
                        <img src="../../assets/images/deadpool_and_wolverine.jpg" class="img-fluid mb-3" alt="Deadpool and Wolverine">
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
                        <img src="../../assets/images/the_wild_robot.jpg" class="img-fluid mb-3" alt="The Wild Robot">
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
                        <img src="../../assets/images/oppenheimer.jpg" class="img-fluid mb-3" alt="The Wild Robot">
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
                        <img src="../../assets/images/the_super_mario_bros2.jpg" class="img-fluid mb-3" alt="The Super Mario Bros 2">
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
                        <img src="../../assets/images/the_nun2.jpg" class="img-fluid mb-3" alt="The Nun 2">
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
                        <img src="../../assets/images/spider_man_across_spider_verse.jpg" class="img-fluid mb-3" alt="The Spider Man Across Spider Verse">
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
                        <img src="../../assets/images/venom_last_dance.jpg" class="img-fluid mb-3" alt="Venom The Last Dance">
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
    include('../../assets/php/config.php');  // Include the database connection

    // Query to get all movies that are "now showing"
    $query = "SELECT * FROM movies WHERE status = 'nowshowing'";
    $result = mysqli_query($conn, $query);

    // Check if there are any movies
    if (mysqli_num_rows($result) > 0) {
        // Loop through each movie
        while ($movie = mysqli_fetch_assoc($result)) {
        $movie_id = $movie['id'];  // Movie ID
        $movie_title = $movie['title'];  // Movie title
        $movie_description = $movie['description'];  // Movie description
        $movie_runtime = $movie['runtime'];  // Movie runtime
        $movie_director = $movie['director'];  // Movie director
        $movie_cast = $movie['cast'];  // Movie cast
        $movie_rating = $movie['rating'];  // Movie rating
        $movie_trailer = $movie['trailer_link'];  // Movie trailer link
        $movie_image = isset($movie['image_url']) ? $movie['image_url'] : 'default_image.jpg';  // Default image if none
        $movie_start_date = $movie['start_date'];  // Start date of the movie airing
        $movie_end_date = $movie['end_date'];  // End date of the movie airing
        $movie_time1 = date("h:i A", strtotime($movie['time1']));  // Convert to 12-hour format
        $movie_time2 = date("h:i A", strtotime($movie['time2']));  // Convert to 12-hour format
        $movie_time3 = date("h:i A", strtotime($movie['time3']));  // Convert to 12-hour format

        // Check if image exists, assuming images are stored in the "images" directory
        $image_path = "../../assets/images/" . $movie_image; // Assuming all images are in the "images" directory
        $sanitized_title = preg_replace('/[^A-Za-z0-9-]+/', '_', strtolower($movie_title));

        // Check if the image file exists in the images directory
        if (file_exists($image_path)) {
            $image_tag = "<img src='$image_path' class='img-fluid mb-3' alt='$movie_title'>";
        } else {
            $image_tag = "<p>Image not found</p>";  // Fallback message if image doesn't exist
        }

        // Create unique IDs for the modal
        $movie_idTrailerModal = "trailerModal" . $movie['id'];  // Unique modal ID
        $movie_idTrailerModalLabel = "trailerModalLabel" . $movie['id'];  // Unique modal label ID

        // Output HTML for this movie
        echo "
    <div class='container py-4'>
        <div class='row movie-card'>
            <div class='col-12 col-md-4 text-center movie-poster'>
                $image_tag
                <a href='details.php?movie_id=$movie[id]' class='button'>
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

            <!--- Royale Cinema Media --->
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
            
            <!---Royale Cinema Contacts--->
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
        // ToolTips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    
        // Stop video playback when modal is closed
        const modalElements = document.querySelectorAll('.modal');
        modalElements.forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function () {
                const iframe = modal.querySelector('iframe');
                iframe.src = iframe.src; // Reset the src to stop video playback
            });
        });
    });
    
    // Toggle dropdown visibility
    function toggleDropdown() {
        const dropdownMenu = document.getElementById("dropdownMenu");
        if (dropdownMenu.style.display === "block") {
            dropdownMenu.style.display = "none";
        } else {
            dropdownMenu.style.display = "block";
        }
    }
    
    // Change video based on URL and modal ID
    function changeVideo(url, modalId) {
        const modal = document.getElementById(modalId);
        const iframe = modal.querySelector('iframe');
        iframe.src = url; // Change the iframe's src to the correct video URL
    }
    


    </script>
    
</body>
</php>
