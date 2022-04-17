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

--
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
  `M_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Manufacturer type',
  `M_ID` int(10) NOT NULL,
  `M_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `M_contact_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `M_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `M_BR` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Business registration number'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Manufacturer`
--

INSERT INTO `Manufacturer` (`M_code`, `M_ID`, `M_name`, `M_contact_number`, `M_address`, `M_BR`) VALUES
('HKM', 1, 'Valentino', '+852 28292717', '88 QUEENSWAY, ADMIRALITY\r\nL2, HARVEY NICHOLS PACIFIC PLACE\r\nADMIRALTY\r\nHONG KONG ISLAND\r\nHONG KONG SAR CHINA', 'VAT 05412951005');

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `P_code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Product type',
  `P_ID` int(10) NOT NULL,
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

INSERT INTO `Product` (`P_code`, `P_ID`, `P_title`, `P_price`, `P_color`, `P_size`, `M_ID`, `M_name`) VALUES
('MTP', 1, 'Men‘s T-Shirt', '6400.00', 'BLACK', 'M', 1, 'Valentino'),
('MTP', 2, 'Men‘s T-Shirt', '6400.00', 'BLACK', 'XXL', 1, 'Valentino'),
('WBP', 3, 'Women‘s Beg', '19900.00', 'INK BLUE', 'One Size available', 1, 'Valentino'),
('WBP', 4, 'Women‘s Beg', '19900.00', 'BEIGE', 'One Size available', 1, 'Valentino'),
('WBP', 5, 'Women‘s Beg', '19900.00', 'WHITE', 'One Size available', 1, 'Valentino');

-- --------------------------------------------------------

--
-- Table structure for table `Product_list`
--

CREATE TABLE `Product_list` (
  `ID` int(10) NOT NULL COMMENT 'Product number',
  `P_code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_ID` int(10) NOT NULL,
  `P_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `RE_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RE_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Product_list`
--

INSERT INTO `Product_list` (`ID`, `P_code`, `P_ID`, `P_title`, `P_state`, `RE_name`, `RE_ID`) VALUES
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
-- Table structure for table `Real_estate`
--

CREATE TABLE `Real_estate` (
  `RE_code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Region and Category',
  `RE_ID` int(10) NOT NULL,
  `RE_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RE_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RE_contact_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RE_manager` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Real_estate`
--

INSERT INTO `Real_estate` (`RE_code`, `RE_ID`, `RE_name`, `RE_address`, `RE_contact_number`, `RE_manager`) VALUES
('TWWH', 1, 'Warehouse', 'TSMC R&D Center, Fab 12B\r\n168, Park Ave. II, Hsinchu Science Park, Hsinchu 300-75, Taiwan, R.O.C.', '886-3-5636688', 'Morris Chang'),
('HKB', 2, 'Branch Store 1', 'International Finance Centre \r\n8 Finance Street\r\nCentral', '+852 39721500', 'Tim Cook'),
('HKB', 3, 'Branch Store 2', 'Hysan Place\r\n500 Hennessy Road\r\nCauseway Bay', '+852 39793100', 'Winnie the Pooh');

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
  ADD PRIMARY KEY (`P_ID`),
  ADD KEY `M_ID` (`M_ID`);

--
-- Indexes for table `Product_list`
--
ALTER TABLE `Product_list`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `P_ID` (`P_ID`),
  ADD KEY `RE_ID` (`RE_ID`);

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
  MODIFY `P_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Product_list`
--
ALTER TABLE `Product_list`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Product number', AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`M_ID`) REFERENCES `Manufacturer` (`M_ID`);

--
-- Constraints for table `Product_list`
--
ALTER TABLE `Product_list`
  ADD CONSTRAINT `Product_list_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `Product` (`P_ID`),
  ADD CONSTRAINT `Product_list_ibfk_2` FOREIGN KEY (`RE_ID`) REFERENCES `Real_estate` (`RE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
