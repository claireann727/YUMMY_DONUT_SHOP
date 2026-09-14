<?php
require_once __DIR__ . "/config.php";
$email = "admin@yummydonut.com";
$password = "admin123";
$name = "Yummy Donut Admin";

$stmt = $pdo->prepare("SELECT id FROM users WHERE email=?");
$stmt->execute([$email]);
if ($stmt->fetch()) die("Admin already exists. Delete create_admin.php after setup.");

$stmt = $pdo->prepare("INSERT INTO users (name,email,password,role) VALUES (?,?,?,'admin')");
$stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
echo "Admin created. Email: admin@yummydonut.com | Password: admin123. DELETE create_admin.php now.";
?>
