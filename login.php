<?php
require_once "config.php";

$stmt = $pdo->query("SELECT COUNT(*) FROM users");
if ($stmt->fetchColumn() == 0) {
    header("Location: setup.php");
    exit;
}

if ($_POST) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute(["admin"]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['auth'] = true;
        header("Location: admin/dashboard.php");
        exit;
    } else {
        echo "Invalid login";
    }
}
?>

<h2>Login</h2>

<form method="POST">
    <input name="password" type="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
