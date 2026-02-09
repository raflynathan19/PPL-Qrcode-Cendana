<?php
session_start();

/* HAPUS ITEM */
if (isset($_GET['hapus'])) {
    $index = (int) $_GET['hapus'];

    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // rapihin index
    }

    header("Location: keranjang.php");
    exit;
}

/* === PROSES TAMBAH KE KERANJANG === */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['aksi'] === 'tambah') {
    $nama   = $_POST['nama'];
    $harga  = (int) $_POST['harga'];
    $jumlah = (int) $_POST['jumlah'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $found = false;

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['nama'] === $nama) {
            $_SESSION['cart'][$key]['jumlah'] += $jumlah;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'nama'   => $nama,
            'harga'  => $harga,
            'jumlah' => $jumlah
        ];
    }

    header("Location: keranjang.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .center {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }

    .box {
        width: 420px;
    }
</style>
<body>

<div class="center">
    <div class="box">

<h2>🛒 Keranjang Pesanan</h2>

<?php
$total = 0;

if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $subtotal = $item['harga'] * $item['jumlah'];
        $total += $subtotal;
        ?>
        <p>
            <b><?= htmlspecialchars($item['nama']); ?></b><br>
            <?= $item['jumlah']; ?> x Rp <?= number_format($item['harga']); ?>
            = <b>Rp <?= number_format($subtotal); ?></b>
            <a href="checkout.php">
            </a>

<?php foreach ($_SESSION['cart'] as $index => $item): ?>
    <p>
        <?= $item['nama']; ?><br>
        <?= $item['jumlah']; ?> x Rp <?= number_format($item['harga']); ?>
    </p>

    <a href="keranjang.php?hapus=<?= $index ?>"
       onclick="return confirm('Hapus menu ini?')">
       ❌ Hapus
    </a>

    <hr>
<?php endforeach;
    }
    
} else {
    echo "<p>Keranjang masih kosong</p>";
}
?>

<h3>Total: Rp <?= number_format($total); ?></h3>

<?php if (!empty($_SESSION['cart'])): ?>
    <form action="checkout.php" method="post" style="text-align:center; margin:30px 0;">
        <button type="submit"
            style="
                padding:15px 40px;
                font-size:20px;
                font-weight:bold;
                background:#28a745;
                color:white;
                border:none;
                border-radius:8px;
                cursor:pointer;
            ">
            ✅ CHECKOUT SEKARANG
        </button>
    </form>
<?php endif; ?>

<a href="index.php">⬅ Tambah Menu Lagi</a>

</body>
</html>