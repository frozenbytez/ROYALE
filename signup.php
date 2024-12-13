<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'login_system');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = ''; // Initialize the error message
$success_message = ''; // Initialize success message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate phone number is numeric and has exactly 11 digits
    if (!is_numeric($phone_number) || strlen($phone_number) != 11) {
        $phone_error_message = "Phone number must be 11 digits and numeric.";
    }

    // Check if passwords match
    if ($password === $confirm_password) {
        $hashed_password = md5($password);

        // Check if the email or phone number already exists
        $email_check = "SELECT * FROM users WHERE email = '$email'";
        $phone_check = "SELECT * FROM users WHERE phone_number = '$phone_number'";

        $result_email = $conn->query($email_check);
        $result_phone = $conn->query($phone_check);

        if ($result_email->num_rows > 0) {
            $email_error_message = "Email is already registered!";
        }
        
        if ($result_phone->num_rows > 0) {
            $phone_error_message = "Phone number is already registered!";
        }

        if (empty($email_error_message) && empty($phone_error_message)) {
            // If no issues, insert the new user
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone_number, password) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssss', $first_name, $last_name, $email, $phone_number, $hashed_password);

            if ($stmt->execute()) {
                $success_message = "Account created successfully! Redirecting to login page...";
                $_SESSION['success'] = $success_message;
                // Use JavaScript to show modal and redirect after 2 seconds
                echo "<script>setTimeout(function() { showSuccessModal(); }, 500);</script>";
            } else {
                $error_message = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $password_error_message = "Passwords do not match!";
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sign-Up</title>
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
            padding: 15px;
            border-radius: 10px;
            width: 390px;
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
            width: 100%;
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
    gap: 10px; /* Set gap to 0 to eliminate the spacing */
}

.name-group input {
    width: 100%; /* Adjust the width slightly to ensure the inputs fit well */
}
        .show-password {
            position: absolute;
            right: -1px;
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
        .error-message {
        font-size: 12px;
        color: #f44336;  /* Red color for error */
        }
/* Modal container */
.modal-container {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(0, 0, 0, 0.7); /* Dark background */
    color: white;
    padding: 30px;
    border-radius: 10px;
    text-align: center;
    z-index: 1051;  /* Ensure it appears above other content */
    width: 80%;
    max-width: 500px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5); /* Optional: shadow for a 3D effect */
}

/* Background blur effect */
.body.modal-active {
    backdrop-filter: blur(5px);
    transition: backdrop-filter 0.3s ease; /* Smooth blur transition */
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

.modal-container {
    animation: fadeIn 0.5s ease-in-out;
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
                            <a class="nav-link active"  aria-current="page" href="login2.php">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

 <!-- Display Error Message if Exists -->
    <?php if (!empty($error_message)): ?>
        <div class="alert alert-danger"><?= $error_message; ?></div>
    <?php endif; ?>
  <!-- Sign Up Form -->
  <div class="signup-form">
  <div class="logo">
        <img src="Asset/images/whitelogo.png" alt="Royale Cinema Logo">
    </div>
        <form action="#" method="post">
            <div class="form-group name-group">
                <input type="text" id="first-name" name="first_name" placeholder="First Name" required>
                <input type="text" id="last-name" name="last_name" placeholder="Last Name" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <input type="email" id="email" name="email" placeholder="Email" required>
                <div id="email-error" class="error-message"></div>
            </div>

            <!-- Phone Number -->
            <div class="form-group">
                <input type="number" id="phone_number" name="phone_number" placeholder="Phone Number" required>
                <div id="phone-error" class="error-message"></div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <button type="button" class="show-password" onclick="togglePassword('password')">Show</button>
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group">
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required>
                <button type="button" class="show-password" onclick="togglePassword('confirm-password')">Show</button>
                <div id="password-error" class="error-message"></div>
            </div>

            <button type="submit">Sign Up</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login2.php">Login</a>
        </div>
    </div>
<!-- Sign Up Form (existing code remains unchanged) -->

<div id="successModal" style="display:none;">
    <h4>Account Created Successfully!</h4>
    <p>You will be redirected to the login page shortly...</p>
</div>

<!-- JavaScript -->
<script>
    document.getElementById('phone_number').addEventListener('input', clearPhoneError);
    document.getElementById('email').addEventListener('input', clearEmailError);
    document.getElementById('password').addEventListener('input', clearPasswordError);
    document.getElementById('confirm-password').addEventListener('input', clearPasswordError);

    function clearPhoneError() {
        const phoneError = document.getElementById('phone-error');
        if (phoneError) {
            phoneError.textContent = '';
        }
    }

    function clearEmailError() {
        const emailError = document.getElementById('email-error');
        if (emailError) {
            emailError.textContent = '';
        }
    }

    function clearPasswordError() {
        const passwordError = document.getElementById('password-error');
        if (passwordError) {
            passwordError.textContent = '';
        }
    }

    function validatePhoneNumber() {
        const phoneNumber = document.getElementById('phone_number').value;
        const phoneError = document.getElementById('phone-error');

        if (!/^\d{11}$/.test(phoneNumber)) {
            phoneError.textContent = 'Phone number must be 11 digits and numeric.';
        }
    }

    function validateEmail() {
        const email = document.getElementById('email').value;
        const emailError = document.getElementById('email-error');

        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            emailError.textContent = 'Please enter a valid email.';
        }
    }

    function togglePassword(inputId) {
        var input = document.getElementById(inputId);
        var button = input.nextElementSibling;

        if (input.type === 'password') {
            input.type = 'text';  
            button.textContent = 'Hide';  
        } else {
            input.type = 'password';  
            button.textContent = 'Show';  
        }
    }

    document.getElementById('phone_number').addEventListener('blur', validatePhoneNumber);
    document.getElementById('email').addEventListener('blur', validateEmail);

    function showSuccessModal() {
        var modal = document.getElementById('successModal');
        var body = document.body;
        
        // Show modal
        modal.style.display = 'block';

        // Apply the blur effect to the body
        body.classList.add('modal-active');
        
        // Redirect after 5 seconds
        setTimeout(function() {
            window.location.href = 'login2.php';  // Redirect to login page
        }, 5000);

        // After the timeout, remove the blur effect from the body
        setTimeout(function() {
            body.classList.remove('modal-active');
        }, 5000);
    }
</script>

</body>
</html>