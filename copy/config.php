<?php
// Database configuration
// Change these values for your XAMPP/WAMP/Laragon MySQL setup.
$dbHost = "localhost";
$dbName = "yummy_donut";
$dbUser = "root";
$dbPass = "";

try {
    $pdo = new PDO(
        "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4",
        $dbUser,
        $dbPass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed. Please check config.php and import database.sql.");
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>