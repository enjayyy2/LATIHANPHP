<?php
session_start();
if (!isset($_SESSION["is_login"]) || $_SESSION["role"] !== "user") {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Selamat Datang, <?= $_SESSION["username"]; ?></h1>
    <a href="logout.php">Logout</a>
</body>
</html>