<?php
session_start();

// Ambil ID barang dari URL
$id_barang = $_GET['id'];

// Hapus barang dari keranjang
unset($_SESSION['cart'][$id_barang]);

// Redirect ke halaman keranjang
header("Location: view_cart.php");
?>
