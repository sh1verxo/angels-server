<?php
require_once "../config.php";
session_start();

if (!isset($_SESSION['auth'])) {
    header("Location: ../login.php");
    exit;
}

$result = null;
$error = null;

if ($_POST) {
    $query = trim($_POST['query']);

    // safety check: only allow SELECT
    if (stripos($query, "select") !== 0) {
        $error = "Only SELECT queries allowed";
    } else {
        try {
            $stmt = $pdo->query($query);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    }
}
?>

<h2>SQL Viewer (SELECT only)</h2>

<form method="POST">
<textarea name="query" rows="5" cols="60"></textarea>
<br>
<button type="submit">Run</button>
</form>

<?php if ($error): ?>
<p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<?php if ($result): ?>
<table border="1">
<tr>
<?php foreach (array_keys($result[0]) as $col): ?>
<th><?php echo $col; ?></th>
<?php endforeach; ?>
</tr>

<?php foreach ($result as $row): ?>
<tr>
<?php foreach ($row as $val): ?>
<td><?php echo htmlspecialchars($val); ?></td>
<?php endforeach; ?>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
