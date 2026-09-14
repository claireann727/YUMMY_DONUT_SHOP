CREATE DATABASE IF NOT EXISTS yummy_donut
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE yummy_donut;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('customer','admin') NOT NULL DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NULL,
    customer_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(40) NOT NULL,
    address TEXT NOT NULL,
    total DECIMAL(10,2) NOT NULL,
    status ENUM('Pending','Preparing','Out for Delivery','Completed','Cancelled')
        NOT NULL DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id)
);

INSERT INTO products (name, description, image, price)
SELECT * FROM (
    SELECT 'Strawberry Sprinkle',
           'Sweet strawberry glaze topped with colorful sprinkles.',
           'images/donut-1.png', 45.00
    UNION ALL SELECT 'Choco Hazelnut',
           'Rich chocolate glaze with crunchy hazelnut topping.',
           'images/donut-2.png', 50.00
    UNION ALL SELECT 'Cookies & Cream',
           'Creamy cookies and cream topped with cookie pieces.',
           'images/donut-3.png', 50.00
    UNION ALL SELECT 'Choco Drizzle',
           'Rich chocolate glaze finished with white chocolate drizzle.',
           'images/donut-4.png', 45.00
    UNION ALL SELECT 'Caramel Crunch',
           'Sweet caramel glaze topped with crunchy caramel pieces.',
           'images/donut-5.png', 50.00
    UNION ALL SELECT 'Strawberry Drizzle',
           'Delicious strawberry glaze finished with sweet white drizzle.',
           'images/donut-6.png', 45.00
) AS seed
WHERE NOT EXISTS (SELECT 1 FROM products);
