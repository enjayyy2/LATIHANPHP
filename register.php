<?php
include "service/database.php";
session_start();

$register_message = "";

if (isset($_SESSION["is_login"])) {
    // Jika pengguna sudah login dan bukan admin, arahkan ke dashboard
    if ($_SESSION["role"] !== "admin") {
        header("location: user_dashboard.php");
        exit;
    }
}

if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $role = $_POST["role"]; // Menangkap role dari form
    $hash_password = hash("sha256", $password);

    // **Pembatasan pendaftaran admin**
    if ($role === "admin") {
        if (!isset($_SESSION["is_login"]) || $_SESSION["role"] !== "admin") {
            $register_message = "Hanya admin yang dapat membuat akun admin!";
            echo $register_message; // Pesan error langsung ditampilkan
            exit;
        }
    }

    try {
        // Query untuk menyimpan username, password, dan role
        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$hash_password', '$role')";

        if ($db->query($sql)) {
            $register_message = "Daftar akun berhasil, silakan login!";
        } else {
            $register_message = "Daftar akun gagal, silakan coba lagi!";
        }
    } catch (mysqli_sql_exception) {
        $register_message = "Username sudah ada, tolong gunakan yang lain.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>

    <?php include "layout/header.html" ?>

    <h3>DAFTAR AKUN</h3>
    <i><?= $register_message ?></i>
    <form action="register.php" method="POST"> 
        <input type="text" placeholder="Username" name="username" required />
        <input type="password" placeholder="Password" name="password" required />

        <!-- Pilihan role -->
        <label for="role">Daftar Sebagai:</label>
        <select name="role" id="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit" name="register">Daftar Sekarang</button>
    </form>

    <?php include "layout/footer.html" ?>
</body>
</html>
