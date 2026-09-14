<?php
require_once __DIR__ . "/functions.php";
if (!isset($_SESSION["user"])) { header("Location: login.php"); exit; }
$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION["user"]["id"]]);
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>My Account | Yummy Donut</title><link rel="stylesheet" href="style.css"></head>
<body><header class="navbar"><a class="logo" href="index.php">YUMMY DONUT</a><nav><ul class="nav-links"><li><a href="index.php">HOME</a></li><li><a href="cart.php">CART</a></li><li><a href="logout.php">LOGOUT</a></li></ul></nav></header>
<main class="page"><div class="section-heading"><span>MY ACCOUNT</span><h1>Hello, <?= htmlspecialchars($_SESSION["user"]["name"]) ?>!</h1><p><?= htmlspecialchars($_SESSION["user"]["email"]) ?></p></div>
<div class="orders"><h2>Order History</h2><?php if (!$orders): ?><p>No orders yet.</p><?php else: ?><div class="table-wrap"><table><tr><th>Order</th><th>Date</th><th>Total</th><th>Status</th></tr><?php foreach ($orders as $order): ?><tr><td>#<?= $order["id"] ?></td><td><?= htmlspecialchars($order["created_at"]) ?></td><td>₱<?= number_format($order["total"],2) ?></td><td><span class="status"><?= htmlspecialchars($order["status"]) ?></span></td></tr><?php endforeach; ?></table></div><?php endif; ?></div></main></body></html>
