<?php
require_once __DIR__ . "/functions.php";

if (!isset($_SESSION["cart"])) $_SESSION["cart"] = [];

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
            if ($value <= 0) unset($_SESSION["cart"][$productId]);
            else $_SESSION["cart"][$productId] = $value;
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
<html lang="en"><head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Your Cart | Yummy Donut</title><link rel="stylesheet" href="style.css"></head>
<body>
<header class="navbar"><a class="logo" href="index.php" style="display: flex; align-items: center; gap: 10px; text-decoration: none;"><img src="images/logo.png" alt="Yummy Donut Logo" style="height: 40px; width: auto; object-fit: contain;"><span>YUMMY DONUT</span></a><nav><ul class="nav-links"><li><a href="index.php">HOME</a></li><li><a href="index.php#menu">MENU</a></li><li><a href="login.php">ACCOUNT</a></li></ul></nav></header>
<main class="page">
<div class="section-heading"><span>YOUR CART</span><h1>Sweet Choices</h1><p>Review your donuts before checkout.</p></div>
<?php if (!$items): ?>
<div class="empty"><h2>Your cart is empty.</h2><a class="btn" href="index.php#menu">SHOP DONUTS</a></div>
<?php else: ?>
<form method="post">
<input type="hidden" name="action" value="update">
<div class="cart-list">
<?php foreach ($items as $item): ?>
<div class="cart-item">
<img src="<?= htmlspecialchars($item["image"]) ?>" alt="">
<div class="cart-info"><h3><?= htmlspecialchars($item["name"]) ?></h3><p>₱<?= number_format($item["price"],2) ?> each</p></div>
<input type="number" min="0" name="qty[<?= $item["id"] ?>]" value="<?= $item["quantity"] ?>">
<strong>₱<?= number_format($item["subtotal"],2) ?></strong>
<button class="remove" type="submit" name="remove_id" value="<?= $item["id"] ?>" formaction="cart.php" onclick="this.form.action='cart.php'; this.form.querySelector('[name=action]').value='remove'; this.form.querySelector('[name=product_id]').value=this.value;">REMOVE</button>
</div>
<?php endforeach; ?>
</div>
<input type="hidden" name="product_id" value="">
<div class="cart-summary"><h2>Total: ₱<?= number_format($total,2) ?></h2><div><button class="btn secondary" type="submit">UPDATE CART</button> <a class="btn" href="checkout.php">CHECKOUT</a></div></div>
</form>
<?php endif; ?>
</main>
</body></html>
