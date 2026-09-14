<?php
require_once __DIR__ . "/config.php";

function cartCount(): int {
    return array_sum($_SESSION["cart"] ?? []);
}

function cartItems(PDO $pdo): array {
    $cart = $_SESSION["cart"] ?? [];
    if (!$cart) return [];

    $ids = array_keys($cart);
    $placeholders = implode(",", array_fill(0, count($ids), "?"));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
    $stmt->execute($ids);

    $items = [];
    foreach ($stmt->fetchAll() as $product) {
        $qty = max(1, (int)($cart[$product["id"]] ?? 1));
        $product["quantity"] = $qty;
        $product["subtotal"] = $qty * (float)$product["price"];
        $items[] = $product;
    }
    return $items;
}

function cartTotal(PDO $pdo): float {
    $total = 0;
    foreach (cartItems($pdo) as $item) {
        $total += $item["subtotal"];
    }
    return $total;
}

function requireAdmin(): void {
    if (($_SESSION["user"]["role"] ?? "") !== "admin") {
        header("Location: login.php");
        exit;
    }
}
?>
