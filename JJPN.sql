-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 17, 2022 at 07:31 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+08:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- Database: `JJPN`
--
CREATE DATABASE IF NOT EXISTS `JJPN` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `JJPN`;

-- --------------------------------------------------------

-- Drop user
DROP USER IF EXISTS 'JJPN_administrator'@'localhost';

-- Create Database User
-- Database 	: 	JJPN
-- Username	  : 	JJPN_administrator
-- Password		:	  password
CREATE USER 'JJPN_administrator'@'localhost' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON *.* TO 'JJPN_administrator'@'localhost' REQUIRE 
NONE WITH GRANT OPTION 
    MAX_QUERIES_PER_HOUR 0 
    MAX_CONNECTIONS_PER_HOUR 0 
    MAX_UPDATES_PER_HOUR 0 
    MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `JJPN`.* TO 'JJPN_administrator'@'localhost';

-- --------------------------------------------------------

--
-- Table structure for table `Manufacturer`
--

CREATE TABLE `Manufacturer` (
  `M_ID` int(10) NOT NULL,
  `M_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `M_contact_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `M_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `M_BR` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Business registration number'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Manufacturer`
--

INSERT INTO `Manufacturer` (`M_ID`, `M_name`, `M_contact_number`, `M_address`, `M_BR`) VALUES
(1, 'Valentino', '+852 28292717', '88 QUEENSWAY, ADMIRALITY\r\nL2, HARVEY NICHOLS PACIFIC PLACE\r\nADMIRALTY\r\nHONG KONG ISLAND\r\nHONG KONG SAR CHINA', 'VAT 05412951005');

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `P_code` int(10) NOT NULL,
  `P_key` int(10) DEFAULT NULL,
  `P_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_price` decimal(8,2) NOT NULL COMMENT 'Price per piece',
  `P_color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_size` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `M_ID` int(10) NOT NULL COMMENT 'Manufacturer ID',
  `M_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`P_code`, `P_key`, `P_title`, `P_price`, `P_color`, `P_size`, `M_ID`, `M_name`) VALUES
(1, 1, 'Tommy embroidered logo T-shirt', '6400.00', 'BLACK', 'M', 1, 'Valentino'),
(2, 1, 'Tommy embroidered logo T-shirt', '6400.00', 'BLACK', 'XXL', 1, 'Valentino'),
(3, 2, 'VSLING plaque mini bag', '19900.00', 'INK BLUE', 'One Size available', 1, 'Valentino'),
(4, 2, 'VSLING plaque mini bag', '19900.00', 'BEIGE', 'One Size available', 1, 'Valentino'),
(5, 2, 'VSLING plaque mini bag', '19900.00', 'WHITE', 'One Size available', 1, 'Valentino');

-- --------------------------------------------------------

--
-- Table structure for table `Product_list`
--

CREATE TABLE `Product_list` (
  `P_ID` int(10) NOT NULL COMMENT 'Product number',
  `P_code` int(11) DEFAULT NULL,
  `P_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `P_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RE_ID` int(10) NOT NULL,
  `D_check` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'NULL' COMMENT 'Daily_check',
  `DC_datetime` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Last check time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Product_list`
--

INSERT INTO `Product_list` (`P_ID`, `P_code`, `P_title`, `P_state`, `RE_ID`, `D_check`, `DC_datetime`) VALUES
(1, 1, 'Tommy embroidered logo T-shirt', 'inStock', 1, '1', '2022-04-20 14:32:42'),
(2, 1, 'Tommy embroidered logo T-shirt', 'inStock', 2, '1', '2022-04-20 14:32:43'),
(3, 1, 'Tommy embroidered logo T-shirt', 'inStock', 3, '1', '2022-04-20 14:32:43'),
(4, 1, 'Tommy embroidered logo T-shirt', 'inStock', 2, '0', '2022-04-20 14:20:36'),
(5, 1, 'Tommy embroidered logo T-shirt', 'inStock', 2, '0', '2022-04-20 14:20:36'),
(6, 2, 'Tommy embroidered logo T-shirt', 'inStock', 3, '0', '2022-04-20 14:20:36'),
(7, 2, 'Tommy embroidered logo T-shirt', 'inStock', 3, '0', '2022-04-20 14:20:36'),
(8, 2, 'Tommy embroidered logo T-shirt', 'inStock', 2, '0', '2022-04-20 13:29:33'),
(9, 2, 'Tommy embroidered logo T-shirt', 'inStock', 1, '0', '2022-04-20 14:32:33'),
(10, 2, 'Tommy embroidered logo T-shirt', 'inStock', 2, '0', '2022-04-20 13:29:33'),
(11, 3, 'VSLING plaque mini bag', 'inStock', 1, '0', '2022-04-20 14:32:33'),
(12, 3, 'VSLING plaque mini bag', 'inStock', 3, '0', '2022-04-20 13:29:33'),
(13, 4, 'VSLING plaque mini bag', 'inStock', 3, '0', '2022-04-20 13:29:33'),
(14, 4, 'VSLING plaque mini bag', 'inStock', 1, '0', '2022-04-20 14:32:33'),
(15, 4, 'VSLING plaque mini bag', 'inStock', 1, '0', '2022-04-20 14:32:33'),
(16, 4, 'VSLING plaque mini bag', 'inStock', 2, '0', '2022-04-20 13:29:33'),
(17, 4, 'VSLING plaque mini bag', 'inStock', 3, '0', '2022-04-20 13:29:33'),
(18, 5, 'VSLING plaque mini bag', 'inStock', 2, '0', '2022-04-20 13:29:33'),
(19, 5, 'VSLING plaque mini bag', 'inStock', 2, '0', '2022-04-20 13:29:33');

-- --------------------------------------------------------

--
-- Table structure for table `Real_estate`
--

CREATE TABLE `Real_estate` (
  `RE_ID` int(10) NOT NULL,
  `RE_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RE_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RE_contact_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RE_manager` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Real_estate`
--

INSERT INTO `Real_estate` (`RE_ID`, `RE_name`, `RE_address`, `RE_contact_number`, `RE_manager`) VALUES
(1, 'Warehouse', 'TSMC R&D Center, Fab 12B\r\n168, Park Ave. II, Hsinchu Science Park, Hsinchu 300-75, Taiwan, R.O.C.', '886-3-5636688', 'Morris Chang'),
(2, 'Branch Store 1', 'International Finance Centre \r\n8 Finance Street\r\nCentral', '+852 39721500', 'Tim Cook'),
(3, 'Branch Store 2', 'Hysan Place\r\n500 Hennessy Road\r\nCauseway Bay', '+852 39793100', 'Winnie the Pooh');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Manufacturer`
--
ALTER TABLE `Manufacturer`
  ADD PRIMARY KEY (`M_ID`);

--
-- Indexes for table `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`P_code`),
  ADD KEY `Product_ibfk_1` (`M_ID`);

--
-- Indexes for table `Product_list`
--
ALTER TABLE `Product_list`
  ADD PRIMARY KEY (`P_ID`);

--
-- Indexes for table `Real_estate`
--
ALTER TABLE `Real_estate`
  ADD PRIMARY KEY (`RE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `P_code` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Product_list`
--
ALTER TABLE `Product_list`
  MODIFY `P_ID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Product number', AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`M_ID`) REFERENCES `Manufacturer` (`M_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
