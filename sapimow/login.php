<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
    <?php if (isset($_GET['pesan'])): ?>
        <p class="error-message">Login gagal! Silakan coba lagi.</p>
    <?php endif; ?>
    <div class="login-form">
    <center><h2>Login Munzy Mun Store</h2></center>
    
        <form action="login_proses.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <br>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="regis.php">Daftar di sini</a></p>
        <a href="index.php">Kembali Ke dashboard</a>
    </div>
</body>
</html> 
