<?php
session_start();

// Ambil data dari form
$id_barang = $_POST['id_barang'];
$stock = $_POST['stock'];

// Tambah barang ke keranjang (sesi)
if (isset($_SESSION['cart'][$id_barang])) {
    $_SESSION['cart'][$id_barang]['stock'] += $stock;
} else {
    // Koneksi ke database
    include 'db.php';
    $query = "SELECT * FROM barang WHERE id_barang = '$id_barang'";
    $result = mysqli_query($db, $query);

    // Cek jika query berhasil
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Simpan data ke dalam sesi
        $_SESSION['cart'][$id_barang] = [
            'nama_barang' => $data['nama_barang'],
            'harga_beli' => $data['harga_jual'],
            'stock' => $stock
        ];
    } else {
        // Jika barang tidak ditemukan, Anda bisa menangani error sesuai kebutuhan
        $_SESSION['error'] = "Barang tidak ditemukan!";
    }
}

// Redirect kembali ke form tambah barang
header("Location: detail_barang.php?id_barang=$id_barang");
exit(); // Pastikan untuk keluar setelah redirection
?>
