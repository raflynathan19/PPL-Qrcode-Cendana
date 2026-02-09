<?php
session_start();

if (empty($_SESSION['cart'])) {
    echo "Keranjang kosong";
    exit;
}

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <div class="checkout-box">
    <title>Checkout</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .checkout-box {
        max-width: 420px;   /* ukuran sedang */
        margin: 40px auto;  /* auto = tengah */
        text-align: center;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 10px;
    }

    .checkout-box h2 {
        font-size: 22px;
        margin-bottom: 15px;
    }

    .checkout-box p {
        font-size: 15px;
        margin: 8px 0;
    }

    .btn-selesai {
        margin-top: 15px;
        padding: 10px 25px;
        font-size: 15px;
        background: #28a745;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .success {
        color: green;
        font-size: 14px;
        margin-top: 10px;
    }

    a {
        display: inline-block;
        margin-top: 10px;
        font-size: 14px;
    }
</style>
<body>

<h2>🧾 Checkout</h2>

<?php foreach ($_SESSION['cart'] as $item): 
    $subtotal = $item['harga'] * $item['jumlah'];
    $total += $subtotal;
?>
<p>
    <?= htmlspecialchars($item['nama']); ?> <br>
    <?= $item['jumlah']; ?> x Rp <?= number_format($item['harga']); ?>
    = Rp <?= number_format($subtotal); ?>
</p>
<hr>
<?php endforeach; ?>

<h3>Total Bayar: Rp <?= number_format($total); ?></h3>

<form method="post">
    <button name="selesai">✔ Selesaikan Pesanan</button>
</form>

<?php
if (isset($_POST['selesai'])) {
    unset($_SESSION['cart']);
    echo "<p>✅ Pesanan berhasil!</p>";
    echo "<a href='index.php'>Kembali ke Menu</a>";
}
?>

</body>
</html>