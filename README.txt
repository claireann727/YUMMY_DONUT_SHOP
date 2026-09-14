YUMMY DONUT - COMPLETE ORDERING WEBSITE

FEATURES
1. Responsive homepage
2. MySQL product database
3. Session-based shopping cart
4. Quantity updates/removal
5. Checkout form
6. Orders + order items stored in MySQL
7. Customer registration/login
8. Customer order history
9. Admin dashboard
10. Admin order-status management
11. Password hashing with password_hash/password_verify

INSTALLATION (XAMPP)
1. Copy this folder into C:\xampp\htdocs\
2. Start Apache and MySQL.
3. Open phpMyAdmin.
4. Import database.sql.
5. Check config.php database username/password.
6. Visit http://localhost/yummy_donut_shop/
7. Open http://localhost/yummy_donut_shop/create_admin.php ONCE.
8. Login at login.php:
   Email: admin@yummydonut.com
   Password: admin123
9. IMPORTANT: Delete create_admin.php after creating the admin account.

IMAGES
Already included in images/ and wired up to match the mockup:
- logo.png          Navbar logo (every page)
- hero-donut.png     Hero banner — also used as the "How We Make It"
                     fallback shot if you don't add shop.jpg
- donut-1.png .. donut-6.png   Menu grid + hero + CTA gallery
- donut-making.png   The 4-step "Freshly Prepared / Perfectly Baked /
                     Sweetly Glazed / Ready to Share" strip

Optional, not included:
- shop.jpg          Photo for the "Why Choose Us" display-case shot.
                     Falls back to hero-donut.png automatically if
                     you don't add one.

PAYMENT
This version records orders and totals but does NOT process real online payments.
A payment gateway can be connected later.

CODE STRUCTURE (cleaned up)
- partials/nav.php     Shared navbar (logo, menu links, cart badge,
                        login/account/admin state). Included by every
                        page so the header can never drift out of sync.
- partials/footer.php  Shared footer + script tag + closing </body></html>.
- style.css             One stylesheet for the whole site, including
                        the cart/checkout/login/account/admin pages
                        (previously unstyled).
- script.js             Matches the actual current markup — no more
                        dead code pointing at classes that don't exist.

Two older, unused mockup files (index.html and html.html) used a
different hardcoded product list and a separate mysqli connection
that didn't match the rest of the site (which uses PDO via
functions.php/config.php and the products table). They've been
removed so there's a single, working homepage: index.php.
