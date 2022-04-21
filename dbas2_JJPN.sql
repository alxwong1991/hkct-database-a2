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


-- Database: `dbas2_JJPN`
--
CREATE DATABASE IF NOT EXISTS `dbas2_JJPN` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `dbas2_JJPN`;

-- --------------------------------------------------------

-- Drop user
DROP USER IF EXISTS 'JJPN_administrator'@'localhost';

-- Create Database User
-- Database 	: 	dbas2_JJPN
-- Username	  : 	JJPN_administrator
-- Password		:	  password
CREATE USER 'JJPN_administrator'@'localhost' IDENTIFIED BY 'password';

GRANT ALL PRIVILEGES ON *.* TO 'JJPN_administrator'@'localhost' REQUIRE 
NONE WITH GRANT OPTION 
    MAX_QUERIES_PER_HOUR 0 
    MAX_CONNECTIONS_PER_HOUR 0 
    MAX_UPDATES_PER_HOUR 0 
    MAX_USER_CONNECTIONS 0;

GRANT ALL PRIVILEGES ON `dbas2_JJPN`.* TO 'JJPN_administrator'@'localhost';

-- --------------------------------------------------------

--
-- Table structure for table `Daily_Check`
--

CREATE TABLE `Daily_Check` (
  `ID` int(11) NOT NULL,
  `P_ID` int(10) NOT NULL,
  `D_check` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `D_check_time` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Daily_Check`
--

INSERT INTO `Daily_Check` (`ID`, `P_ID`, `D_check`, `D_check_time`) VALUES
(1, 1, '1', '2022-04-21 18:59:33'),
(2, 2, '1', '2022-04-21 18:59:34'),
(3, 3, '1', '2022-04-21 18:59:34'),
(4, 4, '1', '2022-04-21 18:59:35'),
(5, 5, '1', '2022-04-21 18:59:35'),
(6, 6, '1', '2022-04-21 18:59:35'),
(7, 7, '1', '2022-04-21 18:59:35'),
(8, 8, '1', '2022-04-21 18:59:35'),
(9, 9, '0', '2022-04-21 18:51:47'),
(10, 10, '0', '2022-04-21 18:51:47'),
(11, 11, '0', '2022-04-21 18:51:47'),
(12, 12, '0', '2022-04-21 18:51:47'),
(13, 13, '0', '2022-04-21 18:51:47'),
(14, 14, '0', '2022-04-21 18:44:58'),
(15, 15, '0', '2022-04-21 18:51:47'),
(16, 16, '0', '2022-04-21 18:44:58'),
(17, 17, '0', '2022-04-21 18:33:39'),
(18, 18, '0', '2022-04-21 18:51:47'),
(19, 19, '0', '2022-04-21 18:44:58');

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE `Location` (
  `L_ID` int(10) NOT NULL,
  `L_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `L_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `L_contact_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `L_manager` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Location`
--

INSERT INTO `Location` (`L_ID`, `L_name`, `L_address`, `L_contact_number`, `L_manager`) VALUES
(1, 'Warehouse', 'TSMC R&D Center, Fab 12B\r\n168, Park Ave. II, Hsinchu Science Park, Hsinchu 300-75, Taiwan, R.O.C.', '886-3-5636688', 'Morris Chang'),
(2, 'Branch Store 1', 'International Finance Centre \r\n8 Finance Street\r\nCentral', '+852 39721500', 'Tim Cook'),
(3, 'Branch Store 2', 'Hysan Place\r\n500 Hennessy Road\r\nCauseway Bay', '+852 39793100', 'Winnie the Pooh');

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
  `P_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `M_ID` int(10) NOT NULL COMMENT 'Manufacturer ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`P_code`, `P_title`, `M_ID`) VALUES
(1, 'Tommy embroidered logo T-shirt', 1),
(2, 'VSLING plaque mini bag', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Product_list`
--

CREATE TABLE `Product_list` (
  `P_ID` int(10) NOT NULL COMMENT 'Product number',
  `P_type_ID` int(10) NOT NULL,
  `P_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `L_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Product_list`
--

INSERT INTO `Product_list` (`P_ID`, `P_type_ID`, `P_state`, `L_ID`) VALUES
(1, 1, 'inStock', 1),
(2, 1, 'inStock', 2),
(3, 1, 'inStock', 3),
(4, 1, 'inStock', 2),
(5, 1, 'inStock', 3),
(6, 1, 'inStock', 1),
(7, 2, 'inStock', 2),
(8, 2, 'inStock', 3),
(9, 2, 'inStock', 3),
(10, 2, 'inStock', 2),
(11, 2, 'inStock', 1),
(12, 3, 'inStock', 2),
(13, 3, 'inStock', 2),
(14, 4, 'inStock', 1),
(15, 4, 'inStock', 3),
(16, 5, 'inStock', 1),
(17, 5, 'inStock', 3),
(18, 5, 'inStock', 2),
(19, 5, 'inStock', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Product_type`
--

CREATE TABLE `Product_type` (
  `P_type_ID` int(10) NOT NULL,
  `P_code` int(11) DEFAULT NULL,
  `P_type_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_type_size` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_type_price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Product_type`
--

INSERT INTO `Product_type` (`P_type_ID`, `P_code`, `P_type_color`, `P_type_size`, `P_type_price`) VALUES
(1, 1, 'BLACK', 'M', '6400.00'),
(2, 1, 'BLACK', 'XXL', '6400.00'),
(3, 2, 'INK BLUE', 'One Size available', '11900.00'),
(4, 2, 'RED', 'One Size available', '11900.00'),
(5, 2, 'WGITE', 'One Size available', '11900.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Daily_Check`
--
ALTER TABLE `Daily_Check`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `P_ID` (`P_ID`);

--
-- Indexes for table `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`L_ID`);

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
  ADD KEY `M_ID` (`M_ID`);

--
-- Indexes for table `Product_list`
--
ALTER TABLE `Product_list`
  ADD PRIMARY KEY (`P_ID`),
  ADD KEY `L_ID` (`L_ID`),
  ADD KEY `P_type_ID` (`P_type_ID`);

--
-- Indexes for table `Product_type`
--
ALTER TABLE `Product_type`
  ADD PRIMARY KEY (`P_type_ID`),
  ADD KEY `P_ID` (`P_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Daily_Check`
--
ALTER TABLE `Daily_Check`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `Location`
--
ALTER TABLE `Location`
  MODIFY `L_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Manufacturer`
--
ALTER TABLE `Manufacturer`
  MODIFY `M_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `P_code` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Product_list`
--
ALTER TABLE `Product_list`
  MODIFY `P_ID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Product number', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `Product_type`
--
ALTER TABLE `Product_type`
  MODIFY `P_type_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Daily_Check`
--
ALTER TABLE `Daily_Check`
  ADD CONSTRAINT `daily_check_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `Product_list` (`P_ID`);

--
-- Constraints for table `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`M_ID`) REFERENCES `Manufacturer` (`M_ID`);

--
-- Constraints for table `Product_list`
--
ALTER TABLE `Product_list`
  ADD CONSTRAINT `product_list_ibfk_1` FOREIGN KEY (`L_ID`) REFERENCES `Location` (`L_ID`),
  ADD CONSTRAINT `product_list_ibfk_2` FOREIGN KEY (`P_type_ID`) REFERENCES `Product_type` (`P_type_ID`);

--
-- Constraints for table `Product_type`
--
ALTER TABLE `Product_type`
  ADD CONSTRAINT `product_type_ibfk_1` FOREIGN KEY (`P_code`) REFERENCES `Product` (`P_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
