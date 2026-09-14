<?php

require_once __DIR__ . "/functions.php";

$products = $pdo->query(
    "SELECT * FROM products ORDER BY id"
)->fetchAll();

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

            <li>
                <a href="index.php">
                    HOME
                </a>
            </li>


            <li>
                <a href="#menu">
                    MENU
                </a>
            </li>


            <li>
                <a href="#about">
                    ABOUT
                </a>
            </li>


            <li>
                <a href="#reviews">
                    REVIEWS
                </a>
            </li>


            <li>

                <a href="cart.php">

                    CART

                    <span class="cart-badge">
                        <?= cartCount() ?>
                    </span>

                </a>

            </li>


            <?php if (isset($_SESSION["user"])): ?>


                <li>

                    <a href="account.php">
                        ACCOUNT
                    </a>

                </li>


                <?php if ($_SESSION["user"]["role"] === "admin"): ?>

                    <li>

                        <a href="admin.php">
                            ADMIN
                        </a>

                    </li>

                <?php endif; ?>


                <li>

                    <a href="logout.php">
                        LOGOUT
                    </a>

                </li>


            <?php else: ?>


                <li>

                    <a href="login.php">
                        LOGIN
                    </a>

                </li>


            <?php endif; ?>


        </ul>

    </nav>

</header>



<!-- =========================================
     HERO
========================================= -->

<section class="hero">

    <div class="hero-image">


        <img
            src="images/hero-donut.png"
            alt="Yummy Donut"
        >


        <div class="hero-overlay">


            <span class="eyebrow">
                FRESH FROM THE OVEN
            </span>


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
                class="btn"
            >
                ORDER NOW
            </a>


        </div>

    </div>

</section>



<!-- =========================================
     DONUT MENU
========================================= -->

<section
    id="menu"
    class="featured"
>


    <div class="section-heading">


        <span>
            MOST LOVED
        </span>


        <h2>
            The Donuts Everyone Loves
        </h2>


        <p>
            Made Fresh, Made with Love
        </p>


    </div>



    <div class="donut-grid">


        <?php foreach ($products as $product): ?>


        <article class="donut-card">


            <!-- DONUT IMAGE -->

            <div class="donut-image">

                <img
                    src="<?= htmlspecialchars($product["image"]) ?>"
                    alt="<?= htmlspecialchars($product["name"]) ?>"
                >

            </div>



            <!-- DONUT NAME -->

            <h3>
                <?= htmlspecialchars($product["name"]) ?>
            </h3>



            <!-- DESCRIPTION -->

            <p>
                <?= htmlspecialchars($product["description"]) ?>
            </p>



            <!-- PRICE -->

            <div class="price">

                ₱<?= number_format(
                    $product["price"],
                    2
                ) ?>

            </div>



            <!-- =========================================
                 ORDER FORM
            ========================================= -->

            <form
                method="post"
                action="cart.php"
                class="order-form"
            >


                <!-- ACTION -->

                <input
                    type="hidden"
                    name="action"
                    value="add"
                >


                <!-- PRODUCT ID -->

                <input
                    type="hidden"
                    name="product_id"
                    value="<?= $product["id"] ?>"
                >



                <!-- =========================================
                     QUANTITY
                ========================================= -->

                <div class="quantity-row">


                    <label>
                        Quantity
                    </label>


                    <!-- EMPTY QUANTITY INPUT -->

                    <input
                        type="number"
                        name="quantity"
                        min="1"
                        value=""
                        class="quantity"
                        placeholder=""
                        required
                    >


                </div>



                <!-- ADD TO CART BUTTON -->

                <button
                    class="buy-button"
                    type="submit"
                >

                    ADD TO CART

                </button>


            </form>


        </article>


        <?php endforeach; ?>


    </div>

</section>



<!-- =========================================
     ABOUT
========================================= -->

<section
    id="about"
    class="how-we-make"
>


    <div class="how-image">

        <img
            src="images/donut-making.png"
            alt="Making fresh donuts"
        >

    </div>



    <div class="how-content">


        <span>
            HOW WE MAKE IT
        </span>


        <h2>
            From the First Mix to the Final Sprinkle
        </h2>


        <p>
            Every Yummy Donut is carefully prepared
            to give you a soft, fresh, and delicious treat.
        </p>


    </div>


</section>



<!-- =========================================
     WHY CHOOSE US
========================================= -->

<section class="why-us">


    <div class="section-heading">


        <span>
            WHY CHOOSE US?
        </span>


        <h2>

            Made with Love,<br>
            Just for You

        </h2>


    </div>



    <div class="features">


        <div class="feature">


            <div class="feature-icon">
                ✦
            </div>


            <h3>
                FRESHLY MADE DAILY
            </h3>


            <p>
                We bake our donuts fresh every day.
            </p>


        </div>



        <div class="feature">


            <div class="feature-icon">
                ♡
            </div>


            <h3>
                PREMIUM INGREDIENTS
            </h3>


            <p>
                Only high quality ingredients.
            </p>


        </div>



        <div class="feature">


            <div class="feature-icon">
                ♥
            </div>


            <h3>
                MADE WITH LOVE
            </h3>


            <p>
                Every donut is made with care.
            </p>


        </div>



        <div class="feature">


            <div class="feature-icon">
                ★
            </div>


            <h3>
                PERFECT FOR ANY MOMENT
            </h3>


            <p>
                Treat yourself or share the joy.
            </p>


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


            <div class="stars">
                ★★★★★
            </div>


            <p>
                "The donuts are so soft and delicious!
                You can really taste the quality."
            </p>


            <span>
                — Kate
            </span>


        </article>



        <article class="review-card">


            <div class="stars">
                ★★★★★
            </div>


            <p>
                "My favorite donut shop!
                Fresh, tasty, and always satisfying."
            </p>


            <span>
                — Kim
            </span>


        </article>



        <article class="review-card">


            <div class="stars">
                ★★★★★
            </div>


            <p>
                "Love the variety and the flavors!
                Definitely coming back for more."
            </p>


            <span>
                — Cleveland
            </span>


        </article>


    </div>


</section>



<!-- =========================================
     CALL TO ACTION
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
            there is a donut for every craving.
        </p>


        <a
            href="#menu"
            class="btn light"
        >
            EXPLORE MENU
        </a>


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
                    Delivery
                </a>


                <a href="#">
                    Returns
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

        © 2026 Yummy Donut.
        All rights reserved.

    </div>


</footer>



<!-- =========================================
     JAVASCRIPT
========================================= -->

<script src="script.js"></script>


</body>

</html>