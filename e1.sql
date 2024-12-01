-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 01, 2024 at 08:16 AM
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
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int NOT NULL AUTO_INCREMENT,
  `url_image` varchar(255) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`image_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(27, '../images/product4.png', 10);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
