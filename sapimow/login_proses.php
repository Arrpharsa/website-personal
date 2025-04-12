<?php
session_start();
include 'db.php';

// Cek koneksi database
if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil username dan password
    $username = mysqli_real_escape_string($db, trim($_POST['username']));
    $password = mysqli_real_escape_string($db, trim($_POST['password']));

    // Memeriksa apakah username ada
    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($db, $query);

    if ($result) {
        // Memeriksa apakah ada hasil
        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            // Memeriksa password
            if ($password === $user['password']) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['roles'] = $user['roles'];
               
                // Redirect ke halaman admin jika peran admin
                if ($user['roles'] === 'admin') {
                    header("Location: tampil_barang.php"); // Halaman admin
                } else {
                    header("Location: index.php"); // Halaman pengguna biasa
                }
                exit();
            } else {
                header("Location: login.php?pesan=password_salah");
                exit();
            }
        } else {
            header("Location: login.php?pesan=username_tidak_ditemukan");
            exit();
        }
    } else {
        die("Query error: " . mysqli_error($db));
    }
}

mysqli_close($db);
?>
