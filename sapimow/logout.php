<?php
// Mulai sesi
session_start();

// Hapus semua variabel sesi
$_SESSION = [];

// Hapus sesi
session_destroy();

// Alihkan pengguna ke halaman utama atau login setelah logout
header("Location: index.php"); // Ganti dengan halaman yang Anda inginkan
exit();
?>
