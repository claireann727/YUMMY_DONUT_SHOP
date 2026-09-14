<?php
require_once __DIR__ . "/config.php";
$error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if ($name === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
        $error = "Use a valid name/email and a password of at least 6 characters.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
            $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
            header("Location: login.php?registered=1");
            exit;
        } catch (PDOException $e) {
            $error = "That email is already registered.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Register | Yummy Donut</title><link rel="stylesheet" href="style.css"></head>
<body><main class="auth"><div class="auth-card"><a class="logo" href="index.php">YUMMY DONUT</a><h1>Create Account</h1><p>Save your details for faster checkout.</p>
<?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post" class="checkout-form"><label>Name<input name="name" required></label><label>Email<input type="email" name="email" required></label><label>Password<input type="password" name="password" minlength="6" required></label><button class="btn">CREATE ACCOUNT</button></form>
<p>Already registered? <a class="text-link" href="login.php">Login</a></p></div></main></body></html>
