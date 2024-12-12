<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'login_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password === $confirm_password) {
        $hashed_password = md5($password);

        // Check if the email or phone number already exists
        $email_check = "SELECT * FROM users WHERE email = '$email'";
        $phone_check = "SELECT * FROM users WHERE phone_number = '$phone_number'";

        $result_email = $conn->query($email_check);
        $result_phone = $conn->query($phone_check);

        if ($result_email->num_rows > 0) {
            $error_message = "Email is already registered!";
        } elseif ($result_phone->num_rows > 0) {
            $error_message = "Phone number is already registered!";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone_number, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssss', $first_name, $last_name, $email, $phone_number, $hashed_password);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Account created successfully! Please login.";
                header("Location: login.php");
                exit();
            } else {
                $error_message = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $error_message = "Passwords do not match!";
    }
}

$conn->close();
?>

<!DOCTYPE php>
<php lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
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
        .signup-form {
            background-color: #0e1538;
            padding: 5px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        .signup-form h2 {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #fff;
        }
        .form-group {
            margin-bottom: 15px;
            position: relative;
        }
        label {
            font-size: 14px;
            margin-bottom: 5px;
            display: block;
        }
        input {
            width: calc(100% - 60px);
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            background-color: #f8f9fc;
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
            display: inline-block;
        }
        .name-group {
            display: flex;
            justify-content: space-between;
            gap: 0px;
        }
        .name-group input {
            width: 65%;
        }
        .show-password {
            position: absolute;
            right: 28px;
            top: 22px;
            transform: translateY(-50%);
            background-color: #000;
            color: #fff;
            border: none;
            padding: 6px 8px;
            cursor: pointer;
            font-size: 12px;
            border-radius: 5px;
            outline: none;
            width: 70px;
            height: 44px;
        }
        .show-password:hover {
            background-color: #7a3eb7;
        }
        button {
            width: 80%;
            padding: 10px;
            background-color: #1a73e8;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        button:hover {
            background-color: #7a3eb7;
        }
        .login-link {
            margin-top: 20px;
            font-size: 14px;
        }
        .login-link a {
            color: #9b4de5;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
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


    .background-video {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1;
    }
    .logo img {
            max-width: 80%;
            margin-bottom: 20px;
        }

</style>
<body>
    <!-- Background Video -->
    <video autoplay muted loop playsinline class="background-video">
        <source src="Asset/images/videobg.mp4" type="video/mp4">
    </video>

    <!-- Navbar -->
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
                            <a class="nav-link" href="nowshowing.php">Now Showing</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="comingSoon.php">Upcoming</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link" href="contact.php">Contact Us</a>
                        </li>
                        <li class="nav-item mx-2">
                            <a class="nav-link active"  aria-current="page" href="login.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    

                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?= $error_message; ?></div>
                <?php endif; ?>

                <div class="signup-form">
                <div class="login-container">
        <div class="logo">
            <img src="Asset/images/whitelogo.png" alt="Royale Cinema Logo">
        </div>
        <form action="#" method="post">
            <!-- First Name and Last Name -->
            <div class="form-group name-group">
                <div>
                    <input type="text" id="first-name" name="first_name" placeholder="First Name" required>
                </div>
                <div>
                    <input type="text" id="last-name" name="last_name" placeholder="Last Name" required>
                </div>
            </div>

            <!-- Email -->
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </div>

            <!-- Phone Number -->
            <div class="form-group">
                <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>
            </div>

            <!-- Password -->
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="button" class="show-password" onclick="togglePassword('password')">Show</button>
            </div>

            <!-- Confirm Password -->
            <div class="form-group">
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="button" class="show-password" onclick="togglePassword('confirm-password')">Show</button>
            </div>

            <!-- Submit Button -->
            <button type="submit">LOGIN</button>
        </form>
        
        <div class="login-link">
            Already have an account? <a href="#">Sign up</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script>
    // Toggle visibility for the main password field
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
</php>
