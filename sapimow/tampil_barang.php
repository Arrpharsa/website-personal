<!DOCTYPE html>
<html>
<head>
	<title>Munzy Mun Store</title>
	<style>
		body {
			background: white;
		}

		.custom-link {
			cursor: pointer;
		}

		.btn {
			font-family: 'Sagoe UI', Tahoma, Geneva, Verdana, sans-serif;
			text-decoration: none;
			background-color: white;
			border-radius: 15px;
			display: inline block;
			border: none;
			color: red;
			font-weight: bold;
			width: 90px;
		}

		table {
			background-color: pink;
			color: black;
			font-family:'Sagoe UI', Tahoma, Geneva, Verdana, sans-serif;
			margin: 0 auto;
			border-collapse: collapse;
		}
	</style>
</head>
<body> 
	<h2>Munzy Mun Store</h2>
	<p>DATA BARANG MUNZY STORE</p>
	<br/>
	<button><a class="custom-link" onclick="location.href='tambah_barang.php'">Tambah Barang</a></button>
	<button><a href="logout.php">Logout</a> <!-- Link Logout --></button>
	<br/>
	<br/>
	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>KODE BARANG</th>
			<th>NAMA BARANG</th>
			<th>DESKRIPSI</td>
			<th>STOCK BARANG</th>
			<th>HARGA BELI</th>
			<th>HARGA JUAL</th>
			<th>GAMBAR BARANG</th>
			<th>TANGGAL MASUK</th>
			<th>AKSI</th>
		</tr>
		<?php 
		include 'db.php';
		$no = 1;
		$data = mysqli_query($db,"SELECT * FROM barang");
		while($d = mysqli_fetch_array($data)){
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['nama_barang']; ?></td>
			<td><?php echo $d['deskripsi']; ?></td>
			<td><?php echo $d['stock']; ?></td>
			<td><?php echo $d['harga_beli']; ?></td>
			<td><?php echo $d['harga_jual']; ?></td>
			<td><img src="gambar/<?php echo $d['foto']; ?>" width="100" alt="Foto Barang"></td>
			<td><?php echo $d['tanggal_masuk']; ?></td>
			<td>
                <a href="edit_barang.php?id_barang=<?php echo $d['id_barang']; ?>"><input type="submit" class="btn" value="Update"></a>
                <a class="custom-link" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" href="hapus_barang.php?id_barang=<?php echo $d['id_barang']; ?>"><input type="submit" class="btn" value="Delete"></a>
            </td>
		</tr>
		<?php } ?>
	</table>
</body>
</html>
