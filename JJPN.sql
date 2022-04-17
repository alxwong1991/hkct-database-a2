-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2022 at 07:14 PM
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

-- HKM  : HONG KONG Manufacturer
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
  `P_cost` decimal(8,2) NOT NULL COMMENT 'Cost per piece',
  `P_color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_size` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_quantity` int(9) NOT NULL,
  `P_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `P_import_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `M_ID` int(10) NOT NULL COMMENT 'Manufacturer ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Product`
--

-- MTP :  Men's T-Shirt Product
INSERT INTO `Product` (`P_code`, `P_ID`, `P_title`, `P_price`, `P_cost`, `P_color`, `P_size`, `P_quantity`, `P_reference`, `P_import_date`, `M_ID`) VALUES
('MTP', 3, 'Men‘s T-Shirt Product - COTTON CREWNECK T-SHIRT WITH VALENTINO ARCHIVE 1971 PRINT', '6400.00', '200.00', 'BLACK', 'XS', 50, 'https://www.valentino.com/en-hk/t-shirts_cod38063312420191026.html#dept=ROW_Tshirts-Sweatshirts_M', '2022-04-16 22:12:23', 1),
('MTP', 4, 'Men‘s T-Shirt Product - COTTON CREWNECK T-SHIRT WITH VALENTINO ARCHIVE 1971 PRINT', '6400.00', '200.00', 'BLACK', 'S', 50, 'https://www.valentino.com/en-hk/t-shirts_cod38063312420191026.html#dept=ROW_Tshirts-Sweatshirts_M', '2022-04-16 22:12:23', 1),
('MTP', 5, 'Men‘s T-Shirt Product - COTTON CREWNECK T-SHIRT WITH VALENTINO ARCHIVE 1971 PRINT', '6400.00', '200.00', 'BLACK', 'M', 50, 'https://www.valentino.com/en-hk/t-shirts_cod38063312420191026.html#dept=ROW_Tshirts-Sweatshirts_M', '2022-04-16 22:12:23', 1),
('MTP', 6, 'Men‘s T-Shirt Product - COTTON CREWNECK T-SHIRT WITH VALENTINO ARCHIVE 1971 PRINT', '6400.00', '200.00', 'BLACK', 'L', 50, 'https://www.valentino.com/en-hk/t-shirts_cod38063312420191026.html#dept=ROW_Tshirts-Sweatshirts_M', '2022-04-16 22:12:23', 1),
('MTP', 7, 'Men‘s T-Shirt Product - COTTON CREWNECK T-SHIRT WITH VALENTINO ARCHIVE 1971 PRINT', '6400.00', '200.00', 'BLACK', 'XL', 50, 'https://www.valentino.com/en-hk/t-shirts_cod38063312420191026.html#dept=ROW_Tshirts-Sweatshirts_M', '2022-04-16 22:12:23', 1),
('MTP', 8, 'Men‘s T-Shirt Product - COTTON CREWNECK T-SHIRT WITH VALENTINO ARCHIVE 1971 PRINT', '6400.00', '200.00', 'BLACK', 'XXL', 50, 'https://www.valentino.com/en-hk/t-shirts_cod38063312420191026.html#dept=ROW_Tshirts-Sweatshirts_M', '2022-04-16 22:12:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table`Real_estate`
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
-- RELATIONSHIPS FOR TABLE `Real_estate`:
--

--
-- Dumping data for table `Real_estate`
--

INSERT INTO `Real_estate` (`RE_code`, `RE_ID`, `RE_name`, `RE_address`, `RE_contact_number`, `RE_manager`) VALUES
('HKB', 1, 'Branch Store 1', 'International Finance Centre \r\n8 Finance Street\r\nCentral', '+852 39721500', 'Tim Cook'),
('TWWH', 2, 'Warehouse 2', 'TSMC R&D Center, Fab 12B\r\n168, Park Ave. II, Hsinchu Science Park, Hsinchu 300-75, Taiwan, R.O.C.', '886-3-5636688', 'Morris Chang'),
('HKB', 3, 'Branch Store 2', 'Hysan Place\r\n500 Hennessy Road\r\nCauseway Bay', '+852 39793100', 'Winnie the Pooh');

-- --------------------------------------------------------

--
-- Table structure for table `Product_storage_list`
--

CREATE TABLE `Product_storage_list` (
  `PSI_ID` int(6) NOT NULL COMMENT 'Product storage list ID',
  `P_ID` int(10) NOT NULL COMMENT 'Product ID',
  `PSI_quantity` int(9) NOT NULL COMMENT 'Product storage list quantity',
  `P_storage_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'Product storage date',
  `Destination_ID` int(10) NOT NULL COMMENT 'Destination_REID',
  `Sender_ID` int(10) NOT NULL COMMENT 'Sender_REID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONSHIPS FOR TABLE `Product_storage_list`:
--   `Destination_ID`
--       `Real_estate` -> `RE_ID`
--   `Sender_ID`
--       `Real_estate` -> `RE_ID`
--   `P_ID`
--       `Product` -> `P_ID`
--

--
-- Dumping data for table `Product_storage_list`
--

INSERT INTO `Product_storage_list` (`PSI_ID`, `P_ID`, `PSI_quantity`, `P_storage_date`, `Destination_ID`, `Sender_ID`) VALUES
(2, 3, 20, '2022-04-17 04:15:45', 1, 2),
(3, 3, 20, '2022-04-17 04:15:45', 3, 2);

-- --------------------------------------------------------

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
-- Indexes for table `Product_storage_list`
--
ALTER TABLE `Product_storage_list`
  ADD PRIMARY KEY (`PSI_ID`),
  ADD KEY `P_ID` (`P_ID`),
  ADD KEY `Destination_ID` (`Destination_ID`),
  ADD KEY `Sender_ID` (`Sender_ID`);

--
-- Indexes for table `Real_estate`
--
ALTER TABLE `Real_estate`
  ADD PRIMARY KEY (`RE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Manufacturer`
--
ALTER TABLE `Manufacturer`
  MODIFY `M_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Product`
--
ALTER TABLE `Product`
  MODIFY `P_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Product_storage_list`
--
ALTER TABLE `Product_storage_list`
  MODIFY `PSI_ID` int(6) NOT NULL AUTO_INCREMENT COMMENT 'Product storage list ID', AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Product`
--
ALTER TABLE `Product`
  ADD CONSTRAINT `Product_ibfk_1` FOREIGN KEY (`M_ID`) REFERENCES `Manufacturer` (`M_ID`);

--
-- Constraints for table `Product_storage_list`
--
ALTER TABLE `Product_storage_list`
  ADD CONSTRAINT `Product_storage_list_ibfk_1` FOREIGN KEY (`Destination_ID`) REFERENCES `Real_estate` (`RE_ID`),
  ADD CONSTRAINT `Product_storage_list_ibfk_2` FOREIGN KEY (`Sender_ID`) REFERENCES `Real_estate` (`RE_ID`),
  ADD CONSTRAINT `Product_storage_list_ibfk_3` FOREIGN KEY (`P_ID`) REFERENCES `Product` (`P_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
