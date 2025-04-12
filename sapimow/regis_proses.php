<?php
include 'db.php'; // Koneksi ke database
if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengambil data dari form dan melakukan sanitasi
$username      = mysqli_real_escape_string($db, $_POST['username']);
$password      = mysqli_real_escape_string($db, $_POST['password']);
$nama          = mysqli_real_escape_string($db, $_POST['nama']);
$tanggal_lahir = mysqli_real_escape_string($db, $_POST['tanggal_lahir']);
$jk            = mysqli_real_escape_string($db, $_POST['jk']); 
$alamat        = mysqli_real_escape_string($db, $_POST['alamat']);
$no_telp       = mysqli_real_escape_string($db, $_POST['no_telp']);
$email         = mysqli_real_escape_string($db, $_POST['email']);

// Validasi jenis kelamin
if (empty($jk)) {
    die("Jenis kelamin tidak boleh kosong!");
}

// Mendapatkan tanggal registrasi saat ini
$tanggal_regis = date('Y-m-d H:i:s');

// Memeriksa apakah username sudah terdaftar
$result_check_username = mysqli_query($db, "SELECT * FROM user WHERE username = '$username'");
if (mysqli_num_rows($result_check_username) > 0) {
    die("Username sudah terdaftar!");
}

// Memeriksa apakah email sudah terdaftar
$result_check_email = mysqli_query($db, "SELECT * FROM data_pribadi WHERE gmail = '$email'");
if (mysqli_num_rows($result_check_email) > 0) {
    die("Email sudah terdaftar!");
}

// Menyimpan data pengguna ke tabel users dengan role pengguna
$role = 'pengguna'; // Role pengguna
$query_user = "INSERT INTO user (username, password, tanggal_regis, roles) VALUES ('$username', '$password', '$tanggal_regis', '$role')";

if (mysqli_query($db, $query_user)) {
    $user_id = mysqli_insert_id($db); // Mendapatkan ID pengguna yang baru dibuat

    // Menyimpan data pribadi ke tabel data_pribadi
    $query_pribadi = "INSERT INTO data_pribadi (id_akun, nama, tanggal_lahir, jk, alamat, no_telp, gmail) 
                      VALUES ('$user_id', '$nama', '$tanggal_lahir', '$jk', '$alamat', '$no_telp', '$email')";

    if (mysqli_query($db, $query_pribadi)) {
        echo "Registrasi berhasil! Silakan <a href='login.php'>login</a>";
    } else {
        echo "Error saat menyimpan data pribadi: " . mysqli_error($db);
    }
} else {
    echo "Error saat menyimpan data pengguna: " . mysqli_error($db);
}

// Menutup koneksi
mysqli_close($db);
?>
