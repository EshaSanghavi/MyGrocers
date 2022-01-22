-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2021 at 09:40 PM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Groceries`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `userid` int NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `srno` int NOT NULL,
  `pid` int NOT NULL,
  `cqty` int NOT NULL,
  `subcost` float NOT NULL,
  `uid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payid` int NOT NULL,
  `uid` int NOT NULL,
  `amount` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payid`, `uid`, `amount`, `date`) VALUES
(1, 4, 1035, '2021-04-04 21:21:51'),
(4, 4, 1035, '2021-04-05 11:37:18'),
(5, 4, 417, '2021-04-08 14:17:17'),
(6, 4, 221, '2021-04-08 14:46:14'),
(7, 4, 152, '2021-04-08 16:53:02'),
(8, 4, 189, '2021-04-08 16:57:43'),
(9, 4, 39, '2021-04-08 17:30:31'),
(10, 4, 38, '2021-04-10 16:05:58');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `qty` int NOT NULL,
  `measure` varchar(100) NOT NULL,
  `cost` float NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `name`, `type`, `qty`, `measure`, `cost`, `img`) VALUES
(1, 'Kiwi', 'Fresh Fruits', 3, 'pcs', 56, 'imgs/FKIW2.png'),
(2, 'Blueberry', 'Fresh Fruits', 125, 'gm', 221, 'imgs/FBLU1.png'),
(3, 'Avocado', 'Fresh Fruits', 1, 'pcs', 189, 'imgs/FAVO1.png'),
(4, 'Dragon Fruit', 'Fresh Fruits', 1, 'pcs', 99, 'imgs/FDRA1.png'),
(5, 'Strawberry', 'Fresh Fruits', 200, 'gm', 39, 'imgs/FSTR12.png'),
(6, 'Tomato', 'Fresh Vegetables', 200, 'gm', 39, 'imgs/BTOM11.png'),
(7, 'Carrot', 'Fresh Vegetables', 200, 'gm', 39, 'imgs/FCAR1.png'),
(8, 'Red Bellpepper', 'Fresh Vegetables', 200, 'gm', 39, 'imgs/ECAP12.png'),
(9, 'Beetroot', 'Fresh Vegetables', 200, 'gm', 39, 'imgs/VBEE12.png'),
(10, 'Basil', 'Fresh Vegetables', 200, 'gm', 39, 'imgs/EBAS11.png'),
(17, 'Rajma', 'Pulses', 500, 'gm', 114, 'imgs/PKID.jpeg'),
(18, 'Masoor Dal', 'Pulses', 500, 'gm', 87.55, 'imgs/PMAS.jpeg'),
(19, 'Chickpeas', 'Pulses', 500, 'gm', 110, 'imgs/PCHI.jpeg'),
(20, 'Black Urad Dal', 'Pulses', 500, 'gm', 57, 'imgs/PBUR.jpeg'),
(21, 'Chana Dal', 'Pulses', 500, 'gm', 61, 'imgs/PCHA.jpeg'),
(22, 'Rice', 'Cereals', 1, 'kg', 80, 'imgs/CRIC.jpeg'),
(23, 'Wheat', 'Cereals', 1, 'kg', 60, 'imgs/CWHE.jpeg'),
(24, 'Oats', 'Cereals', 1, 'kg', 199, 'imgs/COAT.jpeg'),
(25, 'Barley', 'Cereals', 1, 'kg', 285, 'imgs/CBAR.jpeg'),
(26, 'Quinoa', 'Cereals', 1, 'kg', 325, 'imgs/CQUI.jpeg'),
(27, 'Maize', 'Cereals', 1, 'kg', 129, 'imgs/CMAI.jpeg'),
(28, 'Black Beans', 'Pulses', 1, 'kg', 370, 'imgs/PBLA.jpg'),
(29, 'Black Eyed Beans', 'Pulses', 1, 'kg', 135, 'imgs/PBEY.jpg'),
(30, 'Green Grapes', 'Fresh Fruits', 500, 'gm', 38, 'imgs/FGRA42.png'),
(31, 'Broccoli', 'Fresh Vegetables', 250, 'gm', 42, 'imgs/EBRO12.png'),
(32, 'Green Apple', 'Fresh Fruits', 4, 'pcs', 179, 'imgs/FAPP23.png'),
(33, 'Mulberry', 'Fresh Fruits', 125, 'gm', 129, 'imgs/FMUL.png'),
(34, 'Black Grapes', 'Fresh Fruits', 500, 'gm', 42, 'imgs/FBGRA.png'),
(35, 'Red Grapes', 'Fresh Fruits', 500, 'gm', 49, 'imgs/FRGRA.png'),
(36, 'Apple', 'Fresh Fruits', 4, 'pcs', 158, 'imgs/FAPPR.png'),
(37, 'Pineapple', 'Fresh Fruits', 1, 'pcs', 54, 'imgs/FPINE.png'),
(38, 'Pear', 'Fresh Fruits', 500, 'gm', 121, 'imgs/FPER16.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int NOT NULL,
  `username` varchar(25) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `walletamt` float NOT NULL DEFAULT '10000',
  `address` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pin` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `phone`, `email`, `password`, `walletamt`, `address`, `pin`) VALUES
(0, 'admin', '1234567890', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 10000, NULL, NULL),
(4, 'Alvin', '9089786611', 'xyz@gmail.com', '8a7a7430eaaf3b93590992e5ca945f1e', 8944, 'xyz, Mumbai', '400000'),
(6, 'Diana', '8917728398', 'xyz@gmail.com', '8a7a7430eaaf3b93590992e5ca945f1e', 10000, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`srno`),
  ADD KEY `pid` (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `products` (`pid`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`userid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`userid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
