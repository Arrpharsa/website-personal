<?php
// Koneksi ke database
include 'db.php';

// Mulai sesi
session_start();

// Ambil semua produk dari database yang stoknya lebih dari 0
$query = "SELECT * FROM barang WHERE stock > 0";
$result = mysqli_query($db, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        .product-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            background-color: #f9f9f9;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
            text-decoration: none;
            color: black;
        }
        .product-card img {
            max-width: 100%;
            border-radius: 5px;
        }
        .product-card h3 {
            font-size: 18px;
            margin: 10px 0;
        }
        .product-card p {
            margin: 5px 0;
        }
        .login-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h2>Dashboard Produk Munzy Mun Store</h2>
    <div class="container">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <a href="detail_barang.php?id_barang=<?php echo $row['id_barang']; ?>" class="product-card">
                <img src="gambar/<?php echo $row['foto']; ?>" alt="<?php echo $row['nama_barang']; ?>">
                <h3><?php echo $row['nama_barang']; ?></h3>
                <p>Harga: <?php echo number_format($row['harga_jual'], 2); ?></p>
                <p>Stok: <?php echo $row['stock']; ?></p>
            </a>
        <?php endwhile; ?>
    </div>

    <?php if (isset($_SESSION['username'])): ?>
        <a href="view_cart.php">Lihat Keranjang</a>
        | <a href="logout.php">Logout</a> <!-- Link Logout -->
    <?php else: ?>
        <p class="login-message">
            Silakan <a href="login.php?redirect=view_cart.php">login</a> untuk melihat keranjang Anda.
        </p>
    <?php endif; ?>
</body>
</html>
