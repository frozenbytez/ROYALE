
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
            header("Location: pages/dashboard.php");
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
    <title>Sign</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
  font-family: Arial, sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #333;
  color: #fff;
  margin: 0;
  flex-direction: column;
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

.navbar-brand {
  margin-left: 33px;
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

.content {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  height: 100%;
  padding: 3rem;
  color: white;
}
.left-text h1 {
  font-size: 5rem;
  font-weight: bold;
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
}

.left-text p {
  font-size: 1.25rem;
  font-weight: 400;
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
}

.login-container {
  background: rgba(19, 7, 46, 0.85); 
  border-radius: 20px;
  color: white;
  padding: 2rem;
  max-width: 400px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  margin-left: auto;
  
}
.d-grid button {
  background-color: #502779;
  color: white;
}

.d-grid:hover {
  background-color: #5a379e;
}

.login-card h2 {
  text-align: center;
  margin-bottom: 1.5rem;
}

.form-toggle {
  display: flex;
  justify-content: center;
  margin-bottom: 15px;
}

.form-toggle span {
  margin: 0 10px;
  cursor: pointer;
  padding: 5px 10px;
  color: #ccc;
}

.form-toggle .active {
  color: #fff;
  border-bottom: 2px solid #fff;
}

form input {
  background: rgba(19, 7, 46, 0.85); 
  border-radius: 20px;
  color: white;
  padding: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  margin-bottom: 10px;
  width: 100%;
}

form button {
  width: 100%;
  padding: 10px;
  border: none;
  border-radius: 5px;
  background-color: #000000; /* Custom color */
  color: #fff;
  font-size: 16px;
  cursor: pointer;
}
.forgot-password {
  display: block;
  margin-top: 10px;
  color: #ccc;
  text-decoration: none;
  font-size: 12px;
}
@media (max-width: 991px) {
  .sidebar {
      background-color: rgba(225, 225, 225, 0.15);
      backdrop-filter: blur(10px);
  }
}
@media (max-width: 768px) {
  .content {
      flex-direction: column;
      padding: 1rem;
      justify-content: flex-start; 
  }

  .left-text h1 {
      font-size: 2.5rem;
  }

  .left-text p {
      font-size: 1.1rem;
  }

  .signup-card {
      width: 90%;
  }
}

    </style>
</head>
<body>
    <video autoplay muted loop playsinline class="background-video">
        <source src="Asset/images/login.mp4" type="video/mp4">
    </video>

    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container-fluid">
        <a class="navbar-brand fs-4" href="home.html">
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
                            <a class="nav-link" href="home.php">Home</a>
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
                            <a class="nav-link active" aria-current="page" href="login2.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <br><br>
    <div class="content container">
        <div class="left-text col-12 col-md-6">
            <h1>Login Now!</h1>
            <p>Enjoy watchig with us!</p>
        </div>

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
    <div class="input-group">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        <button type="button" class="btn btn-secondary" id="togglePassword">
            Show
        </button>
    </div>
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
                        <small>Don't have an account? <a href="signup.php">Sign up</a></small>
                    </div>
                </form>
            </div>
        </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.form-toggle span').forEach((tab) => {
            tab.addEventListener('click', function () {
                document.querySelectorAll('.form-toggle span').forEach((t) => t.classList.remove('active'));
                this.classList.add('active');
                const formAction = this.textContent.trim() === "User" ? "Admin" : "Login";
                document.querySelector("form button").textContent = formAction;
            });
        });

        document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const toggleButton = this;
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            toggleButton.textContent = 'Show';
        }
    });

    // Toggle visibility for the confirm password field
    document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
        const confirmPasswordInput = document.getElementById('confirm-password');
        const toggleButton = this;
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
            toggleButton.textContent = 'Hide';
        } else {
            confirmPasswordInput.type = 'password';
            toggleButton.textContent = 'Show';
        }
    });
    </script>
</body>
</html>
