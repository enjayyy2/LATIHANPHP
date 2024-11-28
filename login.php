<?php
include "service/database.php";
session_start();

$login_message = "";

if (isset($_SESSION["is_login"])) {
    header("location: dashboard.php");
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Menangkap role dari form
    $hash_password = hash("sha256", $password);

    // Query untuk memverifikasi username, password, dan role
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$hash_password' AND role='$role'";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        $_SESSION["username"] = $data["username"];
        $_SESSION["role"] = $data["role"];
        $_SESSION["is_login"] = true;

        // Redirect berdasarkan role
        if ($data["role"] === "admin") {
            header("location: admin_dashboard.php");
        } else {
            header("location: user_dashboard.php");
        }
    } else {
        $login_message = "Username, Password, atau Role Salah!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

    <?php include "layout/header.html" ?>

    <h3>MASUK AKUN</h3>
    <i><?= $login_message ?></i>
    <form action="login.php" method="POST">
        <input type="text" placeholder="Username" name="username" required />
        <input type="password" placeholder="Password" name="password" required />
        
        <!-- Pilihan login sebagai Admin atau User -->
        <label for="role">Login Sebagai:</label>
        <select name="role" id="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit" name="login">Masuk Sekarang</button>
    </form>

    <?php include "layout/footer.html" ?>
</body>
</html>
