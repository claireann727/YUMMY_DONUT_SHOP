// =========================================
// YUMMY DONUT
// JAVASCRIPT
// =========================================


document.addEventListener(
    "DOMContentLoaded",
    function () {


        // =========================================
        // PAGE LOADED
        // =========================================

        console.log(
            "Yummy Donut website loaded successfully!"
        );


        // =========================================
        // BUY BUTTONS
        // =========================================

        const buyButtons =
            document.querySelectorAll(".buy-button");


        console.log(
            "Number of donuts: " +
            buyButtons.length
        );


        buyButtons.forEach(
            function (button) {

                button.addEventListener(
                    "click",
                    function () {


                        const card =
                            button.closest(".donut-card");


                        if (!card) {

                            return;

                        }


                        const donutName =
                            card
                                .querySelector("h3")
                                .textContent
                                .trim();


                        // Quantity is automatically 1
                        const quantity = 1;


                        console.log(
                            "Ordering: " +
                            quantity +
                            " x " +
                            donutName
                        );

                    }
                );

            }
        );


        // =========================================
        // NAVIGATION
        // =========================================

        const navLinks =
            document.querySelectorAll(".nav-links a");


        navLinks.forEach(
            function (link) {

                link.addEventListener(
                    "click",
                    function () {

                        console.log(
                            "Navigation: " +
                            link.textContent.trim()
                        );

                    }
                );

            }
        );


        // =========================================
        // HERO ORDER BUTTON
        // =========================================

        const heroButton =
            document.querySelector(".hero-btn");


        if (heroButton) {

            heroButton.addEventListener(
                "click",
                function () {

                    console.log(
                        "Opening donut menu..."
                    );

                }
            );

        }


        // =========================================
        // EXPLORE MENU BUTTON
        // =========================================

        const exploreButton =
            document.querySelector(".cta .btn");


        if (exploreButton) {

            exploreButton.addEventListener(
                "click",
                function () {

                    console.log(
                        "Exploring menu..."
                    );

                }
            );

        }


        // =========================================
        // DONUT CARD HOVER
        // =========================================

        const donutCards =
            document.querySelectorAll(".donut-card");


        donutCards.forEach(
            function (card) {

                card.addEventListener(
                    "mouseenter",
                    function () {

                        card.style.cursor =
                            "pointer";

                    }
                );

            }
        );


    }
);