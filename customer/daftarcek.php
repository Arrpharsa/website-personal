<?php
include '../crud/koneksi.php';

$telp = $_POST['No_Telp'];
$pw   = $_POST['Password'];

mysqli_query($koneksi, "INSERT INTO akun VALUES('', '$telp', '$pw')");

header("location: login.html");
?>