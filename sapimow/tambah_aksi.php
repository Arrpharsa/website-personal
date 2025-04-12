<?php
include 'db.php'; 

// Menangkap data yang dikirim dari form
$nama_barang = $_POST['nama_barang'];
$deskripsi = $_POST['deskripsi'];
$stock = $_POST['stock'];
$harga_beli = $_POST['harga_beli'];
$harga_jual = $_POST['harga_jual'];
$tanggal_masuk = date('Y-m-d'); // Menggunakan tanggal saat ini

if ($_FILES['foto']['name'] != "") {
    $ekstensi = ['png', 'jpg', 'jpeg', 'gif'];
    $file_baru = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $ext = pathinfo($file_baru, PATHINFO_EXTENSION);

    // Validasi ekstensi dan ukuran
    if (!in_array($ext, $ekstensi) || $ukuran >= 1000000) {
        header("location:form.php?alert=gagal_eksitensi_atau_ukuran");
        exit;
    }

    // Mengubah nama file dengan random number
    $rand = rand();
    $filename = $rand . '_' . $file_baru;

    if (move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/' . $filename)) {
        echo "File berhasil diupload: " . $filename;
    } else {
        echo "File gagal diupload.";
    }
    
}

// Query untuk memasukkan data ke database
$query = "INSERT INTO barang (nama_barang, deskripsi, stock, harga_beli, harga_jual, foto, tanggal_masuk) 
          VALUES ('$nama_barang', '$deskripsi', '$stock', '$harga_beli', '$harga_jual', '$filename', '$tanggal_masuk')";

// Eksekusi query
if (mysqli_query($db, $query)) {
    // Redirect setelah berhasil input
    header("location:tampil_barang.php");
} else {
    echo "Error: " . mysqli_error($db);
}
?>
