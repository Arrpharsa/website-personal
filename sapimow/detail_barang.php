<?php
// Koneksi ke database
include 'db.php';

// Mulai sesi
session_start();

// Ambil ID barang dari query string
$id_barang = isset($_GET['id_barang']) ? intval($_GET['id_barang']) : 0;

// Ambil detail produk dari database
$query = "SELECT * FROM barang WHERE id_barang = $id_barang";
$result = mysqli_query($db, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    die("Produk tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['nama_barang']; ?></title>
    <style>
        img {
            max-width: 300px;
        }
        .container {
            text-align: center;
            margin-top: 200px;
        }
        .card {
            justify-content: center;
            background-color: pink;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: inline-block;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }
        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
        .card h2 {
            margin: 20px 0 10px;
            font-size: 24px;
        }
        .login-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <center>
        <div class='card'>
            <img src="gambar/<?php echo $product['foto']; ?>" alt="<?php echo $product['nama_barang']; ?>">
            <h2><?php echo $product['nama_barang']; ?></h2>
            <div id="card">
                <p><strong>Deskripsi:</strong> <?php echo $product['deskripsi']; ?></p>
                <p><strong>Harga:</strong> <?php echo number_format($product['harga_jual'], 2); ?></p>

                <?php if (isset($_SESSION['username'])): ?>
                    <form id="addToCartForm" action="add_to_cart.php" method="POST" onsubmit="return showAlert();">
                        <input type="hidden" name="id_barang" value="<?php echo $product['id_barang']; ?>">
                        <input type="number" name="jumlah" value="1" min="1">
                        <input type="submit" value="Tambah ke Keranjang">
                    </form>
                <?php else: ?>
                    <p class="login-message">
                        Silakan <a href="login.php?redirect=detail_barang.php?id_barang=<?php echo $product['id_barang']; ?>">login</a> 
                        atau <a href="regis.php">daftar</a> untuk menambahkan ke keranjang.
                    </p>
                <?php endif; ?>
            </div>
            <a href="index.php">Kembali ke Daftar Produk</a>
        </div>
    </center>

    <script>
        function showAlert() {
            alert("Barang berhasil ditambahkan ke keranjang!");
            return true; // Mengizinkan form untuk dikirim
        }
    </script>
</body>
</html>
