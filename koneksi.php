<?php
$koneksi = mysqli_connect("localhost", "root", "", "cafe_cendana");

if (!$koneksi) {
    die("Koneksi database gagal");
}
?>