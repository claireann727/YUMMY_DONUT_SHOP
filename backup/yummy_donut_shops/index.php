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

<?php require __DIR__ . "/partials/nav.php"; ?>



<!-- =========================================
     HERO
========================================= -->

<section class="hero" id="home">

    <div class="hero-banner">

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


        <img
            class="hero-banner-img"
            src="images/hero-donut.png"
            alt="A flat lay of six assorted Yummy Donut flavors"
        >

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
                alt="Our process: freshly prepared, perfectly baked, sweetly glazed, ready to share"
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



<?php require __DIR__ . "/partials/footer.php"; ?>
