<?php
// Koneksi ke database
include 'db.php';

// Ambil ID barang yang akan dihapus dari URL
$id = $_GET['id_barang'];

// Ambil data gambar untuk dihapus dari folder
$query = "SELECT foto FROM barang WHERE id_barang = '$id'";
$result = mysqli_query($db, $query);
$data = mysqli_fetch_assoc($result);

// Hapus file foto dari folder
if (file_exists('foto/' . $data['foto'])) {
    unlink('foto/' . $data['foto']);
}

// Query untuk menghapus data barang dari database
$query = "DELETE FROM barang WHERE id_barang = '$id'";
mysqli_query($db, $query);

// Redirect setelah data dihapus
header("location:tampil_barang.php");
?>
