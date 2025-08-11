<?php
require_once __DIR__ . '/../db.php';

if (!empty($_GET['username'])) {
    $username = trim($_GET['username']);
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        echo "<span class='error'>Username taken</span>";
    } else {
        echo "<span class='success'>Username available</span>";
    }
}
