<?php
session_start();  // Start the session to use session variables
include('../../assets/php/config.php');  // Include database connection

$loggedIn = isset($_SESSION['user']) || isset($_SESSION['admin']);
$first_name = $_SESSION['user'] ?? $_SESSION['admin'] ?? '';
?>
<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../assets/css/guest/contact.css">
    <title>Contact</title>
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
                        <a class="nav-link" href="nowshowing.php">Now Showing</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="comingSoon.php">Upcoming</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link active" aria-current="page" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item mx-2">
                            <?php if ($loggedIn): ?>
                                <a class="nav-link" href="../guest/logout.php">Logout (<?php echo htmlspecialchars($first_name); ?>)</a>
                            <?php else: ?>
                                <a class="nav-link" href="../guest/login.php">Login</a>
                            <?php endif; ?>
                        </li>
                </ul>
            </div>
        </div>
    </div>
</nav> <br> <br> <br>
<!-------------------------------------------------------------------------------------------------------------------------------------------->
<div class="container-fluid full-width-container">
  <div class="row g-0"> 
    <div class="col-12">
      <div class="full-width-image">
        <img src="../../assets/images/contacts2.png" alt="Sample Image">
      </div>
    </div>
  </div>
</div>

<!-------------------------------------------------------------------------CONTACTS DETAILS----------------------------------------------------->

<section class="contact-section">
  <div class="contact-info">
      <h2>Royale Cinema</h2>
      <i>Reach out to our dedicated team for any inquiries, assistance, or information you need.</i>
      <p><i class="fas fa-envelope"></i> Royale.Cinema@gmail.com</p>
      <p><i class="fas fa-map-marker-alt"></i> 123 Anywhere St., Any City</p>
      <p><i class="fas fa-globe"></i> www.royale_cinema.com</p>
      <p><i class="fas fa-phone"></i> +123-456-7890</p>
  </div>
  <div class="contact-form">
      <form>
          Email
          <input type="email" placeholder="Enter Email" required>
          Password
          <input type="password" placeholder="Enter Password" required>
          How Can We Help You?
          <textarea placeholder="Your Message" rows="4" required></textarea>
          <button type="submit">Send</button>
      </form>
  </div>
</section>

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
    
</body>
</php>