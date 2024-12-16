-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 14, 2024 at 02:52 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catagory_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(37, 'Sạc dự phòng', '', '2024-12-14 05:20:58', '2024-12-14 05:20:58'),
(38, 'Bàn phím', '', '2024-12-14 05:21:08', '2024-12-14 05:21:15'),
(39, 'Chuột', '', '2024-12-14 05:21:25', '2024-12-14 05:21:25'),
(40, 'Lót chuột', '', '2024-12-14 05:21:35', '2024-12-14 05:21:35'),
(41, 'Màn hình', '', '2024-12-14 05:22:03', '2024-12-14 05:22:03'),
(42, 'Tai nghe', '', '2024-12-14 05:22:30', '2024-12-14 05:22:30'),
(43, 'Giá đỡ', '', '2024-12-14 05:22:41', '2024-12-14 05:22:41'),
(44, 'Tay Cầm', '', '2024-12-14 05:30:18', '2024-12-14 05:30:18');

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`color_id`, `color_name`, `color_code`) VALUES
(11, 'Trắng', 'white'),
(12, 'black', 'black'),
(13, 'xanh lá', 'green-500'),
(14, 'Đỏ', 'red-500'),
(15, 'Vàng', 'yellow-500'),
(16, 'Xanh dương', 'blue-500'),
(17, 'Xám', 'gray-500');

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `url_image`, `product_id`) VALUES
(42, './uploads/1637ae2a3f43363c6e85ad69ded72ca6.png', 61),
(43, './uploads/db16a72c445c3b37fb9a67b329bd9623.png', 61),
(44, './uploads/61bc6ca0b943deb41ee8a513214ef7a4.png', 61),
(45, './uploads/724c448c2c69ed73d927411c6ea841a8.png', 61),
(51, './uploads/b5f2d8f5e55a69aa290334f9a8551b8a.png', 60),
(52, './uploads/e20f4bfa9a24f923d010963d7b2d6bad.png', 60),
(53, './uploads/336c0ac9c6e27c6d0dd3962630a9c942.png', 60),
(54, './uploads/90a854388866e1b1495904140d1ae8f0.png', 60),
(55, './uploads/b519f019b74f333e53863161216e3db7.png', 60);

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
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `email`, `user_name`, `user_address`, `tel`, `note`, `total`, `status`) VALUES
(72, 12, 'admin@gmail.com', 'admin', 'Ha Noi', '23444', '', 5000, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`detail_id`, `order_id`, `product_detail_id`, `quantity`, `product_name`, `total_price`) VALUES
(59, 72, 71, 5, 'Havic HV G-92 Gamepad', 5000);

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
  `brand_id` int NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  KEY `brand_id` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `category_id`, `brand_id`, `price`) VALUES
(60, 'Havic HV G-92 Gamepad', 'Dán bảo vệ tay cầm PlayStation 5 được làm từ chất liệu vinyl cao cấp, mang lại độ bền và thẩm mỹ cao. Với công nghệ keo dán kênh dẫn khí, việc lắp đặt trở nên dễ dàng mà không lo xuất hiện bọt khí, đồng thời có thể tháo gỡ mà không để lại bất kỳ vết keo nào. Sản phẩm được thiết kế nhạy cảm với áp lực, giúp bám chắc chắn vào tay cầm, mang lại trải nghiệm sử dụng hoàn hảo.', 44, 1, 0),
(61, 'Màn hình AFA', 'Màn hình cực ngon trong tầm giá', 39, 1, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`product_detail_id`, `product_id`, `size_id`, `color_id`, `price`, `quantity`) VALUES
(71, 60, 10, 11, 1000, 10),
(72, 60, 10, 13, 1200, 10),
(73, 60, 11, 16, 1200, 100),
(76, 61, 12, 12, 12, 12);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `size_name`, `size_code`) VALUES
(10, 'Nhỏ', 'Nhỏ'),
(11, 'Vừa', 'Vừa'),
(12, 'Lớn', 'Lớn');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `role_id`, `address`, `tel`) VALUES
(8, '3@gmail.com', '1234', '123', 2, 'HCM', ''),
(12, 'admin@gmail.com', 'admin', '123', 1, 'Ha Noi', ''),
(13, 'user@gmail.com', 'user', '123', 2, 'Ha Noi', '');

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
