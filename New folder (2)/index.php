<?php

require_once __DIR__ . "/functions.php";

$products = $pdo->query(
    "SELECT * FROM products ORDER BY id"
)->fetchAll();

$heroProducts = array_slice($products, 0, 6);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Yummy Donut | Freshly Made With Love
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&display=swap" rel="stylesheet">

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>


<body>


<!-- =========================================
     NAVIGATION
========================================= -->

<header class="navbar">

    <!-- YUMMY DONUT LOGO -->

    <a
        class="logo"
        href="index.php"
    >

        <img
            src="images/logo.png"
            alt="Yummy Donut Logo"
        >

    </a>


    <nav>

        <ul class="nav-links">

            <li><a href="index.php">HOME</a></li>
            <li><a href="#menu">MENU</a></li>
            <li><a href="#about">ABOUT</a></li>
            <li><a href="#reviews">REVIEWS</a></li>

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


            <a href="cart.php" class="btn nav-cta">BUY NOW</a>

        </div>

    </nav>

</header>



<!-- =========================================
     HERO
========================================= -->

<section class="hero" id="home">

    <div class="hero-inner">

        <div class="hero-copy">

            <h1>

                MADE<br>
                FRESH.<br>
                MADE<br>
                WITH<br>
                LOVE.

            </h1>


            <p>
                Soft, sweet, and made just for you.
            </p>


            <p>
                Every bite is a moment of joy.
            </p>


            <a
                href="#menu"
                class="btn btn-outline"
            >
                order now
            </a>

        </div>


        <div class="hero-gallery">

            <?php foreach ($heroProducts as $product): ?>

                <div class="hero-thumb">
                    <img
                        src="<?= htmlspecialchars($product["image"]) ?>"
                        alt="<?= htmlspecialchars($product["name"]) ?>"
                    >
                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>



<!-- =========================================
     MOST LOVED / DONUT MENU
========================================= -->

<section
    id="menu"
    class="featured"
>


    <div class="section-heading">

        <span>
            MOST LOVE
        </span>

        <h2>
            The Donuts Everyone Loves
        </h2>

        <p>
            Made Fresh, Made with Love
        </p>

    </div>



    <div class="menu-strip">


        <?php foreach ($products as $product): ?>


        <form
            method="post"
            action="cart.php"
            class="menu-item"
        >

            <input type="hidden" name="action" value="add">
            <input type="hidden" name="product_id" value="<?= $product["id"] ?>">
            <input type="hidden" name="quantity" value="1">


            <div class="menu-item-image">

                <img
                    src="<?= htmlspecialchars($product["image"]) ?>"
                    alt="<?= htmlspecialchars($product["name"]) ?>"
                >

            </div>


            <h3>
                <?= htmlspecialchars($product["name"]) ?>
            </h3>


            <div class="menu-item-price">
                ₱<?= number_format($product["price"], 2) ?>
            </div>


            <button
                type="submit"
                class="menu-item-add"
                aria-label="Add <?= htmlspecialchars($product["name"]) ?> to cart"
            >
                +
            </button>


        </form>


        <?php endforeach; ?>


    </div>

</section>



<!-- =========================================
     HOW WE MAKE IT
========================================= -->

<section
    id="about"
    class="how-we-make"
>

    <div class="how-inner">

        <div class="how-content">

            <span>
                HOW WE MAKE IT
            </span>

            <h2>
                Made Fresh,<br>
                Made with Love
            </h2>

            <p>
                From the first mix to the final sprinkle, every
                Yummy Donut is carefully prepared to give you a
                soft, fresh, and delicious treat.
            </p>

        </div>


        <div class="how-image">

            <img
                src="images/donut-making.png"
                alt="Making fresh donuts"
            >

        </div>

    </div>

</section>



<!-- =========================================
     WHY CHOOSE US
========================================= -->

<section class="why-us">

    <div class="why-inner">

        <div class="why-content">

            <span>
                WHY CHOOSE US?
            </span>

            <h2>
                Made with Love,<br>
                Just for You
            </h2>


            <div class="why-list">

                <div class="why-item">
                    <h3>FRESHLY MADE DAILY</h3>
                    <p>We bake our donuts fresh every day to ensure the best taste.</p>
                </div>

                <div class="why-item">
                    <h3>PREMIUM INGREDIENTS</h3>
                    <p>Only high quality ingredients for soft, sweet, and delicious donuts.</p>
                </div>

                <div class="why-item">
                    <h3>MADE WITH LOVE</h3>
                    <p>Every donut is made with care to bring you happiness.</p>
                </div>

                <div class="why-item">
                    <h3>PERFECT FOR ANY MOMENT</h3>
                    <p>Treat yourself or share the joy with your loved ones.</p>
                </div>

            </div>


            <a href="#menu" class="btn btn-dark">LEARN MORE</a>

        </div>


        <div class="why-photo">

            <img
                src="images/shop.jpg"
                alt="Yummy Donut display case"
                onerror="this.onerror=null;this.src='images/hero-donut.png';"
            >

        </div>

    </div>

</section>



<!-- =========================================
     REVIEWS
========================================= -->

<section
    id="reviews"
    class="reviews"
>


    <div class="section-heading">


        <span>
            HAPPY BITES, HAPPY REVIEWS
        </span>


        <h2>
            Sweet Words from Happy Customers
        </h2>


    </div>


    <div class="review-grid">


        <article class="review-card">

            <div class="review-stars">★★★★★</div>

            <p>
                "The donuts are so soft and delicious!
                You can really taste the quality."
            </p>


            <span>
                - Kate
            </span>


        </article>



        <article class="review-card">

            <div class="review-stars">★★★★★</div>

            <p>
                "My favorite donut shop!
                Fresh, tasty, and always satisfying."
            </p>


            <span>
                - Kim
            </span>


        </article>



        <article class="review-card">

            <div class="review-stars">★★★★★</div>

            <p>
                "Love the variety and the flavors!
                Definitely coming back for more."
            </p>


            <span>
                - Cleveland
            </span>


        </article>


    </div>


</section>



<!-- =========================================
     SWEET MOMENT / CALL TO ACTION
========================================= -->

<section class="cta">


    <div class="cta-content">


        <div class="cta-label">
            SWEET MOMENT FOR EVERYONE
        </div>


        <h2 class="cta-title">


            <span>
                Treat Yourself.
            </span>


            <span>
                Share the Happiness.
            </span>


        </h2>


        <p>
            From classic favorites to indulgent creations,
            there is a donut for every craving and occasion.
        </p>


        <a
            href="#menu"
            class="btn light"
        >
            EXPLORE MENU
        </a>


        <div class="cta-gallery">

            <figure>
                <div class="cta-gallery-frame">
                    <img src="images/donut-2.png" alt="A box of donuts for you">
                </div>
                <figcaption>For You</figcaption>
            </figure>

            <figure>
                <div class="cta-gallery-frame">
                    <img src="images/donut-4.png" alt="A box of donuts for friends">
                </div>
                <figcaption>For Friends</figcaption>
            </figure>

            <figure>
                <div class="cta-gallery-frame">
                    <img src="images/donut-6.png" alt="A box of donuts for every moment">
                </div>
                <figcaption>For Every Moment</figcaption>
            </figure>

        </div>


    </div>


</section>



<!-- =========================================
     TRUST BAR
========================================= -->

<section class="trust-bar">

    <div class="trust-item">
        <span class="trust-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 20c8 0 14-6 14-14C10 6 4 12 4 20z"/>
                <path d="M6.5 17.5 15 9"/>
            </svg>
        </span>
        <p>FRESH<br>EVERYDAY</p>
    </div>

    <div class="trust-item">
        <span class="trust-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 4v16"/>
                <path d="M12 7.5 8.5 9.5M12 7.5 15.5 9.5M12 11.5 8.5 13.5M12 11.5 15.5 13.5M12 15.5 8.5 17.5M12 15.5 15.5 17.5"/>
            </svg>
        </span>
        <p>QUALITY<br>INGREDIENTS</p>
    </div>

    <div class="trust-item">
        <span class="trust-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 20s-7-4.35-9.5-8.5C1 8 2.5 4.5 6 4.5c2 0 3.5 1.2 4 2.7.5-1.5 2-2.7 4-2.7 3.5 0 5 3.5 3.5 7C19 15.65 12 20 12 20z"/>
            </svg>
        </span>
        <p>HANDMADE<br>WITH CARE</p>
    </div>

    <div class="trust-item">
        <span class="trust-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="8.5"/>
                <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                <circle cx="9" cy="10" r="0.9" fill="currentColor" stroke="none"/>
                <circle cx="15" cy="10" r="0.9" fill="currentColor" stroke="none"/>
            </svg>
        </span>
        <p>SATISFACTION<br>GUARANTEED</p>
    </div>

</section>



<!-- =========================================
     FOOTER
========================================= -->

<footer>


    <div class="footer-top">


        <div>


            <div class="footer-logo">
                YUMMY DONUT
            </div>


            <p>

                Bringing sweetness<br>
                to your everyday.

            </p>


            <div class="social-icons">

                <a href="#" class="social-icon" aria-label="Facebook">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M13.5 21v-7h2.4l.4-3h-2.8V9.2c0-.9.2-1.5 1.5-1.5h1.4V5.1C15.9 5 15 5 14 5c-2.3 0-3.9 1.4-3.9 4v2H7.7v3h2.4v7z"/>
                    </svg>
                </a>

                <a href="#" class="social-icon" aria-label="Instagram">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6">
                        <rect x="4" y="4" width="16" height="16" rx="4"/>
                        <circle cx="12" cy="12" r="3.5"/>
                        <circle cx="16.2" cy="7.8" r="0.6" fill="currentColor" stroke="none"/>
                    </svg>
                </a>

                <a href="#" class="social-icon" aria-label="TikTok">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14 3c.3 2 1.8 3.5 3.8 3.8v2.4c-1.4-.1-2.7-.6-3.8-1.4v6.6a5 5 0 1 1-4-4.9v2.5a2.5 2.5 0 1 0 1.7 2.4V3h2.3z"/>
                    </svg>
                </a>

            </div>


        </div>



        <div class="footer-info">


            <!-- QUICK LINKS -->

            <div>


                <h3>
                    QUICK LINKS
                </h3>


                <a href="index.php">
                    Home
                </a>


                <a href="#menu">
                    Menu
                </a>


                <a href="#about">
                    About
                </a>


                <a href="#reviews">
                    Reviews
                </a>


            </div>



            <!-- HELP -->

            <div>


                <h3>
                    HELP
                </h3>


                <a href="#">
                    FAQs
                </a>


                <a href="#">
                    Shipping &amp; Delivery
                </a>


                <a href="#">
                    Returns
                </a>


                <a href="#">
                    Store Locator
                </a>


            </div>



            <!-- CONTACT -->

            <div>


                <h3>
                    CONTACT US
                </h3>


                <p>
                    123 Sweet St., Donut City, Philippines
                </p>


                <p>
                    +639 940 191 407
                </p>


                <p>
                    yummy@donuts.com
                </p>


            </div>


        </div>


    </div>



    <div class="copyright">

        <p>© <?= date("Y") ?> Yummy Donut. All rights reserved <span aria-hidden="true">♥</span></p>

    </div>


</footer>



<!-- =========================================
     JAVASCRIPT
========================================= -->

<script src="script.js"></script>


</body>

</html>
