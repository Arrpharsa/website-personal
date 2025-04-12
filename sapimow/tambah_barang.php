<html>
    <head>
        <title>INPUT BARANG</title>
        <style>
            </style>
    </head>
    <body>
    <table>
        <form action="tambah_aksi.php?" method="POST" enctype="multipart/form-data">
        <tr>
            <td>Nama Barang :</td>
            <td><input type="text" name="nama_barang"></td>
        </tr>
        <tr>
            <td>Deskripsi Barang : </td>
            <td><textarea name="deskripsi"></textarea></td>
        <tr>
            <td>Stock :</td>
            <td><input type="text" name="stock"></td>
        </tr>
        <tr>
            <td>Harga Beli :</td>
            <td><input type="text" name="harga_beli"></td>
        </tr>
        <tr>
            <td>Harga Jual :</td>
            <td><input type="text" name="harga_jual"></td>
        </tr>
        <tr>
            <td>Masukan Gambar</td>
            <td><input type="file" name="foto"></td>
        </tr>
        <tr>
            <td>Tanggal Masuk :</td>
            <td><input type="date" name="tanggal_masuk"></td>
        </tr>
        <tr>
        
            <td><input type="submit" value="simpan" onclick="return confirm('Anda Sudah Yakin dengan barang ini?');"></td>
        </tr>
    </table>
</form>
    </body>
</html>