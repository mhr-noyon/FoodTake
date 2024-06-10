CREATE TABLE `deliveryboys`(
    `delivery_boy_id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(15) NOT NULL,
    `city` VARCHAR(50) NOT NULL,
    `address` TEXT NOT NULL,
    `deliveries_count` INT NULL AUTO_INCREMENT,
    `bonus_amount` DECIMAL(10, 2) NULL DEFAULT '0',
    `active` TINYINT NULL DEFAULT '1' AUTO_INCREMENT
);
CREATE TABLE `customers`(
    `customer_id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `phone` VARCHAR(15) NOT NULL,
    `city` VARCHAR(50) NOT NULL,
    `address` TEXT NOT NULL,
    `total_spent` DECIMAL(10, 2) NULL DEFAULT '0',
    `discount_percentage` DECIMAL(5, 2) NULL DEFAULT '0'
);
CREATE TABLE `foods`(
    `food_id` INT NOT NULL AUTO_INCREMENT INDEX,
    `name` VARCHAR(100) NOT NULL,
    `image` TEXT NULL,
    `description` TEXT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `available` TINYINT NULL DEFAULT '1' AUTO_INCREMENT
);
CREATE TABLE `admins`(
    `admin_id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(100) NOT NULL
);
CREATE TABLE `cart`(
    `cart_id` INT NOT NULL AUTO_INCREMENT,
    `customer_id` INT NULL AUTO_INCREMENT,
    `food_id` INT NULL AUTO_INCREMENT,
    `description` TEXT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `quantity` INT NULL DEFAULT '1' AUTO_INCREMENT
);
CREATE TABLE `orders`(
    `order_id` INT NOT NULL AUTO_INCREMENT,
    `customer_id` INT NULL AUTO_INCREMENT,
    `phone` VARCHAR(13) NULL,
    `address` VARCHAR(255) NULL,
    `order_date` DATETIME NULL DEFAULT 'current_timestamp()',
    `delivery_date` DATETIME NULL,
    `food_id` INT NULL AUTO_INCREMENT,
    `quantity` INT NULL AUTO_INCREMENT,
    `total_amount` DECIMAL(10, 2) NULL,
    `status` ENUM('') NULL DEFAULT '' pending '',
    `pin` INT NULL AUTO_INCREMENT,
    `delivery_boy` INT NULL AUTO_INCREMENT
);
ALTER TABLE
    `deliveryboys` ADD CONSTRAINT `deliveryboys_delivery_boy_id_foreign` FOREIGN KEY(`delivery_boy_id`) REFERENCES `orders`(`delivery_boy`);
ALTER TABLE
    `orders` ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY(`customer_id`) REFERENCES `customers`(`customer_id`);
ALTER TABLE
    `foods` ADD CONSTRAINT `foods_food_id_foreign` FOREIGN KEY(`food_id`) REFERENCES `orders`(`food_id`);
ALTER TABLE
    `cart` ADD CONSTRAINT `cart_food_id_foreign` FOREIGN KEY(`food_id`) REFERENCES `foods`(`food_id`);
ALTER TABLE
    `cart` ADD CONSTRAINT `cart_customer_id_foreign` FOREIGN KEY(`customer_id`) REFERENCES `customers`(`customer_id`);