<?php
session_start();

if (!isset($_SESSION['auth'])) {
    header("Location: ../login.php");
    exit;
}
?>

<h1>Admin Dashboard</h1>

<p>Logged in successfully.</p>

<a href="../logout.php">Logout</a>