-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 13, 2024 at 01:18 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_37906965_e1`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--


--
-- Dumping data for table `brands`
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT  CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catagory_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(22, 'Tai nghe', 'Tai Nghe', '2024-12-03 13:21:32', '2024-12-03 13:21:32'),
(23, 'Bàn phím', 'Bàn phím', '2024-12-03 13:21:36', '2024-12-03 13:23:14'),
(24, 'Sạc', 'Sạc', '2024-12-03 13:21:54', '2024-12-03 13:21:54'),
(25, 'Điện thoại', 'Điện Thoại', '2024-12-03 13:22:39', '2024-12-03 13:22:39'),
(35, 'Chuột không dây', 'Chuột không dây', '2024-12-09 17:20:48', '2024-12-09 17:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `color_id` int NOT NULL AUTO_INCREMENT,
  `color_name` varchar(10) NOT NULL,
  `color_code` varchar(10) NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT  CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`color_id`, `color_name`, `color_code`) VALUES
(1, 'red', 'red-500'),
(2, 'orange', 'orange-500'),
(3, 'black', 'black'),
(4, 'white', 'white'),
(5, 'black', 'black'),
(7, 'Xanh nước ', 'sky-800');

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT  CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `url_image`, `product_id`) VALUES
(12, './uploads/022f2f4b1ed0c1235d3968064f236712.png', 53),
(13, './uploads/6bbbcc8dd4a50876f797e8f2726fa84a.png', 54),
(14, './uploads/f10120d2c50f9458e775b633c226bfda.png', 55),
(15, './uploads/029903997e70dac236762f20af665a2e.png', 56),
(16, './uploads/e5ee240ec7b94d1dcb4bc7d05bf75202.png', 56),
(17, './uploads/6be6160643db95e62e2b054e26fa33ea.png', 56),
(18, './uploads/425fc9f43864cce8bd5d9bce609a9545.png', 56),
(19, './uploads/3bc7b979f3b3a2154049218f2b0d6dbd.png', 56),
(20, './uploads/c329070bd1213b54e7bcb2179c6ae60a.png', 57),
(21, './uploads/c6e8d40b73347d2a38aa771cd13e55e6.png', 57),
(22, './uploads/6837faaffa8faaa554d101301445ba45.png', 57),
(23, './uploads/e3984669d92eed0f2febdfcf848a258d.png', 57),
(24, './uploads/34ab5c3eb93c19082a01964faa8d60d6.png', 57),
(25, './uploads/87a2f5d21b8950e28e535511e0cf22f4.png', 57),
(26, './uploads/972e3344dd6743286955fb29a8d6db58.png', 58),
(27, './uploads/9e2b6235cd393dd26c0ed8f884b21541.png', 58),
(28, './uploads/a58110fa7f0aa4ec2552cf491937d8f9.png', 58),
(29, './uploads/0e91707931498e9f834d9b052fc038d5.png', 58),
(30, './uploads/316700979579a9db421f7c4cd8b7fd14.png', 58),
(31, './uploads/5b1c6321f072b285d6a1f3e9be61f7d4.jpg', 59);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `user_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tel` varchar(11) NOT NULL,
  `note` text NOT NULL,
  `total` float NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT  CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `email`, `user_name`, `user_address`, `tel`, `note`, `total`, `status`) VALUES
(2, 8, '3@gmail.com', 'Tom', '456 Avenue', '0987654321', 'Có', 232580, 1),
(67, 13, 'user@gmail.com', 'user', 'Ha Noi', '1111', '', 232211, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `detail_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_detail_id` int NOT NULL,
  `quantity` int NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `total_price` float NOT NULL,
  PRIMARY KEY (`detail_id`),
  KEY `order` (`order_id`),
  KEY `product_detail_id` (`product_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT  CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`detail_id`, `order_id`, `product_detail_id`, `quantity`, `product_name`, `total_price`) VALUES
(12, 2, 57, 3, 'Sách obn lkdawdawdawdadaw', 36936),
(13, 2, 58, 1, 'Sách obn lkdawdawdawdadaw', 232211),
(53, 67, 58, 1, 'Sách obn lkdawdawdawda', 232211);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
    `product_id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `description` text,
    `category_id` int NOT NULL,
    `price` float NOT NULL,
    PRIMARY KEY (`product_id`),
    KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `category_id`,`price`) VALUES
(53, 'Sách obn lkdawdawdawda', 'dawdwawadadaw', 22,  0),
(54, 'Sách obn lkdawdawdawda', 'dawdawdawdawdawdawdawdawdawadawdawdad', 24,0),
(55, 'Sách obn lkdawdawdawda', 'dwadawdd', 22,0),
(56, 'Sách obn lkdawdawdawda', 'dwadwadaw', 22,0),
(57, 'Sách obn lkdawdawdawdadaw', 'dwadawdadawdawadw', 22,0),
(58, 'Sách obn lkdawdawdawdadaw', 'dwadawdawdawd', 22,0),
(59, 'Chuột', 'Chuột không dây', 35,0);

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

DROP TABLE IF EXISTS `product_detail`;
CREATE TABLE IF NOT EXISTS `product_detail` (
  `product_detail_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `size_id` int NOT NULL,
  `color_id` int NOT NULL,
  `price` float NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`product_detail_id`),
  KEY `product_id` (`product_id`),
  KEY `size_id` (`size_id`),
  KEY `color_id` (`color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT  CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`product_detail_id`, `product_id`, `size_id`, `color_id`,  `price`, `quantity`) VALUES
(55, 53, 6, 1, 123, 123),
(56, 54, 5, 2, 123, 123),
(57, 54, 6, 5, 12312, 1233),
(58, 55, 5, 5, 232211, 123),
(59, 56, 6, 1, 232211, 123),
(60, 56, 6, 3, 3323, 23223),
(61, 57, 7, 2, 232211, 123),
(62, 58, 6, 2, 232211, 123),
(63, 59, 6, 2, 100, 2),
(64, 59, 6, 3, 120, 3);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT  CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'ADMIN'),
(2, 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `size_id` int NOT NULL AUTO_INCREMENT,
  `size_name` varchar(10) NOT NULL,
  `size_code` varchar(10) NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT  CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `size_name`, `size_code`) VALUES
(5, 'Nhỏ', 'S'),
(6, 'Vừa', 'L'),
(7, 'Lớn', 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int NOT NULL,
  `address` text NOT NULL,
  `tel` varchar(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `role` (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT  CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `role_id`, `address`,`tel`) VALUES
(8, '3@gmail.com', '1234', '123', 2, 'HCM','0987654321'),
(12, 'admin@gmail.com', 'admin', '123', 1, 'Ha Noi','0987654321'),
(13, 'user@gmail.com', 'user', '123', 2, 'Ha Noi','1111');

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
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_detail_id`) REFERENCES `product_detail` (`product_detail_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`catagory_id`);


--
-- Constraints for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD CONSTRAINT `product_detail_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `product_detail_ibfk_2` FOREIGN KEY (`color_id`) REFERENCES `colors` (`color_id`),
  ADD CONSTRAINT `product_detail_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
