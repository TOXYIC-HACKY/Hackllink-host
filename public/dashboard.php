<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
    <nav>
        <a href="#">Feature 1</a>
        <a href="#">Feature 2</a>
        <a href="#">Feature 3</a>
        <a href="logout.php">Logout</a>
    </nav>
</div>
</body>
</html>
