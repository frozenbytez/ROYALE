<?php
session_start();

$conn_user = new mysqli('localhost', 'root', '', 'login_system');


$conn_admin = new mysqli('localhost', 'root', '', 'admin_system');

if ($conn_user->connect_error) {
    die("Connection failed: " . $conn_user->connect_error);
}

if ($conn_admin->connect_error) {
    die("Connection failed: " . $conn_admin->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

  
    $stmt_user = $conn_user->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt_user->bind_param('ss', $email, $password);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();

    $stmt_admin = $conn_admin->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt_admin->bind_param('ss', $email, $password);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();

    if ($result_admin->num_rows === 1) {
        $user = $result_admin->fetch_assoc();
        if ($user['is_admin'] == 1) {
            $_SESSION['admin'] = $user['first_name'];
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password!";
        }
    } 
    else if ($result_user->num_rows === 1) {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <title>Login</title>
      <link rel="stylesheet" href="Asset/css/login2.css">
  
</head>

<body>
    <video autoplay muted loop playsinline class="background-video">
        <source src="Asset/images/signupbg.mp4" type="video/mp4">
    </video>
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container-fluid">
            <a class="navbar-brand fs-4" href="home.html">
                <img src="stylesheet/images/logo.png" alt="Logo" style="height: 40px;">
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
                            <a class="nav-link" href="../home.php">Home</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="nowshowing.html">Now Showing</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="comingSoon.html">Upcoming</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="contact.html">Contact Us</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link active" aria-current="page" href="login2.html">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="col-12 col-md-6 ms-auto">
    <div class="login-container">
        <h1>LOGIN</h1>
        
        <!-- PHP Error Message Display -->
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        
        <form method="POST">
            <!-- Email Field -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email..." required>
            </div>
            
            <!-- Password Field -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password..." required>
            </div>
            
            <!-- Forgot Password Link -->
            <div class="mb-3">
                <a href="#">Forgot password?</a>
            </div>
            
            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            
            <!-- Sign Up Link -->
            <div class="text-center mt-3">
                <small>Don't have an account? <a href="../Pages/signup.html">Sign up</a></small>
            </div>
        </form>
    </div>
</div>

</body>
</html>
