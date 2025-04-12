<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran</title>
</head>
<body>
    <h2>Checkout</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <form action="proses_transaksi.php" method="POST">
            <table>
                <tr>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
                <?php $total = 0; ?>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                <tr>
                    <td><?php echo $item['nama_barang']; ?></td>
                    <td><?php echo $item['jumlah']; ?></td>
                    <td><?php echo number_format($item['harga'], 2); ?></td>
                    <td><?php echo number_format($item['jumlah'] * $item['harga'], 2); ?></td>
                </tr>
                <?php $total += $item['jumlah'] * $item['harga']; ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><strong>Total:</strong></td>
                    <td><strong><?php echo number_format($total, 2); ?></strong></td>
                </tr>
            </table>
            <br>
            <label for="uang_masuk">Masukkan Jumlah Uang:</label>
            <input type="number" step="0.01" name="uang_masuk" id="uang_masuk" required>
            <br><br>
            <input type="submit" value="Konfirmasi Pembayaran">
        </form>
    <?php else: ?>
        <p>Keranjang belanja Anda kosong.</p>
    <?php endif; ?>
</body>
</html>
