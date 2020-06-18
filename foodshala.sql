-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 15, 2020 at 09:31 PM
-- Server version: 5.7.27-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-15+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodshala`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `foodie_id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `foodie_id`, `status`) VALUES
(41, 52, '0'),
(46, 52, '0'),
(47, 52, '0'),
(48, 50, '0');

-- --------------------------------------------------------

--
-- Table structure for table `cart_and_foods`
--

CREATE TABLE `cart_and_foods` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_and_foods`
--

INSERT INTO `cart_and_foods` (`id`, `cart_id`, `food_id`, `restaurant_id`, `price`, `quantity`) VALUES
(103, 41, 88, 48, 150, 3),
(104, 41, 91, 49, 70, 4),
(105, 41, 93, 49, 150, 2),
(106, 41, 87, 48, 200, 2),
(107, 41, 95, 51, 250, 1),
(130, 46, 87, 48, 200, 4),
(131, 46, 88, 48, 150, 3),
(134, 47, 96, 51, 200, 3),
(138, 47, 95, 51, 250, 4),
(141, 48, 87, 48, 200, 3),
(145, 48, 97, 48, 50, 4),
(148, 48, 91, 49, 70, 3),
(151, 48, 96, 51, 200, 3);

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `food_type` enum('veg','non-veg') NOT NULL,
  `unique_key` varchar(13) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `restaurant_id`, `name`, `price`, `food_type`, `unique_key`, `created_at`) VALUES
(87, 48, 'chicken biryani', 200, 'non-veg', 'QuT7l3gKveXUL', '2020-06-11 22:28:08'),
(88, 48, 'veg birayni', 150, 'veg', '3KOlktP9jYS1d', '2020-06-11 22:28:21'),
(89, 48, 'ice cream', 100, 'veg', 'q8sOcVKQ7wGo5', '2020-06-11 22:29:17'),
(90, 49, 'Moburg Chicken', 80, 'non-veg', 'OohUFquk4Xp50', '2020-06-11 22:35:21'),
(91, 49, 'Moburg Veg', 70, 'veg', 'PvFVEx5cQlGD3', '2020-06-11 22:35:31'),
(92, 49, 'Veg Momo', 106, 'veg', 'QhNIVYqiuFBo2', '2020-06-11 22:35:51'),
(93, 49, 'Chicken Momo', 150, 'non-veg', 'KQTrYnxwP2DNZ', '2020-06-11 22:36:07'),
(94, 49, 'Fish Momo', 150, 'non-veg', '16HcCytusmhbw', '2020-06-11 22:36:15'),
(95, 51, 'butter chicken', 250, 'non-veg', 'PbqE4NQDYFyp2', '2020-06-11 22:38:32'),
(96, 51, 'chocolate doughnuts', 200, 'veg', 'p5T8FkwMq7ZBC', '2020-06-11 22:38:48'),
(97, 48, 'butter naan', 50, 'veg', 'Wv1LRde6wIsBY', '2020-06-15 15:18:55'),
(98, 48, 'butter chicken', 150, 'non-veg', 'zfKE5bPdUweDy', '2020-06-15 15:20:55'),
(99, 48, 'butter paneer', 100, 'veg', 'AZcst0lpHKr56', '2020-06-15 15:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `unique_key` varchar(13) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `buyer_id`, `unique_key`, `created_at`) VALUES
(5, 52, '12zk37g9iHvjn', '2020-06-15 14:32:49'),
(6, 52, 'Gkfg26KLFq9i7', '2020-06-15 14:46:02'),
(7, 52, 'N3RF2AzTiotOh', '2020-06-15 14:56:35'),
(8, 50, 'wXcAFGRtfLBH8', '2020-06-15 15:23:27');

-- --------------------------------------------------------

--
-- Table structure for table `order_and_foods`
--

CREATE TABLE `order_and_foods` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_and_foods`
--

INSERT INTO `order_and_foods` (`id`, `order_id`, `food_id`, `restaurant_id`, `price`, `quantity`) VALUES
(9, 5, 88, 48, 150, 3),
(10, 5, 91, 49, 70, 4),
(11, 5, 93, 49, 150, 2),
(12, 5, 87, 48, 200, 2),
(13, 5, 95, 51, 250, 1),
(14, 6, 87, 48, 200, 4),
(15, 6, 88, 48, 150, 3),
(16, 7, 96, 51, 200, 3),
(17, 7, 95, 51, 250, 4),
(18, 8, 87, 48, 200, 3),
(19, 8, 97, 48, 50, 4),
(20, 8, 91, 49, 70, 3),
(21, 8, 96, 51, 200, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `preferences` enum('veg','non-veg') DEFAULT NULL,
  `type` enum('1','2') NOT NULL,
  `unique_key` varchar(13) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `preferences`, `type`, `unique_key`, `created_at`) VALUES
(48, 'Arsalan', 'arsalan@food.com', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', NULL, '2', 'GQNxR5lN97Nb6', '2020-06-11 22:27:58'),
(49, 'WoW Momo', 'wowmomo@food.com', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', NULL, '2', 'Xcy2VA6KvQd2Q', '2020-06-11 22:34:43'),
(50, 'Sanjeev Kapoor', 'sanjeevkapoor@foodie.com', '7244add51295008b661e22dce5c9f986c4005dec', 'veg', '1', 'uymRRnjb093om', '2020-06-11 22:36:49'),
(51, 'Gordon Ramsey', 'gordonramsey@foodie.com', '7244add51295008b661e22dce5c9f986c4005dec', NULL, '2', 'QzPOIzVtm5kaB', '2020-06-11 22:37:47'),
(52, 'Gordon Ramsey', 'gordonramsey@foodie.com', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a', 'non-veg', '1', 'XqfzfSXMyIQSN', '2020-06-11 22:39:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foodie_id` (`foodie_id`);

--
-- Indexes for table `cart_and_foods`
--
ALTER TABLE `cart_and_foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- Indexes for table `order_and_foods`
--
ALTER TABLE `order_and_foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `food_id` (`food_id`),
  ADD KEY `restaurant_id` (`restaurant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `cart_and_foods`
--
ALTER TABLE `cart_and_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;
--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `order_and_foods`
--
ALTER TABLE `order_and_foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`foodie_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_and_foods`
--
ALTER TABLE `cart_and_foods`
  ADD CONSTRAINT `cart_and_foods_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `cart_and_foods_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`),
  ADD CONSTRAINT `cart_and_foods_ibfk_3` FOREIGN KEY (`restaurant_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foods_ibfk_1` FOREIGN KEY (`restaurant_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_and_foods`
--
ALTER TABLE `order_and_foods`
  ADD CONSTRAINT `order_and_foods_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_and_foods_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`),
  ADD CONSTRAINT `order_and_foods_ibfk_3` FOREIGN KEY (`restaurant_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
