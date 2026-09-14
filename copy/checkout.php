<?php
require_once __DIR__ . "/functions.php";
$items = cartItems($pdo);
$total = cartTotal($pdo);

if (!$items) {
    header("Location: cart.php");
    exit;
}

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $phone = trim($_POST["phone"] ?? "");
    $address = trim($_POST["address"] ?? "");

    if ($name === "" || $email === "" || $phone === "" || $address === "") $errors[] = "Please complete all checkout fields.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Please enter a valid email address.";

    if (!$errors) {
        $pdo->beginTransaction();
        try {
            $userId = $_SESSION["user"]["id"] ?? null;
            $stmt = $pdo->prepare("INSERT INTO orders (user_id, customer_name, email, phone, address, total) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$userId, $name, $email, $phone, $address, $total]);
            $orderId = $pdo->lastInsertId();

            $itemStmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, product_name, quantity, price, subtotal) VALUES (?, ?, ?, ?, ?, ?)");
            foreach ($items as $item) {
                $itemStmt->execute([$orderId, $item["id"], $item["name"], $item["quantity"], $item["price"], $item["subtotal"]]);
            }

            $pdo->commit();
            $_SESSION["cart"] = [];
            $_SESSION["last_order_id"] = $orderId;
            header("Location: success.php");
            exit;
        } catch (Throwable $e) {
            $pdo->rollBack();
            $errors[] = "We could not place the order. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Checkout | Yummy Donut</title><link rel="stylesheet" href="style.css"></head>
<body>
<header class="navbar"><a class="logo" href="index.php">YUMMY DONUT</a><nav><ul class="nav-links"><li><a href="index.php">HOME</a></li><li><a href="cart.php">CART</a></li></ul></nav></header>
<main class="page narrow">
<div class="section-heading"><span>CHECKOUT</span><h1>Almost There!</h1><p>Total: ₱<?= number_format($total,2) ?></p></div>
<?php if ($errors): ?><div class="error"><?= implode("<br>", array_map("htmlspecialchars", $errors)) ?></div><?php endif; ?>
<form method="post" class="checkout-form">
<label>Full Name<input type="text" name="name" required></label>
<label>Email<input type="email" name="email" required></label>
<label>Phone<input type="text" name="phone" required></label>
<label>Delivery Address<textarea name="address" rows="4" required></textarea></label>
<button class="btn" type="submit">PLACE ORDER — ₱<?= number_format($total,2) ?></button>
</form>
</main></body></html>
