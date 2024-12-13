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
    <link rel="stylesheet" href="Asset/css/contact.css">
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

<!-------------------------------------------------------------------------------------------------------------------------------------------->
<div class="container-fluid full-width-container">
  <div class="row g-0"> 
    <div class="col-12">
      <div class="full-width-image">
        <img src="Asset/images/contacts2.png" alt="Sample Image">
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
          How Can We Help You?
          <textarea placeholder="Your Message" rows="4" required></textarea>
          <button type="submit">Send</button>
      </form>
  </div>
</section>

     <!--------------------------------------------------------------FOOTER------------------------------------------------------------------->

    <footer class="footer">
      <div class="footer-container">

          <div class="footer-section">
              <img src="Asset/images/logo.png" alt="Logo" class="logo">
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
