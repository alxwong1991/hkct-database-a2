-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 20, 2022 at 10:21 AM
-- Server version: 8.0.28
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jjpn(re)`
--
CREATE DATABASE IF NOT EXISTS `jjpn(re)` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `jjpn(re)`;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `L_ID` int NOT NULL,
  `L_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `L_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `L_contact_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `L_manager` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`L_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`L_ID`, `L_name`, `L_address`, `L_contact_number`, `L_manager`) VALUES
(1, 'Warehouse', 'TSMC R&D Center, Fab 12B\r\n168, Park Ave. II, Hsinchu Science Park, Hsinchu 300-75, Taiwan, R.O.C.', '886-3-5636688', 'Morris Chang'),
(2, 'Branch Store 1', 'International Finance Centre \r\n8 Finance Street\r\nCentral', '+852 39721500', 'Tim Cook'),
(3, 'Branch Store 2', 'Hysan Place\r\n500 Hennessy Road\r\nCauseway Bay', '+852 39793100', 'Winnie the Pooh');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

DROP TABLE IF EXISTS `manufacturer`;
CREATE TABLE IF NOT EXISTS `manufacturer` (
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

INSERT INTO `manufacturer` (`M_ID`, `M_name`, `M_contact_number`, `M_address`, `M_BR`) VALUES
(1, 'Valentino', '+852 28292717', '88 QUEENSWAY, ADMIRALITY\r\nL2, HARVEY NICHOLS PACIFIC PLACE\r\nADMIRALTY\r\nHONG KONG ISLAND\r\nHONG KONG SAR CHINA', 'VAT 05412951005');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `O_ID` int NOT NULL,
  `PL_ID` int NOT NULL,
  `amount` int NOT NULL,
  PRIMARY KEY (`O_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`O_ID`, `PL_ID`, `amount`) VALUES
(1, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `P_ID` int NOT NULL AUTO_INCREMENT,
  `P_key` int DEFAULT NULL,
  `P_color` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_size` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`P_ID`),
  KEY `P_key` (`P_key`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`P_ID`, `P_key`, `P_color`, `P_size`) VALUES
(1, 1, 'BLACK', 'M'),
(2, 1, 'BLACK', 'XXL'),
(3, 2, 'INK BLUE', 'One Size available'),
(4, 2, 'BEIGE', 'One Size available'),
(5, 2, 'WHITE', 'One Size available');

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

DROP TABLE IF EXISTS `product_list`;
CREATE TABLE IF NOT EXISTS `product_list` (
  `PL_ID` int NOT NULL AUTO_INCREMENT COMMENT 'Product number',
  `P_ID` int DEFAULT NULL,
  `P_state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `L_ID` int NOT NULL,
  `D_check` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'NULL' COMMENT 'Daily_check',
  `DC_datetime` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last check time',
  PRIMARY KEY (`PL_ID`),
  KEY `L_ID` (`L_ID`),
  KEY `P_ID` (`P_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`PL_ID`, `P_ID`, `P_state`, `L_ID`, `D_check`, `DC_datetime`) VALUES
(1, 1, 'inStock', 1, '0', '2022-04-20 13:29:33'),
(2, 1, 'inStock', 2, '0', '2022-04-20 13:29:33'),
(3, 1, 'inStock', 3, '0', '2022-04-20 13:29:33'),
(4, 1, 'inStock', 2, '0', '2022-04-20 13:29:33'),
(5, 1, 'inStock', 2, '0', '2022-04-20 13:29:33'),
(6, 2, 'inStock', 3, '0', '2022-04-20 13:29:33'),
(7, 2, 'inStock', 3, '0', '2022-04-20 13:29:33'),
(8, 2, 'inStock', 2, '0', '2022-04-20 13:29:33'),
(9, 2, 'inStock', 1, '0', '2022-04-20 13:29:33'),
(10, 2, 'inStock', 2, '0', '2022-04-20 13:29:33'),
(11, 3, 'inStock', 2, '0', '2022-04-20 13:29:33'),
(12, 3, 'inStock', 3, '0', '2022-04-20 13:29:33'),
(13, 4, 'inStock', 3, '0', '2022-04-20 13:29:33'),
(14, 4, 'inStock', 1, '0', '2022-04-20 13:29:33'),
(15, 4, 'inStock', 1, '0', '2022-04-20 13:29:33'),
(16, 4, 'inStock', 2, '0', '2022-04-20 13:29:33'),
(17, 4, 'inStock', 3, '0', '2022-04-20 13:29:33'),
(18, 5, 'inStock', 2, '0', '2022-04-20 13:29:33'),
(19, 5, 'inStock', 2, '0', '2022-04-20 13:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

DROP TABLE IF EXISTS `product_type`;
CREATE TABLE IF NOT EXISTS `product_type` (
  `P_key` int NOT NULL AUTO_INCREMENT,
  `P_Title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'Product Name',
  `P_price` decimal(8,2) NOT NULL COMMENT 'Unit Price',
  `M_ID` int NOT NULL,
  PRIMARY KEY (`P_key`),
  KEY `M_ID` (`M_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`P_key`, `P_Title`, `P_price`, `M_ID`) VALUES
(1, 'Tommy embroidered logo T-shirt', '6400.00', 1),
(2, 'VSLING plaque mini bag', '11900.00', 1);

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
  `U_memberPoint` int NOT NULL,
  `O_ID` int NOT NULL,
  PRIMARY KEY (`U_ID`),
  KEY `O_ID` (`O_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`U_ID`, `U_surname`, `U_givenName`, `U_email`, `U_profilePic`, `U_password`, `U_mobileNumber`, `U_address`, `U_memberPoint`, `O_ID`) VALUES
(1, 'joe', 'john', 'john@doe.com', '', 'abc', 23456154, 'johndoev', 0, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `product_categories_ibfk_2` FOREIGN KEY (`P_key`) REFERENCES `product_type` (`P_key`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_list`
--
ALTER TABLE `product_list`
  ADD CONSTRAINT `product_list_ibfk_1` FOREIGN KEY (`L_ID`) REFERENCES `location` (`L_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `product_list_ibfk_2` FOREIGN KEY (`P_ID`) REFERENCES `product_categories` (`P_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `product_type`
--
ALTER TABLE `product_type`
  ADD CONSTRAINT `product_type_ibfk_1` FOREIGN KEY (`M_ID`) REFERENCES `manufacturer` (`M_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`O_ID`) REFERENCES `orders` (`O_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/* hi hihihihihihihihihihi */