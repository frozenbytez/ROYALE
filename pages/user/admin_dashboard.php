<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome, Admin <?= $_SESSION['admin'] ?>!</h2>
    <p>Admin functionalities go here.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
