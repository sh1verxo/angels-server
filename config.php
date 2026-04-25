<?php
session_start();

$pdo = new PDO(
  "mysql:host=localhost;dbname=site",
  "webuser",
  "strongpassword",
  [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]
);
?>
