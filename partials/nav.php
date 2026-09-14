<?php
// =========================================
// SHARED NAVIGATION BAR
// Included by every page so the header,
// login/account state, and cart badge stay
// identical everywhere instead of being
// re-typed (and drifting) on each page.
// =========================================

// Pages outside index.php need the "index.php"
// prefix on in-page anchors like "#menu".
$onHome  = basename($_SERVER["SCRIPT_NAME"]) === "index.php";
$homeUrl = $onHome ? "" : "index.php";
?>
<header class="navbar">

    <a class="logo" href="index.php">
        <img src="images/logo.png" alt="Yummy Donut Logo">
    </a>

    <nav>

        <ul class="nav-links">
            <li><a href="index.php">HOME</a></li>
            <li><a href="<?= $homeUrl ?>#menu">MENU</a></li>
            <li><a href="<?= $homeUrl ?>#about">ABOUT</a></li>
            <li><a href="<?= $homeUrl ?>#reviews">REVIEWS</a></li>
        </ul>

        <div class="nav-actions">

            <a href="cart.php" class="cart-link" aria-label="View cart">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 4h2l2.4 12.4a2 2 0 0 0 2 1.6h7.6a2 2 0 0 0 2-1.6L21 8H6"/>
                    <circle cx="9" cy="20" r="1.3" fill="currentColor" stroke="none"/>
                    <circle cx="17" cy="20" r="1.3" fill="currentColor" stroke="none"/>
                </svg>
                <span class="cart-badge"><?= cartCount() ?></span>
            </a>

            <?php if (isset($_SESSION["user"])): ?>

                <a href="account.php" class="nav-account">ACCOUNT</a>

                <?php if ($_SESSION["user"]["role"] === "admin"): ?>
                    <a href="admin.php" class="nav-account">ADMIN</a>
                <?php endif; ?>

                <a href="logout.php" class="nav-account">LOGOUT</a>

            <?php else: ?>

                <a href="login.php" class="nav-account">LOGIN</a>

            <?php endif; ?>

            <a href="<?= $homeUrl ?>#menu" class="btn nav-cta">BUY NOW</a>

        </div>

    </nav>

</header>
