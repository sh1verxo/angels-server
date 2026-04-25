<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: ../login.php");
    exit;
}
?>

<h1>Admin Panel</h1>

<ul>
  <li><a href="edit.php">Edit Site Content</a></li>
  <li><a href="sql.php">SQL Viewer</a></li>
  <li><a href="../logout.php">Logout</a></li>
</ul>
