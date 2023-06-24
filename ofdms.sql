-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2023 at 01:24 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ofdms`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetch_cart` (IN `uid` INT)   BEGIN

SELECT cart.RId, cart.Cart FROM cart WHERE cart.UserID = uid;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `UserID` int(10) UNSIGNED NOT NULL,
  `RId` int(11) NOT NULL,
  `Cart` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`Cart`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `cart`:
--   `RId`
--       `restaurant` -> `RId`
--   `UserID`
--       `user` -> `UserID`
--

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `FId` int(10) NOT NULL,
  `RId` int(11) NOT NULL,
  `FoodName` varchar(50) NOT NULL,
  `Description` text NOT NULL,
  `Price` varchar(10) NOT NULL,
  `FImg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `food`:
--   `RId`
--       `restaurant` -> `RId`
--

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`FId`, `RId`, `FoodName`, `Description`, `Price`, `FImg`) VALUES
(10, 18, 'Butter Kulcha', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam dolorum nihil quasi animi consequuntur, corrupti repellat cupiditate nemo esse laboriosam ullam dolorem. Distinctio accusantium ducimus tempore dolore fugit facere mollitia', '44', '../images/foods/oceanPearl_Butter_Kulcha.jpg'),
(11, 18, 'Payasam', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam dolorum nihil quasi animi consequuntur, corrupti repellat cupiditate nemo esse laboriosam ullam dolorem. Distinctio accusantium ducimus tempore dolore fugit facere mollitia', '40', '../images/foods/oceanpearl_payasam.jpg'),
(12, 19, 'Masala Dosa', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam dolorum nihil quasi animi consequuntur, corrupti repellat cupiditate nemo esse laboriosam ullam dolorem. Distinctio accusantium ducimus tempore dolore fugit facere mollitia', '50', '../images/foods/Tiffin_Centre_MasalaDosa.jpg');

--
-- Triggers `food`
--
DELIMITER $$
CREATE TRIGGER `NewFood` AFTER INSERT ON `food` FOR EACH ROW UPDATE stats SET stats.NoOfFoods=stats.NoOfFoods+1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Ord_No` int(15) UNSIGNED NOT NULL,
  `Ordered_On` datetime NOT NULL DEFAULT current_timestamp(),
  `userID` int(10) UNSIGNED NOT NULL,
  `rid` int(11) NOT NULL,
  `Order_Details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`Order_Details`)),
  `Total` int(10) NOT NULL,
  `Delivery_Agent` int(10) UNSIGNED DEFAULT NULL,
  `Status` varchar(30) NOT NULL DEFAULT 'Confirmation Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `orders`:
--   `rid`
--       `restaurant` -> `RId`
--   `Delivery_Agent`
--       `user` -> `UserID`
--   `userID`
--       `user` -> `UserID`
--

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Ord_No`, `Ordered_On`, `userID`, `rid`, `Order_Details`, `Total`, `Delivery_Agent`, `Status`) VALUES
(9, '2023-01-29 10:21:39', 6, 18, '{\"10\":1}', 44, 10, 'Delivered'),
(10, '2023-01-29 10:21:39', 6, 19, '{\"12\":1}', 50, 11, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `RId` int(11) NOT NULL,
  `RName` varchar(25) NOT NULL,
  `RType` varchar(15) NOT NULL,
  `Contact` varchar(10) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `RImg` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_nopad_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `restaurant`:
--

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`RId`, `RName`, `RType`, `Contact`, `Address`, `RImg`) VALUES
(16, 'Adyar', 'Vegetarian', '9845614567', ' College Road,Kannur, Padil, Mangaluru, Karnataka', '../images/restaurants/Adyar.jpg'),
(17, 'Café Bihares', 'Vegetarian', '9456471235', 'Ring Road ,Harbatkatte, KPT Jct, Mangaluru, Karnataka', '../images/restaurants/Cafebilhares.jpg'),
(18, 'Ocean Pearl', 'Vegetarian', '9841622147', 'Illai Main Rd, opp to Don College, Hilowr,Jayanagar,Bengaluru, Karnataka', '../images/restaurants/OceanPearl.jpg'),
(19, 'Tiffin Centre', 'Vegetarian', '9471264712', 'Bellvali Road,SantheKatte,Vivekananda Circle,Udupi,Karnataka', '../images/restaurants/TiffinCentre.jpg'),
(20, 'Oysters', 'Non-Vegetarian', '9361475621', 'Main Road ,NH-63 Highway Kunjibettu, Udupi, Karnataka ', '../images/restaurants/Oysters.jpg'),
(21, 'Corner Bistro', 'Vegetarian', '9234567124', 'Telecom House Rd, Pandeshwar, Mangaluru, Karnataka', '../images/restaurants/CornerBistro.jpg');

--
-- Triggers `restaurant`
--
DELIMITER $$
CREATE TRIGGER `NewRes` AFTER INSERT ON `restaurant` FOR EACH ROW UPDATE stats SET stats.NoOfRestaurants=stats.NoOfRestaurants+1
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stats`
--

CREATE TABLE `stats` (
  `NoOfUsers` int(11) NOT NULL,
  `TotalOrders` int(11) NOT NULL,
  `NoOfDelAgents` int(11) NOT NULL,
  `TodaysOrders` int(11) NOT NULL,
  `NoOfRestaurants` int(11) NOT NULL,
  `NoOfFoods` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `stats`:
--

--
-- Dumping data for table `stats`
--

INSERT INTO `stats` (`NoOfUsers`, `TotalOrders`, `NoOfDelAgents`, `TodaysOrders`, `NoOfRestaurants`, `NoOfFoods`) VALUES
(4, 0, 2, 0, 6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(10) UNSIGNED NOT NULL,
  `Name` varchar(30) NOT NULL,
  `MailID` varchar(50) NOT NULL,
  `Password` text NOT NULL,
  `Address` text NOT NULL,
  `Phone` int(10) NOT NULL,
  `UserType` varchar(15) NOT NULL DEFAULT 'Customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- RELATIONSHIPS FOR TABLE `user`:
--

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Name`, `MailID`, `Password`, `Address`, `Phone`, `UserType`) VALUES
(5, 'Ghanashyama K P Makkithaya', 'gmakkithaya@gmail.com', '1f0eb0985870635e62fa2f68a223b173', 'TopG', 2147483647, 'Admin'),
(6, 'Dinesh', 'dineshghegde@gmail.com', '8277e0910d750195b448797616e091ad', 'dindindindin', 1010101010, 'Customer'),
(7, 'dsgfas', 'asdfsdf@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 'asdfasdfasd', 1234567890, 'Customer'),
(8, 'Monish.P', 'monish.p.mmk@gmail.com', '5ac7a0514f569f93299f3c54af19af05', 'Bangalore', 2147483647, 'Customer'),
(9, 'hjghjg', 'hjgkhg@gmail.com', '0cc175b9c0f1b6a831c399e269772661', 'hyfkhgf', 1234567890, 'Customer'),
(10, 'John', 'johnwick@gmail.com', '363b122c528f54df4a0446b6bab05515', 'Location undisclosable.', 2147483647, 'Delivery Agent'),
(11, 'Balraj Hallikatte', 'balraj@hallikatte.com', '92eb5ffee6ae2fec3ad71c777531578f', 'Hallikatte, Bengaluru', 2147483647, 'Delivery Agent');

--
-- Triggers `user`
--
DELIMITER $$
CREATE TRIGGER `NewUser` AFTER INSERT ON `user` FOR EACH ROW IF (NEW.UserType='Customer') THEN
UPDATE stats SET stats.NoOfUsers=stats.NoOfUsers+1;
ELSEIF (NEW.UserType='Delivery Agent') THEN
UPDATE stats SET stats.NoOfDelAgents=stats.NoOfDelAgents+1;
END IF
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`UserID`,`RId`),
  ADD KEY `ResRef` (`RId`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`FId`),
  ADD KEY `RId` (`RId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Ord_No`),
  ADD KEY `UserThatOrdered` (`userID`),
  ADD KEY `UserThatDelivers` (`Delivery_Agent`),
  ADD KEY `OrderFromRestaurant` (`rid`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`RId`),
  ADD UNIQUE KEY `RImg` (`RImg`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`,`UserType`),
  ADD UNIQUE KEY `Email` (`MailID`),
  ADD UNIQUE KEY `id` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `FId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Ord_No` int(15) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `RId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `ResRef` FOREIGN KEY (`RId`) REFERENCES `restaurant` (`RId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserReference` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `RId` FOREIGN KEY (`RId`) REFERENCES `restaurant` (`RId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `OrderFromRestaurant` FOREIGN KEY (`rid`) REFERENCES `restaurant` (`RId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserThatDelivers` FOREIGN KEY (`Delivery_Agent`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserThatOrdered` FOREIGN KEY (`userID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;


--
-- Metadata
--
USE `phpmyadmin`;

--
-- Metadata for table cart
--

--
-- Metadata for table food
--

--
-- Metadata for table orders
--

--
-- Metadata for table restaurant
--

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'ofdms', 'restaurant', '{\"sorted_col\":\"`restaurant`.`RImg` DESC\"}', '2023-01-15 19:19:53');

--
-- Metadata for table stats
--

--
-- Metadata for table user
--

--
-- Dumping data for table `pma__table_uiprefs`
--

INSERT INTO `pma__table_uiprefs` (`username`, `db_name`, `table_name`, `prefs`, `last_update`) VALUES
('root', 'ofdms', 'user', '{\"sorted_col\":\"`user`.`UserType` ASC\"}', '2023-01-17 16:43:21');

--
-- Metadata for database ofdms
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
