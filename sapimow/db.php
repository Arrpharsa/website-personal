<?php
$db = mysqli_connect("localhost","root","","aplikasi_merch");

//cek koneksi
if (mysqli_connect_errno()){
    echo "koneksi database gagal : " . mysqli_connect_error();

}
?>