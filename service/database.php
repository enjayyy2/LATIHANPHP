<?php

    $hostname = "localhost";
    $username = "root";
    $password = ""; // Tambahkan titik koma di sini
    $database_name = "buku_tamu";

    // Tambahkan titik koma setelah pernyataan mysqli_connect
    $db = mysqli_connect($hostname, $username, $password, $database_name);

    // Pengecekan koneksi yang benar
    if(mysqli_connect_errno()){
        echo "Koneksi bermasalah: " . mysqli_connect_error();
        die("Error!");
    }

?>
