<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .login-form {
            max-width: 300px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="login-form">
<center><h2>Registrasi Munzy Mun Store
</h2></center>
    <form action="regis_proses.php" method="POST">
    
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="nama">Nama:</label>
        <input type="text" name="nama" required><br>

        <label for="tanggal_lahir">Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" required><br>

        <label for="jk">Jenis Kelamin:</label>
        <input type="radio" name="jk" value="laki-laki" required>Laki-laki
        <input type="radio" name="jk" value="Perempuan" required>Perempuan
        <br><br>

        <label for="alamat">Alamat:</label>
        <textarea name="alamat" required></textarea><br>

        <label for="no_telp">No. Telepon:</label>
        <input type="number" name="no_telp" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <input type="submit" value="Registrasi">
        <a href="login.php">Kembali</a>
    </form>
    </div>
</body>
</html>
