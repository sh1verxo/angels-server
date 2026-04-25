<?php
require_once "config.php";

$stmt = $pdo->prepare("SELECT body FROM content WHERE page = ?");
$stmt->execute(["home"]);
$content = $stmt->fetchColumn();

echo $content ?: "No content set";
?>

<br>
<a href="login.php">Admin Login</a>
