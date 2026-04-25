<?php
require_once "../config.php";
session_start();

if (!isset($_SESSION['auth'])) {
    header("Location: ../login.php");
    exit;
}

if ($_POST) {
    $stmt = $pdo->prepare("
        INSERT INTO content (page, body)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE body = VALUES(body)
    ");
    $stmt->execute(["home", $_POST['body']]);
    echo "Saved";
}

$stmt = $pdo->prepare("SELECT body FROM content WHERE page = ?");
$stmt->execute(["home"]);
$current = $stmt->fetchColumn();
?>

<h2>Edit Home Page</h2>

<form method="POST">
<textarea name="body" rows="10" cols="50"><?php echo htmlspecialchars($current); ?></textarea>
<br>
<button type="submit">Save</button>
</form>
