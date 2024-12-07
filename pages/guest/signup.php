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
    <title>Responsive Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<style>
    body, php {
        margin: 0;
        height: 100%;
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

    .signup-card {
        background: rgba(19, 7, 46, 0.85);
        border-radius: 20px;
        color: white;
        padding: 2rem;
        max-width: 400px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        margin-left: auto;
    }

    .signup-card h2 {
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .signup-card .form-control {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        border: none;
        color: black;
    }

    .signup-card .form-control:focus {
        background-color: #f7e7e7;
        color: black;
        outline: none;
        box-shadow: none;
    }

    .signup-card button {
        background-color: #502779;
        color: white;
    }

    .signup-card button:hover {
        background-color: #5a379e;
    }

    .signup-card a {
        color: #a887fa;
    }

    .signup-card a:hover {
        text-decoration: underline;
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
</style>
<body>
    <!-- Background Video -->
    <video autoplay muted loop playsinline class="background-video">
        <source src="../../assets/images/signupbgbg.mp4" type="video/mp4">
    </video>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
        <div class="container-fluid">
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

    <!-- Content -->
    <div class="content container">
        <!-- Left Text -->
        <div class="left-text col-12 col-md-6">
            <h1>Sign up Now!</h1>
            <p>Create Your Account and Get ready to experience movies like never before.</p>
        </div>

        <!-- Right Form -->
        <div class="col-12 col-md-6 ms-auto"> <!-- Add ms-auto here to push to the right -->
            <div class="signup-card">
                <h2>Sign Up</h2>

                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?= $error_message; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</php>
