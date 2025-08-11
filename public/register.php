<?php
session_start();
require_once __DIR__ . '/../db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if ($username && $email && $password) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetch()) {
            $message = "<p class='error'>Username already taken.</p>";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
            if ($stmt->execute([$username, $email, $hash])) {
                $message = "<p class='success'>Registration successful. <a href='login.php'>Login</a></p>";
            } else {
                $message = "<p class='error'>Registration failed.</p>";
            }
        }
    } else {
        $message = "<p class='error'>All fields are required.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <script>
    function checkUsername() {
        const username = document.getElementById("username").value;
        if (username.length > 0) {
            fetch(`check_username.php?username=${encodeURIComponent(username)}`)
            .then(res => res.text())
            .then(data => document.getElementById("userCheck").innerHTML = data);
        }
    }
    </script>
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <?= $message ?>
    <form method="post">
        <input type="text" id="username" name="username" placeholder="Username" onkeyup="checkUsername()" required>
        <span id="userCheck"></span>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</div>
</body>
</html>
