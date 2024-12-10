<?php
session_start();


// Connection for user database (login_system)
$conn_user = new mysqli('localhost', 'root', '', 'login_system');

// Connection for admin database (admin_system)
$conn_admin = new mysqli('localhost', 'root', '', 'admin_system');

// Check connection for user database
if ($conn_user->connect_error) {
    die("Connection failed: " . $conn_user->connect_error);
}

// Check connection for admin database
if ($conn_admin->connect_error) {
    die("Connection failed: " . $conn_admin->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    

    // Check if the user exists in the login_system database
    $stmt_user = $conn_user->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt_user->bind_param('ss', $email, $password);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    // Check if the user exists in the admin_system database
    $stmt_admin = $conn_admin->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt_admin->bind_param('ss', $email, $password);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    

    // Check if user is an admin
    if ($result_admin->num_rows === 1) {
        $user = $result_admin->fetch_assoc();
        if ($user['is_admin'] == 1) {
            $_SESSION['admin'] = $user['first_name'];
            header("Location: ../admin/add_movie.php");
            exit();
        } else {
            $error = "Invalid email or password!";
        }
    } 
    // Check if user is a regular user
    else if ($result_user->num_rows === 1) {
        $user = $result_user->fetch_assoc();
        $_SESSION['user'] = $user['first_name'];
        header("Location: ../user/user-home.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <title>Login</title>
    <link rel="stylesheet" href="stylesheet/login.css">
</head>
<style>
body {
  font-family: 'Poppins', sans-serif;
  margin: 0;
  padding: 0;
  height: 100vh;
  overflow: hidden; 
}

.background-video {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: -1;
}

.navbar {
  background-color: rgba(0, 0, 0, 0.6);
}

.login-container {
  width: 300px;
  padding: 20px;
  border: 2px solid #776262;
  border-radius: 10px;
  background-color: white;
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  transition: all 0.3s ease; 
}
.login-container h1 {
  font-size: 24px;
  margin-bottom: 20px;
}

.login-container input[type="email"],
.login-container input[type="password"] {
  width: 100%;
  padding: 10px;
  margin: 10px 0;
  border-radius: 10px;
  border: none;
  background-color: #e0e0e0;
  font-size: 16px;
}

.login-container a {
  color: #00a9c6;
  text-decoration: none;
  font-size: 14px;
}

.login-container button {
  width: 100%;
  padding: 10px;
  margin: 20px 0;
  border: none;
  border-radius: 10px;
  background-color: #00a9c6;
  color: white;
  font-size: 16px;
  cursor: pointer;
}

.login-container p {
  font-size: 14px;
}

.login-container p a {
  color: #000;
}

@media (max-width: 768px) {
  .login-container {
      width: 80%;
      max-width: 400px;
  }
}

@media (max-width: 576px) {
  .login-container {
      position: static;
      margin: 0 auto;
      top: auto;
      transform: none;
      width: 90%;
      max-width: 400px;
  }
}
</style>
<body>
    <video autoplay muted loop playsinline class="background-video">
        <source src="../../assets/images/login.mp4" type="video/mp4">
    </video>
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container">
            <a class="navbar-brand fs-4" href="index.php">
                <img src="../../assets/images/logo.png" alt="Logo" style="height: 40px;">
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
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="#">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="login-container">
        <h1>LOGIN</h1>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <a href="#">Forgot password?</a>
            <button type="submit">LOGIN</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
</body>
</html>
