<?php
require_once "config.php";

$stmt = $pdo->query("SELECT COUNT(*) FROM users");
if ($stmt->fetchColumn() > 0) {
    header("Location: login.php");
    exit;
}

if ($_POST) {
    $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute(["admin", $hash]);

    header("Location: login.php");
    exit;
}
?>

<h2>Initial Setup</h2>

<form method="POST">
    <input name="password" type="password" placeholder="Create admin password" required>
    <button type="submit">Create Admin</button>
</form>
