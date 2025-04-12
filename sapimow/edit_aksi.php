<?php
// Koneksi ke database
include 'db.php';

// Menangkap data yang dikirim dari form
$id_barang = $_POST['id_barang'];
$nama_barang = $_POST['nama_barang'];
$deskripsi  = $_POST['deskripsi'];
$stock = $_POST['stock'];
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$tanggal_masuk = $_POST['tanggal_masuk'];
$foto_lama = $_POST['foto_lama']; // Menyimpan foto lama

// Proses upload file dengan validasi ekstensi dan ukuran
if ($_FILES['foto']['name'] != "") {
    // Jika ada foto baru, hapus foto lama dari server
    if (file_exists('gambar/' . $foto_lama)) {
        unlink('gambar/' . $foto_lama); // Menghapus foto lama
    }

    $ekstensi = ['png', 'jpg', 'jpeg', 'gif'];
    $file_baru = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $ext = pathinfo($file_baru, PATHINFO_EXTENSION);

    // Validasi ekstensi dan ukuran
    if (!in_array($ext, $ekstensi) || $ukuran >= 1000000) {
        header("location:edit_barang.php?id_barang=$id_barang&alert=gagal_eksitensi_atau_ukuran");
        exit;
    }

    // Mengubah nama file dengan random number
    $rand = rand();
    $filename = $rand . '_' . $file_baru;

    // Memindahkan file ke folder gambar
    move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/' . $filename);
} else {
    // Jika tidak ada foto baru, gunakan foto lama
    $filename = $foto_lama;
}

// Query untuk memperbarui data barang
$query_update = "UPDATE barang SET 
                    nama_barang = '$nama_barang',
                    deskripsi = '$deskripsi',
                    stock = '$stock',
                    harga_beli = '$harga_beli',
                    harga_jual = '$harga_jual',
                    foto = '$filename',
                    tanggal_masuk = '$tanggal_masuk' 
                WHERE id_barang = '$id_barang'";

// Eksekusi query
if (mysqli_query($db, $query_update)) {
    header("location:tampil_barang.php");
} else {
    echo "Error: " . mysqli_error($db);
}
?>
