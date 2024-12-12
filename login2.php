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
    <title>Login</title>
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



        .login-container {
            background-color: #112049;
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .logo img {
            max-width: 100%;
            margin-bottom: 20px;
        }
        .form-container {
            position: relative;
            width: 100%;
            margin-bottom: 15px;
        }
        .form-container input {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            outline: none;
            background-color: #fff;
            color: #333;
        }
        .form-container button {
          position: absolute;
        right: 26px;
        top: 50%;
        transform: translateY(-50%);
        background-color: #000; /* Black button */
        color: #fff; /* White text */
        border: none;
        padding: 13px 11px;
        cursor: pointer;
        font-size: 12px;
        border-radius: 5px;
        outline: none;
        }
        .form-container button:hover {
            background-color: #333;
        }
        .login-btn {
            width: 80%;
            padding: 10px;
            background-color: #1a73e8;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .signup-link {
            margin-top: 10px;
            font-size: 12px;
        }
        .signup-link a {
            color: #1a73e8;
            text-decoration: none;
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
    </style>
</head>
<body>

<video autoplay muted loop playsinline class="background-video">
        <source src="Asset/images/videobg.mp4" type="video/mp4">
    </video>

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
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="history.php">View History</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                          </li>

                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</nav>




    <div class="login-container">
        <div class="logo">
            <img src="Asset/images/whitelogo.png" alt="Royale Cinema Logo">
        </div>
        <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
        <form method="POST">
            <div class="form-container">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-container">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="button" id="toggle-password">Show</button>
            </div>
            <button type="submit" class="login-btn">LOGIN</button>
            <p class="signup-link">
                Don’t have an account? <a href="signup.php">Sign up</a>
            </p>
        </form>
    </div>

    <script>
        // Toggle visibility for email
    

        // Toggle visibility for password
        const passwordInput = document.getElementById('password');
        const togglePasswordBtn = document.getElementById('toggle-password');

        togglePasswordBtn.addEventListener('click', () => {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                togglePasswordBtn.textContent = 'Hide';
            } else {
                passwordInput.type = 'password';
                togglePasswordBtn.textContent = 'Show';
            }
        });
    </script>
</body>
</html>
