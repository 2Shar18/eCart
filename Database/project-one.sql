-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 16, 2019 at 03:45 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project-one`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
CREATE TABLE IF NOT EXISTS `history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `product_charge` int(11) DEFAULT NULL,
  `shipping_charge` int(11) DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `user_id`, `product_id`, `quantity`, `order_date`, `product_charge`, `shipping_charge`, `address`) VALUES
(1, 2, 26, 25, NULL, NULL, NULL, NULL),
(2, 2, 25, 25, NULL, NULL, NULL, NULL),
(3, 4, 26, 10, NULL, NULL, NULL, NULL),
(6, 4, 32, 10, NULL, NULL, NULL, NULL),
(5, 2, 32, 10, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user`, `pass`, `type`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'tushar', '12345', 'user'),
(4, 'abcdef', '12345', 'user'),
(16, 'herbie', 'herbie', 'user'),
(6, 'asdasdad', '12345', 'user'),
(7, 'dfsdfsdfs', 'sdfsdfsdf', 'user'),
(8, 'asdasd', 'asdasd', 'user'),
(9, 'mummya', 'asdasd', 'user'),
(10, 'daddya', '12345', 'user'),
(11, 'kinjal', 'asdasdad', 'user'),
(12, 'tusharr', '12345', 'user'),
(13, 'tusharabc', '12345', 'user'),
(14, 'pratima', '12345', 'user'),
(15, 'praful', '12345', 'user'),
(17, '', '', 'user'),
(18, 'p4123', '123p3', 'user'),
(19, 'vinaya', '12345', 'user'),
(20, 'ajay', '12345', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

DROP TABLE IF EXISTS `order_table`;
CREATE TABLE IF NOT EXISTS `order_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `product_charge` int(11) NOT NULL,
  `shipping_charge` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` bigint(10) NOT NULL,
  `delivery_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `weight`, `quantity`) VALUES
(25, 'p1', 10, 10, 20),
(26, 'p2', 30, 20, 15),
(32, 'p3', 20, 15, 10);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
