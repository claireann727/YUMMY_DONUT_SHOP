<?php
require_once __DIR__ . "/functions.php";

if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST["action"] ?? "";
    $id = (int)($_POST["product_id"] ?? 0);
    $qty = max(1, (int)($_POST["quantity"] ?? 1));

    if ($action === "add" && $id > 0) {
        $_SESSION["cart"][$id] = ($_SESSION["cart"][$id] ?? 0) + $qty;
    } elseif ($action === "update") {
        foreach ($_POST["qty"] ?? [] as $productId => $value) {
            $productId = (int)$productId;
            $value = (int)$value;
            if ($value <= 0) {
                unset($_SESSION["cart"][$productId]);
            } else {
                $_SESSION["cart"][$productId] = $value;
            }
        }
    } elseif ($action === "remove" && $id > 0) {
        unset($_SESSION["cart"][$id]);
    }

    header("Location: cart.php");
    exit;
}

$items = cartItems($pdo);
$total = cartTotal($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Cart | Yummy Donut</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php require __DIR__ . "/partials/nav.php"; ?>

<main class="page">

    <div class="section-heading">
        <span>YOUR CART</span>
        <h1>Sweet Choices</h1>
        <p>Review your donuts before checkout.</p>
    </div>

    <?php if (!$items): ?>

        <div class="empty">
            <h2>Your cart is empty.</h2>
            <a class="btn" href="index.php#menu">SHOP DONUTS</a>
        </div>

    <?php else: ?>

        <!-- Quantity inputs below submit into this form via the
             HTML "form" attribute, so each row can also carry its
             own small, independent "remove" form without illegally
             nesting one <form> inside another. -->
        <form id="cartUpdateForm" method="post" action="cart.php">
            <input type="hidden" name="action" value="update">
        </form>

        <div class="cart-list">

            <?php foreach ($items as $item): ?>

                <div class="cart-item">

                    <img src="<?= htmlspecialchars($item["image"]) ?>" alt="<?= htmlspecialchars($item["name"]) ?>">

                    <div class="cart-info">
                        <h3><?= htmlspecialchars($item["name"]) ?></h3>
                        <p>₱<?= number_format($item["price"], 2) ?> each</p>
                    </div>

                    <input type="number" min="0" name="qty[<?= $item["id"] ?>]" value="<?= $item["quantity"] ?>" form="cartUpdateForm">

                    <strong>₱<?= number_format($item["subtotal"], 2) ?></strong>

                    <form method="post" action="cart.php" class="remove-form">
                        <input type="hidden" name="action" value="remove">
                        <input type="hidden" name="product_id" value="<?= $item["id"] ?>">
                        <button class="remove" type="submit">REMOVE</button>
                    </form>

                </div>

            <?php endforeach; ?>

        </div>

        <div class="cart-summary">
            <h2>Total: ₱<?= number_format($total, 2) ?></h2>
            <div>
                <button class="btn secondary" type="submit" form="cartUpdateForm">UPDATE CART</button>
                <a class="btn" href="checkout.php">CHECKOUT</a>
            </div>
        </div>

    <?php endif; ?>

</main>

<?php require __DIR__ . "/partials/footer.php"; ?>
