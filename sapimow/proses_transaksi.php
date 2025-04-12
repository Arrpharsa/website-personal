<?php
session_start();
include 'db.php'; // Menghubungkan ke database

// Memeriksa apakah ada barang dalam keranjang dan uang masuk
if (!empty($_SESSION['cart']) && isset($_POST['uang_masuk'])) {
    $uang_masuk = floatval($_POST['uang_masuk']);
    $tanggal_transaksi = date('Y-m-d');
    $total_harga = 0;

    // Menghitung total harga dari barang di keranjang
    foreach ($_SESSION['cart'] as $item) {
        $total_harga += $item['jumlah'] * $item['harga'];
    }

    // Validasi apakah uang yang dimasukkan cukup
    if ($uang_masuk < $total_harga) {
        echo "Uang yang diberikan tidak cukup untuk melakukan transaksi!";
        exit;
    }

    $kembalian = $uang_masuk - $total_harga;

    // Menyimpan transaksi ke tabel transaksi
    $query_transaksi = "INSERT INTO transaksi (tanggal_transaksi, total_harga, uang_masuk) VALUES ('$tanggal_transaksi', '$total_harga', '$uang_masuk')";

    if (mysqli_query($db, $query_transaksi)) {
        $id_transaksi = mysqli_insert_id($db); // Mendapatkan ID transaksi terbaru

        // Memproses setiap item dalam keranjang
        foreach ($_SESSION['cart'] as $id_barang => $item) {
            $jumlah = $item['jumlah'];
            $harga = $item['harga'];

            // Menyimpan detail transaksi ke tabel detail_transaksi
            $query_detail = "
                INSERT INTO detail_transaksi (id_transaksi, id_barang, jumlah, harga) 
                VALUES ('$id_transaksi', '$id_barang', '$jumlah', '$harga')
                ON DUPLICATE KEY UPDATE jumlah = jumlah + $jumlah
            ";
            mysqli_query($db, $query_detail);

            // Mengupdate stok barang
            $query_update_stock = "UPDATE barang SET stock = stock - $jumlah WHERE id_barang = '$id_barang'";
            mysqli_query($db, $query_update_stock);

            // Menyimpan barang keluar ke tabel barang_keluar
            $query_barang_keluar = "
                INSERT INTO barang_keluar (id_transaksi, id_barang, jumlah, harga, tanggal_transaksi, uang_masuk, kembalian) 
                VALUES ('$id_transaksi', '$id_barang', '$jumlah', '$harga', '$tanggal_transaksi', '$uang_masuk', '$kembalian')
                ON DUPLICATE KEY UPDATE 
                    jumlah = jumlah + VALUES(jumlah), 
                    harga = VALUES(harga), 
                    uang_masuk = VALUES(uang_masuk), 
                    kembalian = VALUES(kembalian), 
                    tanggal_transaksi = VALUES(tanggal_transaksi)
            ";

            if (!mysqli_query($db, $query_barang_keluar)) {
                echo "Error saat menyimpan barang keluar: " . mysqli_error($db);
                exit;
            }
        }

        // Mengosongkan keranjang setelah transaksi berhasil
        unset($_SESSION['cart']);

        // Menampilkan informasi transaksi
        echo "Transaksi berhasil!<br>";
        echo "Total: " . number_format($total_harga, 2) . "<br>";
        echo "Uang Masuk: " . number_format($uang_masuk, 2) . "<br>";
        echo "Kembalian: " . number_format($kembalian, 2);
        echo "<br>";
        echo "<a href=index.php>Kembali</a>";
    } else {
        echo "Error saat menyimpan transaksi: " . mysqli_error($db);
    }
} else {
    echo "Keranjang belanja kosong atau input tidak valid!";
}
?>
