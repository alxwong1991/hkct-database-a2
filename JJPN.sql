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
  `M_contact_number` int(11) NOT NULL,
  `M_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `M_BR` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Business registration number'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Manufacturer`
--

INSERT INTO `Manufacturer` (`M_code`, `M_ID`, `M_name`, `M_contact_number`, `M_address`, `M_BR`) VALUES
('HKM', 1, 'Valentino', 28292717, '88 QUEENSWAY, ADMIRALITY\r\nL2, HARVEY NICHOLS PACIFIC PLACE\r\nADMIRALTY\r\nHONG KONG ISLAND\r\nHONG KONG SAR CHINA', 'VAT 05412951005');

-- --------------------------------------------------------

--
-- Table structure for table `Product`
--

CREATE TABLE `Product` (
  `Product_code` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Product type',
  `Product_ID` int(6) NOT NULL,
  `Product_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `P_price` decimal(8,2) NOT NULL COMMENT 'Price per piece',
  `P_cost` decimal(8,2) NOT NULL COMMENT 'Cost per piece',
  `Color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Size` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Quantity` int(9) NOT NULL,
  `Reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Import_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `M_ID` int(10) NOT NULL COMMENT 'Manufacturer ID'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`Product_code`, `Product_ID`, `Product_title`, `P_price`, `P_cost`, `Color`, `Size`, `Quantity`, `Reference`, `Import_date`, `M_ID`) VALUES
('MTP', 3, 'COTTON CREWNECK T-SHIRT WITH VALENTINO ARCHIVE 1971 PRINT', '6400.00', '200.00', 'BLACK', 'XS', 50, 'https://www.valentino.com/en-hk/t-shirts_cod38063312420191026.html#dept=ROW_Tshirts-Sweatshirts_M', '2022-04-16 22:12:23', 1),
('MTP', 4, 'COTTON CREWNECK T-SHIRT WITH VALENTINO ARCHIVE 1971 PRINT', '6400.00', '200.00', 'BLACK', 'S', 50, 'https://www.valentino.com/en-hk/t-shirts_cod38063312420191026.html#dept=ROW_Tshirts-Sweatshirts_M', '2022-04-16 22:12:23', 1),
('MTP', 5, 'COTTON CREWNECK T-SHIRT WITH VALENTINO ARCHIVE 1971 PRINT', '6400.00', '200.00', 'BLACK', 'M', 50, 'https://www.valentino.com/en-hk/t-shirts_cod38063312420191026.html#dept=ROW_Tshirts-Sweatshirts_M', '2022-04-16 22:12:23', 1),
('MTP', 6, 'COTTON CREWNECK T-SHIRT WITH VALENTINO ARCHIVE 1971 PRINT', '6400.00', '200.00', 'BLACK', 'L', 50, 'https://www.valentino.com/en-hk/t-shirts_cod38063312420191026.html#dept=ROW_Tshirts-Sweatshirts_M', '2022-04-16 22:12:23', 1),
('MTP', 7, 'COTTON CREWNECK T-SHIRT WITH VALENTINO ARCHIVE 1971 PRINT', '6400.00', '200.00', 'BLACK', 'XL', 50, 'https://www.valentino.com/en-hk/t-shirts_cod38063312420191026.html#dept=ROW_Tshirts-Sweatshirts_M', '2022-04-16 22:12:23', 1),
('MTP', 8, 'COTTON CREWNECK T-SHIRT WITH VALENTINO ARCHIVE 1971 PRINT', '6400.00', '200.00', 'BLACK', 'XXL', 50, 'https://www.valentino.com/en-hk/t-shirts_cod38063312420191026.html#dept=ROW_Tshirts-Sweatshirts_M', '2022-04-16 22:12:23', 1);

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
  ADD PRIMARY KEY (`Product_ID`),
  ADD KEY `Manufacturer` (`M_ID`) USING BTREE;

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
  MODIFY `Product_ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
