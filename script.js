// =========================================
// YUMMY DONUT
// JAVASCRIPT
// =========================================

document.addEventListener("DOMContentLoaded", function () {

    // =========================================
    // ADD-TO-CART BUTTONS (homepage menu grid)
    // =========================================

    const addButtons = document.querySelectorAll(".menu-item-add");

    addButtons.forEach(function (button) {

        button.addEventListener("click", function () {

            const item = button.closest(".menu-item");
            if (!item) return;

            const name = item.querySelector("h3").textContent.trim();
            console.log("Adding to cart: " + name);

            // Let the form submit normally to cart.php — this is
            // just a small visual acknowledgement for the user.
            button.classList.add("added");
            window.setTimeout(function () {
                button.classList.remove("added");
            }, 400);

        });

    });


    // =========================================
    // CART PAGE — QUANTITY INPUTS
    // Select the current value on focus so typing
    // a new quantity doesn't require clearing it first.
    // =========================================

    document.querySelectorAll(".cart-item input[type='number']").forEach(function (input) {

        input.addEventListener("focus", function () {
            input.select();
        });

    });


    // =========================================
    // NAVIGATION LINK LOGGING
    // =========================================

    document.querySelectorAll(".nav-links a").forEach(function (link) {

        link.addEventListener("click", function () {
            console.log("Navigation: " + link.textContent.trim());
        });

    });

});
