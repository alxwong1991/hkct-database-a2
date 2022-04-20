
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
--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`PL_ID`) REFERENCES `product_list` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;


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
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`U_ID`) REFERENCES `users` (`U_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`Pay_ID`) REFERENCES `payment` (`Pay_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`PL_ID`) REFERENCES `product_list` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`C_ID`) REFERENCES `cart` (`C_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`C_ID`) REFERENCES `cart` (`C_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
-- Table structure for table `Real_estate`
--