-- ==========================================
-- emPIEsema Database Schema
-- ==========================================

CREATE DATABASE IF NOT EXISTS empiesema CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE empiesema;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS product_specs;
DROP TABLE IF EXISTS products;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    code VARCHAR(100),
    price DECIMAL(12,2) NOT NULL,
    image VARCHAR(255),
    status VARCHAR(100),
    color VARCHAR(100),
    material VARCHAR(150),
    dimensions VARCHAR(100),
    description TEXT,
    made TEXT,
    category VARCHAR(20) DEFAULT NULL,
    featured TINYINT(1) NOT NULL DEFAULT 0,
    stock INT NOT NULL DEFAULT 3,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE product_specs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    spec TEXT NOT NULL,
    column_no TINYINT NOT NULL,
    CONSTRAINT fk_product_specs
        FOREIGN KEY (product_id)
        REFERENCES products(id)
        ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'customer',
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
    first_name VARCHAR(100) NOT NULL DEFAULT '',
    last_name VARCHAR(100) NOT NULL DEFAULT '',
    email VARCHAR(150) NOT NULL DEFAULT '',
    email_verified TINYINT(1) NOT NULL DEFAULT 0,
    verification_token VARCHAR(64) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE accounts DROP COLUMN IF EXISTS full_name;
ALTER TABLE accounts ADD COLUMN IF NOT EXISTS first_name VARCHAR(100) NOT NULL DEFAULT '';
ALTER TABLE accounts ADD COLUMN IF NOT EXISTS last_name VARCHAR(100) NOT NULL DEFAULT '';
ALTER TABLE accounts ADD COLUMN IF NOT EXISTS email VARCHAR(150) NOT NULL DEFAULT '';
ALTER TABLE accounts ADD COLUMN IF NOT EXISTS email_verified TINYINT(1) NOT NULL DEFAULT 0;
ALTER TABLE accounts ADD COLUMN IF NOT EXISTS verification_token VARCHAR(64) DEFAULT NULL;

CREATE TABLE IF NOT EXISTS mail_settings (
    id INT PRIMARY KEY DEFAULT 1,
    smtp_host VARCHAR(150) NOT NULL DEFAULT 'smtp.gmail.com',
    smtp_port INT NOT NULL DEFAULT 587,
    smtp_username VARCHAR(150) NOT NULL DEFAULT '',
    smtp_password VARCHAR(255) NOT NULL DEFAULT '',
    from_email VARCHAR(150) NOT NULL DEFAULT '',
    from_name VARCHAR(150) NOT NULL DEFAULT 'emPIEsema'
);

INSERT IGNORE INTO mail_settings (id) VALUES (1);

<<<<<<< HEAD
=======
=======
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

>>>>>>> 0c6d304ba7fa2b3aabd4388a295d8bbe207c534a
>>>>>>> 7630a55c3b37e16000825c99b1d344a7d9e4d13a
CREATE TABLE IF NOT EXISTS cart_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_cart_account
        FOREIGN KEY (account_id) REFERENCES accounts(id) ON DELETE CASCADE,
    CONSTRAINT fk_cart_product
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY uniq_account_product (account_id, product_id)
);

CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL,
    full_name VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    notes TEXT,
    payment_method VARCHAR(20) NOT NULL DEFAULT 'cod',
    subtotal DECIMAL(12,2) NOT NULL,
    shipping_fee DECIMAL(12,2) NOT NULL DEFAULT 0,
    total DECIMAL(12,2) NOT NULL,
    status VARCHAR(20) NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_order_account
        FOREIGN KEY (account_id) REFERENCES accounts(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT DEFAULT NULL,
    product_name VARCHAR(255) NOT NULL,
    image VARCHAR(255),
    price DECIMAL(12,2) NOT NULL,
    quantity INT NOT NULL,
    CONSTRAINT fk_order_items_order
        FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    CONSTRAINT fk_order_items_product
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE SET NULL
);
