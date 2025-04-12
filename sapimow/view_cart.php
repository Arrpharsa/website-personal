<?php
session_start();

// Cek apakah ada sesi cart
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<h2>Keranjang Belanja Anda Kosong</h2>";
    exit();
}

// Update jumlah barang
if (isset($_POST['update'])) {
    foreach ($_POST['jumlah'] as $id_barang => $jumlah) {
        if ($jumlah <= 0) {
            unset($_SESSION['cart'][$id_barang]);
        } else {
            $_SESSION['cart'][$id_barang]['jumlah'] = $jumlah;
        }
    }
}

// Hapus barang
if (isset($_POST['hapus'])) {
    $id_barang = $_POST['id_barang'];
    unset($_SESSION['cart'][$id_barang]);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="style.css"> <!-- Gaya CSS tambahan jika diperlukan -->
</head>
<body>

<h1>Keranjang Belanja</h1>
<form method="post" action="">
    <table border="1">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalKeseluruhan = 0;
            foreach ($_SESSION['cart'] as $id_barang => $item) {
                $total = $item['harga'] * $item['jumlah'];
                $totalKeseluruhan += $total;
                echo "<tr>
                        <td>{$item['nama_barang']}</td>
                        <td>Rp " . number_format($item['harga'], 2, ',', '.') . "</td>
                        <td>
                            <input type='number' name='jumlah[$id_barang]' value='{$item['jumlah']}' min='0'>
                        </td>
                        <td>Rp " . number_format($total, 2, ',', '.') . "</td>
                        <td>
                            <form method='post' action='' style='display:inline;'>
                                <input type='hidden' name='id_barang' value='$id_barang'>
                                <input type='submit' name='hapus' value='Hapus'>
                            </form>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
    <input type="submit" name="update" value="Update Keranjang">
    <h2>Total Keseluruhan: Rp <?php echo number_format($totalKeseluruhan, 2, ',', '.'); ?></h2>
    
</form>

<a href="transaksi.php">Checkout</a> | <a href="index.php">Kembali ke Belanja</a>

</body>
</html>
