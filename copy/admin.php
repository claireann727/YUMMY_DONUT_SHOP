<?php
require_once __DIR__ . "/functions.php";
requireAdmin();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = (int)($_POST["order_id"] ?? 0);
    $status = $_POST["status"] ?? "Pending";
    $allowed = ["Pending","Preparing","Out for Delivery","Completed","Cancelled"];
    if ($id && in_array($status, $allowed, true)) {
        $stmt = $pdo->prepare("UPDATE orders SET status=? WHERE id=?");
        $stmt->execute([$status, $id]);
    }
    header("Location: admin.php");
    exit;
}

$orders = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC")->fetchAll();
$productCount = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$orderCount = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$sales = $pdo->query("SELECT COALESCE(SUM(total),0) FROM orders WHERE status <> 'Cancelled'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Admin Dashboard | Yummy Donut</title><link rel="stylesheet" href="style.css"></head>
<body><header class="navbar"><a class="logo" href="index.php">YUMMY DONUT ADMIN</a><nav><ul class="nav-links"><li><a href="index.php">STORE</a></li><li><a href="logout.php">LOGOUT</a></li></ul></nav></header>
<main class="page"><div class="section-heading"><span>ADMIN DASHBOARD</span><h1>Store Overview</h1></div>
<div class="stats"><div><b><?= $productCount ?></b><span>Products</span></div><div><b><?= $orderCount ?></b><span>Orders</span></div><div><b>₱<?= number_format($sales,2) ?></b><span>Total Sales</span></div></div>
<div class="orders"><h2>Recent Orders</h2><div class="table-wrap"><table><tr><th>#</th><th>Customer</th><th>Total</th><th>Date</th><th>Status</th><th>Update</th></tr>
<?php foreach ($orders as $order): ?><tr><td>#<?= $order["id"] ?></td><td><?= htmlspecialchars($order["customer_name"]) ?><br><small><?= htmlspecialchars($order["email"]) ?></small></td><td>₱<?= number_format($order["total"],2) ?></td><td><?= htmlspecialchars($order["created_at"]) ?></td><td><?= htmlspecialchars($order["status"]) ?></td><td><form method="post" class="inline-form"><input type="hidden" name="order_id" value="<?= $order["id"] ?>"><select name="status"><?php foreach (["Pending","Preparing","Out for Delivery","Completed","Cancelled"] as $status): ?><option <?= $status===$order["status"]?"selected":"" ?>><?= $status ?></option><?php endforeach; ?></select><button class="small-btn">SAVE</button></form></td></tr><?php endforeach; ?>
</table></div></div></main></body></html>
