<?php
require_once __DIR__ . "/config.php";

$orderId = (int)($_SESSION["last_order_id"] ?? 0);
unset($_SESSION["last_order_id"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Confirmed | Yummy Donut</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main class="page">
    <div class="success-page">

        <div class="success-icon">✓</div>
        <span>ORDER CONFIRMED</span>
        <h1>Thank You!</h1>
        <p>Your Yummy Donut order has been received.</p>

        <?php if ($orderId): ?>
            <p>Your order number is <strong>#<?= $orderId ?></strong>.</p>
        <?php endif; ?>

        <a class="btn" href="index.php#menu">ORDER MORE DONUTS</a>

    </div>
</main>

</body>
</html>
