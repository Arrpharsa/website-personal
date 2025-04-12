<?php
// Koneksi ke database
include 'db.php'; // Pastikan file ini berisi koneksi ke database

// Ambil ID barang yang akan diedit
$id_barang = $_GET['id_barang'];

// Query untuk mengambil data barang berdasarkan ID
$query = "SELECT * FROM barang WHERE id_barang = '$id_barang'";
$result = mysqli_query($db, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>UPDATE DATA BARANG</title>
</head>
<body>
    <h2>UPDATE DATA MUNZY</h2>
    <form action="edit_aksi.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_barang" value="<?php echo $data['id_barang']; ?>">
        <table>
            <tr>
                <td>Nama Barang :</td>
                <td><input type="text" name="nama_barang" value="<?php echo $data['nama_barang']; ?>"></td>
            </tr>
            <tr>
                <td>Deskripsi :</td>
                <td><input type="text" name="deskripsi" value="<?php echo $data['deskripsi']; ?>"></td>
            </tr>
            <tr>
                <td>Stock :</td>
                <td><input type="text" name="stock" value="<?php echo $data['stock']; ?>"></td>
            </tr>
            <tr>
                <td>Harga Beli :</td>
                <td><input type="text" name="harga_beli" value="<?php echo $data['harga_beli']; ?>"></td>
            </tr>
            <tr>
                <td>Harga Jual :</td>
                <td><input type="text" name="harga_jual" value="<?php echo $data['harga_jual']; ?>"></td>
            </tr>
            <tr>
                <td>Masukan Gambar</td>
                <td>
                    <input type="file" name="foto" onchange="previewImage(event)">
                    <br>
                    <small>Gambar saat ini: <img src="gambar/<?php echo $data['foto']; ?>" width="100"></small>
                    <br>
                    <small>Preview Gambar Baru:</small>
                    <br>
                    <img id="new-image" width="100" style="display:none;">
                    <input type="hidden" name="foto_lama" value="<?php echo $data['foto']; ?>">
                </td>
            </tr>
            <tr>
                <td>Tanggal Masuk :</td>
                <td><input type="date" name="tanggal_masuk" value="<?php echo $data['tanggal_masuk']; ?>"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Update" onclick="return confirm('Anda yakin ingin memperbarui data ini?');"></td>
            </tr>
        </table>
    </form>

    <script>
        function previewImage(event) {
            const newImage = document.getElementById('new-image');
            newImage.src = URL.createObjectURL(event.target.files[0]);
            newImage.style.display = 'block';
        }
    </script>
</body>
</html>
