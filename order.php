<?php
session_start();
$menu   = $_POST['menu'];
$harga  = $_POST['harga'];
$jumlah = $_POST['jumlah'];

$total = $harga * $jumlah;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pesanan</title>
</head>
<body>

<h2>Pesanan Berhasil ✅</h2>

<p>Menu: <b><?= $menu; ?></b></p>
<p>Harga Satuan: <b>Rp <?= number_format($harga); ?></b></p>
<p>Jumlah: <b><?= $jumlah; ?></b></p>

<hr>

<p>Total Bayar: <b>Rp <?= number_format($total); ?></b></p>

<a href="index.php">⬅ Kembali ke Menu</a>

</body>
</html>