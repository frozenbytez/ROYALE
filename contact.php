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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Contact</title>
    <style>
        
body {
  background-color: #060930;
  color: #FFFFFF;
  font-family: Arial, sans-serif;
  padding-top: 50px;
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


.contact-section {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  padding: 40px;
  background-image: url(images/contact3.png); 
  background-size: cover; 
  background-position: center; 
  background-repeat: no-repeat; 
  color: #FFFFFF; 
}

.contact-info, .contact-form {
  flex: 1;
  min-width: 300px;
  max-width: 500px;
  margin: 20px;
  padding: 20px;
  background-color: #060930;
  border-radius: 10px;
}

.contact-info h2, .contact-form h2 {
  font-size: 24px;
  color: #FFFFFF;
  margin-bottom: 20px;
  text-align: center;
}

.contact-info p {
    display: flex;
    align-items: center;
    color: #BBBBBB;
    margin: 15px 0;
    font-size: 1.1em;
    padding-bottom: 10px; 
    border-bottom: 1px solid #b69797;
    margin-bottom: 15px;
}
  
  .contact-info p i {
    margin-right: 15px;
    color: #b59ccc;
    font-size: 1.3em;
  }
  

  .contact-form {
    background-color: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    margin: 20px auto; 
  }
  
  .contact-form h2 {
    text-align: center;
    color: #FFFFFF;
    margin-bottom: 20px;
  }
  
  .contact-form input,
  .contact-form textarea {
    width: 100%;
    padding: 12px 1px;
    margin: 10px 0;
    border: 1px solid #888888;
    border-radius: 5px;
    background-color: #f5f5f5;
    font-size: 1em;
    color: #333333;
  }
  
  .contact-form input:focus,
  .contact-form textarea:focus {
    outline: none;
    border-color: #0b1f9d;
    background-color: #FFFFFF;
    box-shadow: 0px 0px 5px rgba(138, 43, 226, 0.5);
  }
  .contact-form button {
    width: 100%;
    padding: 12px;
    background-color: #8A2BE2;
    color: #FFFFFF;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s ease;
  }
  .contact-form button:hover {
    background-color: #6a1bb8;
  }

  body, .full-width-container {
   padding: 0;
   margin: 0;
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
  background-color: #092635;
  color: rgb(255, 255, 255);
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.footer-section button[type="submit"]:hover {
  background-color: #092635;
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
                        <li class="nav-item mx-2">
                            <span class="nav-link">Hello, <?php echo $_SESSION['user'] ?? $_SESSION['admin']; ?></span>
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
    
</body>
</html>
