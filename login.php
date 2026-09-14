<?php
require_once __DIR__ . "/config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["password"])) {
        session_regenerate_id(true);
        $_SESSION["user"] = [
            "id" => $user["id"],
            "name" => $user["name"],
            "email" => $user["email"],
            "role" => $user["role"],
        ];
        header("Location: account.php");
        exit;
    }

    $error = "Invalid email or password.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Yummy Donut</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<main class="auth">
    <div class="auth-card">

        <a class="logo" href="index.php">YUMMY DONUT</a>
        <h1>Welcome Back</h1>
        <p>Login to your Yummy Donut account.</p>

        <?php if (isset($_GET["registered"])): ?>
            <div class="success-message">Account created. You can now log in.</div>
        <?php endif; ?>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" class="checkout-form">
            <label>Email<input type="email" name="email" required></label>
            <label>Password<input type="password" name="password" required></label>
            <button class="btn">LOGIN</button>
        </form>

        <p>New customer? <a class="text-link" href="register.php">Create an account</a></p>

    </div>
</main>

</body>
</html>
