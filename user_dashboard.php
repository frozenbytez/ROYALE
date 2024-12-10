<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h2>Welcome, <?= $_SESSION['user'] ?>!</h2>
    <p>User functionalities go here.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
