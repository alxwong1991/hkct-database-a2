-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3305
-- Generation Time: Apr 19, 2022 at 03:00 PM
-- Server version: 8.0.27
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jjpn`
--
CREATE DATABASE IF NOT EXISTS `jjpn` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `jjpn`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `C_ID` int NOT NULL,
  `C_productName` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `C_price` int NOT NULL,
  `C_priceTotal` int NOT NULL,
  `C_quantity` int NOT NULL,
  `PL_ID` int NOT NULL,
  PRIMARY KEY (`C_ID`),
  UNIQUE KEY `PL_ID` (`PL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`C_ID`, `C_productName`, `C_price`, `C_priceTotal`, `C_quantity`, `PL_ID`) VALUES
(1, 'abc', 12, 12, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

DROP TABLE IF EXISTS `manufacturer`;
CREATE TABLE IF NOT EXISTS `manufacturer` (
  `M_code` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Manufacturer type',
  `M_ID` int NOT NULL,
  `M_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `M_contact_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `M_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `M_BR` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Business registration number',
  PRIMARY KEY (`M_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`M_code`, `M_ID`, `M_name`, `M_contact_number`, `M_address`, `M_BR`) VALUES
('HKM', 1, 'Valentino', '+852 28292717', '88 QUEENSWAY, ADMIRALITY\r\nL2, HARVEY NICHOLS PACIFIC PLACE\r\nADMIRALTY\r\nHONG KONG ISLAND\r\nHONG KONG SAR CHINA', 'VAT 05412951005');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `O_ID` int NOT NULL,
  `Pay_ID` int NOT NULL,
  `U_ID` int NOT NULL,
  `PL_ID` int NOT NULL,
  `Pay_hasPaid` int NOT NULL,
  PRIMARY KEY (`O_ID`),
  UNIQUE KEY `U_ID` (`U_ID`),
  UNIQUE KEY `Pay_ID` (`Pay_ID`),
  UNIQUE KEY `PL_ID` (`PL_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`O_ID`, `Pay_ID`, `U_ID`, `PL_ID`, `Pay_hasPaid`) VALUES
(1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `Pay_ID` int NOT NULL,
  `C_ID` int NOT NULL,
  PRIMARY KEY (`Pay_ID`),
  UNIQUE KEY `C_ID` (`C_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Pay_ID`, `C_ID`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `P_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Product type',
  `P_ID` int NOT NULL AUTO_INCREMENT,
  `P_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_price` decimal(8,2) NOT NULL COMMENT 'Price per piece',
  `P_color` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_size` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `M_ID` int NOT NULL COMMENT 'Manufacturer ID',
  `M_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`P_ID`),
  KEY `M_ID` (`M_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`P_code`, `P_ID`, `P_title`, `P_price`, `P_color`, `P_size`, `M_ID`, `M_name`) VALUES
('MTP', 1, 'Men‘s T-Shirt', '6400.00', 'BLACK', 'M', 1, 'Valentino'),
('MTP', 2, 'Men‘s T-Shirt', '6400.00', 'BLACK', 'XXL', 1, 'Valentino'),
('WBP', 3, 'Women‘s Beg', '19900.00', 'INK BLUE', 'One Size available', 1, 'Valentino'),
('WBP', 4, 'Women‘s Beg', '19900.00', 'BEIGE', 'One Size available', 1, 'Valentino'),
('WBP', 5, 'Women‘s Beg', '19900.00', 'WHITE', 'One Size available', 1, 'Valentino');

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

DROP TABLE IF EXISTS `product_list`;
CREATE TABLE IF NOT EXISTS `product_list` (
  `ID` int NOT NULL AUTO_INCREMENT COMMENT 'Product number',
  `P_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_ID` int NOT NULL,
  `P_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RE_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `RE_ID` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `P_ID` (`P_ID`),
  KEY `RE_ID` (`RE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`ID`, `P_code`, `P_ID`, `P_title`, `P_state`, `RE_name`, `RE_ID`) VALUES
(1, 'MTP', 1, 'Men‘s T-Shirt Product\r\n', 'inStock', 'Branch Store ', 3),
(2, 'MTP', 1, 'Men‘s T-Shirt Product\r\n', 'inStock', 'Branch Store ', 3),
(3, 'MTP', 1, 'Men‘s T-Shirt Product\r\n', 'inStock', 'Branch Store ', 2),
(4, 'MTP', 1, 'Men‘s T-Shirt Product\r\n', 'inStock', 'Branch Store ', 2),
(5, 'MTP', 1, 'Men‘s T-Shirt Product\r\n', 'inStock', 'Branch Store ', 2),
(6, 'MTP', 2, 'Men‘s T-Shirt Product\r\n', 'inStock', 'Branch Store ', 3),
(7, 'MTP', 2, 'Men‘s T-Shirt Product\r\n', 'inStock', 'Branch Store ', 3),
(8, 'MTP', 2, 'Men‘s T-Shirt Product\r\n', 'inStock', 'Branch Store ', 2),
(9, 'MTP', 2, 'Men‘s T-Shirt Product\r\n', 'inStock', 'Branch Store ', 2),
(10, 'MTP', 2, 'Men‘s T-Shirt Product\r\n', 'inStock', 'Branch Store ', 2),
(11, 'WBP', 3, 'Women‘s Beg', 'inStock', 'Branch Store ', 2),
(12, 'WBP', 3, 'Women‘s Beg', 'inStock', 'Branch Store ', 3),
(13, 'WBP', 3, 'Women‘s Beg', 'inStock', 'Branch Store ', 3),
(14, 'WBP', 4, 'Women‘s Beg', 'inStock', 'Branch Store ', 2),
(15, 'WBP', 4, 'Women‘s Beg', 'inStock', 'Branch Store ', 3),
(16, 'WBP', 5, 'Women‘s Beg', 'inStock', 'Branch Store ', 2),
(17, 'WBP', 5, 'Women‘s Beg', 'inStock', 'Branch Store ', 3),
(18, 'WBP', 5, 'Women‘s Beg', 'inStock', 'Branch Store ', 2),
(19, 'WBP', 5, 'Women‘s Beg', 'inStock', 'Branch Store ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `real_estate`
--

DROP TABLE IF EXISTS `real_estate`;
CREATE TABLE IF NOT EXISTS `real_estate` (
  `RE_code` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Region and Category',
  `RE_ID` int NOT NULL,
  `RE_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `RE_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `RE_contact_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `RE_manager` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`RE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `real_estate`
--

INSERT INTO `real_estate` (`RE_code`, `RE_ID`, `RE_name`, `RE_address`, `RE_contact_number`, `RE_manager`) VALUES
('TWWH', 1, 'Warehouse', 'TSMC R&D Center, Fab 12B\r\n168, Park Ave. II, Hsinchu Science Park, Hsinchu 300-75, Taiwan, R.O.C.', '886-3-5636688', 'Morris Chang'),
('HKB', 2, 'Branch Store 1', 'International Finance Centre \r\n8 Finance Street\r\nCentral', '+852 39721500', 'Tim Cook'),
('HKB', 3, 'Branch Store 2', 'Hysan Place\r\n500 Hennessy Road\r\nCauseway Bay', '+852 39793100', 'Winnie the Pooh');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `U_ID` int NOT NULL AUTO_INCREMENT,
  `U_surname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `U_givenName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `U_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `U_profilePic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `U_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `U_mobileNumber` int NOT NULL,
  `U_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `C_ID` int NOT NULL,
  `U_memberPoint` int NOT NULL,
  PRIMARY KEY (`U_ID`),
  UNIQUE KEY `C_ID` (`C_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`U_ID`, `U_surname`, `U_givenName`, `U_email`, `U_profilePic`, `U_password`, `U_mobileNumber`, `U_address`, `C_ID`, `U_memberPoint`) VALUES
(1, 'joe', 'john', 'john@doe.com', '', 'abc', 23456154, 'johndoev', 1, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`U_ID`) REFERENCES `users` (`U_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`Pay_ID`) REFERENCES `payment` (`Pay_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`C_ID`) REFERENCES `cart` (`C_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`M_ID`) REFERENCES `manufacturer` (`M_ID`);

--
-- Constraints for table `product_list`
--
ALTER TABLE `product_list`
  ADD CONSTRAINT `Product_list_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `product` (`P_ID`),
  ADD CONSTRAINT `Product_list_ibfk_2` FOREIGN KEY (`RE_ID`) REFERENCES `real_estate` (`RE_ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`C_ID`) REFERENCES `cart` (`C_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
