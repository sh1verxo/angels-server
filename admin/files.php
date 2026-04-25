<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: ../login.php");
    exit;
}

$baseDir = realpath(__DIR__ . "/.."); // /var/www/html

function safePath($baseDir, $path) {
    $full = realpath($baseDir . "/" . $path);
    if ($full === false) return false;
    if (strpos($full, $baseDir) !== 0) return false;
    return $full;
}

// DELETE FILE
if (isset($_GET['delete'])) {
    $file = safePath($baseDir, $_GET['delete']);
    if ($file && is_file($file)) {
        unlink($file);
    }
    header("Location: files.php");
    exit;
}

// SAVE FILE
if (isset($_POST['file']) && isset($_POST['content'])) {
    $file = safePath($baseDir, $_POST['file']);
    if ($file && is_file($file)) {
        file_put_contents($file, $_POST['content']);
    }
}

// OPEN FILE
$openFile = null;
$content = "";
if (isset($_GET['edit'])) {
    $file = safePath($baseDir, $_GET['edit']);
    if ($file && is_file($file)) {
        $openFile = $_GET['edit'];
        $content = file_get_contents($file);
    }
}

// LIST FILES
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($baseDir)
);
?>

<h2>File Manager</h2>

<h3>Files</h3>
<ul>
<?php foreach ($files as $file):
    if ($file->isDir()) continue;
    $path = str_replace($baseDir . "/", "", $file->getPathname());
?>
<li>
    <?php echo htmlspecialchars($path); ?>
    <a href="?edit=<?php echo urlencode($path); ?>">Edit</a>
    <a href="?delete=<?php echo urlencode($path); ?>">Delete</a>
</li>
<?php endforeach; ?>
</ul>

<?php if ($openFile): ?>
<hr>
<h3>Editing: <?php echo htmlspecialchars($openFile); ?></h3>

<form method="POST">
<input type="hidden" name="file" value="<?php echo htmlspecialchars($openFile); ?>">
<textarea name="content" rows="20" cols="80"><?php echo htmlspecialchars($content); ?></textarea>
<br>
<button type="submit">Save</button>
</form>
<?php endif; ?>
