<?php
include '../crud/koneksi.php';

$telp = $_POST['No_Telp'];
$pw   = $_POST['Password'];

$result = mysqli_query($koneksi, "SELECT * FROM akun WHERE No_Telp='$telp' AND Password='$pw'");

if (mysqli_num_rows($result) > 0) {
    header("location: ../game/index.html");
} else {
    header("location: login.html?error=1"); 
}
?>
