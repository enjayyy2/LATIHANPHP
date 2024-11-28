<?php
session_start();
if (!isset($_SESSION["is_login"]) || $_SESSION["role"] !== "admin") {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Selamat Datang, Admin <?= $_SESSION["username"]; ?></h1>
    <a href="logout.php">Logout</a>
</body>
</html>
