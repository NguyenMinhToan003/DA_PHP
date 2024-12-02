-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 02, 2024 at 06:30 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e1`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `catagory_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`catagory_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catagory_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', 'All electronic items', '2024-11-30 07:33:46', '2024-11-30 07:33:46'),
(2, 'Fashion', 'Clothing and accessories', '2024-11-30 07:33:46', '2024-11-30 07:33:46'),
(3, 'Home Appliances', 'Appliances for home use', '2024-11-30 07:33:46', '2024-11-30 07:33:46'),
(20, 'Quần áo nam', 'Quần áo nam', '2024-12-01 06:10:54', '2024-12-01 06:10:54'),
(21, 'Quần áo nữ', 'Quần áo nữ', '2024-12-01 06:10:54', '2024-12-01 06:10:54');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `color_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `color` varchar(100) NOT NULL,
  PRIMARY KEY (`color_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`color_code`, `color`) VALUES
('blue-700', 'blue-500'),
('green-500', 'green-500'),
('purple-800', 'purple-500'),
('red-400', 'red-400');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `url_image` varchar(255) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `url_image`, `product_id`) VALUES
(1, '../images/product1.png', 1),
(2, '../images/product2.png', 1),
(3, '../images/product3.png', 1),
(4, '../images/product4.png', 1),
(5, '../images/product5.png', 2),
(6, '../images/product6.png', 2),
(7, '../images/product7.png', 2),
(8, '../images/product7.png', 2),
(18, '../images/product7.png', 1),
(20, '../images/product7.png', 9),
(21, '../images/product6.png', 9),
(22, '../images/product7.png', 9),
(23, '../images/product6.png', 9),
(24, '../images/product5.png', 10),
(25, '../images/product4.png', 10),
(26, '../images/product5.png', 10),
(27, '../images/product4.png', 10),
(28, '../images/product3.png\r\n', 10),
(29, '../images/product3.png\r\n', 10),
(30, '../images/product3.png\r\n', 10),
(31, '../images/product3.png\r\n', 10);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_date` datetime NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `order_date`) VALUES
(1, 1, '2024-12-02 06:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `detail_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`detail_id`),
  KEY `order` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`detail_id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 101, 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `category_id` int NOT NULL,
  `stock` int DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `category_id`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'Smartphone', 'Latest smartphone with amazing features', 499.99, 1, 100, '2024-11-30 07:33:46', '2024-11-30 07:33:46'),
(2, 'T-Shirt', 'Comfortable cotton t-shirt', 19.99, 2, 200, '2024-11-30 07:33:46', '2024-11-30 07:33:46'),
(9, 'Havic HV G-92 Gamepad', 'PlayStation 5 Controller Skin High quality vinyl with air channel adhesive for easy bubble free install & mess free removal Pressure sensitive.', 183.00, 1, 20, '2024-12-01 07:54:07', '2024-12-01 07:54:07'),
(10, 'Havic HV G-92 Gamepad', 'PlayStation 5 Controller Skin High quality vinyl with air channel adhesive for easy bubble free install & mess free removal Pressure sensitive.', 183.00, 1, 20, '2024-12-01 07:54:10', '2024-12-01 07:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

DROP TABLE IF EXISTS `product_color`;
CREATE TABLE IF NOT EXISTS `product_color` (
  `product_id` int NOT NULL,
  `color_id` varchar(20) NOT NULL,
  PRIMARY KEY (`product_id`,`color_id`),
  KEY `color_id` (`color_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`product_id`, `color_id`) VALUES
(1, 'blue-700'),
(2, 'blue-700'),
(1, 'green-500'),
(2, 'green-500'),
(1, 'purple-800'),
(2, 'purple-800'),
(1, 'red-400'),
(2, 'red-400');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

DROP TABLE IF EXISTS `product_size`;
CREATE TABLE IF NOT EXISTS `product_size` (
  `product_id` int NOT NULL,
  `size_id` varchar(10) NOT NULL,
  PRIMARY KEY (`product_id`,`size_id`),
  KEY `size_id` (`size_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`product_id`, `size_id`) VALUES
(1, 'L'),
(2, 'L'),
(1, 'M'),
(2, 'M'),
(1, 'S'),
(2, 'S'),
(1, 'XL'),
(2, 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `size_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `size` varchar(100) NOT NULL,
  PRIMARY KEY (`size_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_code`, `size`) VALUES
('L', 'Large'),
('M', 'Medium'),
('S', 'Small'),
('XL', 'Extra Large');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role_id` int NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `role_id`, `address`) VALUES
(1, 'dawda', '1', 'dawdaw', 1, 'dawd'),
(2, 'adawdawd', 'dadawda', 'daddaw', 2, 'awdawd'),
(3, '1', '1', '1', 2, ''),
(4, 'adwad', 'dawda', 'dwad', 2, 'adaw'),
(5, '11', '11', '11', 2, '11');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`catagory_id`);

--
-- Constraints for table `product_color`
--
ALTER TABLE `product_color`
  ADD CONSTRAINT `product_color_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `product_color_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `colors` (`color_code`);

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `product_size_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_code`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
