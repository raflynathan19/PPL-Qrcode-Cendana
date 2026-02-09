<?php
session_start();
include 'koneksi.php';
$data = mysqli_query($koneksi, "SELECT * FROM menu");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cafe Cendana</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>☕ Cafe Cendana</h1>
<p>Silakan scan QR Code untuk melakukan pemesanan menu</p>

<div class="menu">
<?php while($row =
 mysqli_fetch_assoc($data)) { ?>
    <div class="card">
        <img src="img/<?= 
    $row['gambar']; ?>" width="150">
        <h3><?= $row['nama_menu']; ?></h3>
        <p><?= $row['keterangan']; ?></p>
        <strong>Rp <?=
    number_format($row['harga']); ?></strong>

        <form action="keranjang.php" method="post">
    <input type="hidden" name="aksi" value="tambah">
    <input type="hidden" name="nama" value="<?= $row['nama_menu']; ?>">
    <input type="hidden" name="harga" value="<?= $row['harga']; ?>">

    <input type="number" name="jumlah" value="1" min="1">
    <br><br>
    <button type="submit">🛒 Tambah</button>
</form>
<hr>
<form action="keranjang.php" method="get">
    <button type="submit">✅ Checkout</button>
</form>
    </div>
<?php } ?>
</div>

</body>
</html>