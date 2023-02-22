-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2023 at 04:44 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `party_jungle`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `middlename`, `lastname`, `contact`, `email`, `username`, `password`) VALUES
(6, 'Marlo', 'Arcilla', 'Zafe', '09691624065', 'marlozafe13@gmail.com', 'admin', '$2y$10$CvpAPO2U.Nf3tYAt3ucTHud5l3kcUVDhlF89AEOXd2IzqQD/YyQs.');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_photo` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_checked_out` int(11) NOT NULL COMMENT '0-false, 1-true'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `product_name`, `product_photo`, `category_id`, `price`, `quantity`, `user_id`, `is_checked_out`) VALUES
(13, 6, 'Kid Toy', 'assets/products/R (7).jpg', 2, 10, 4, 8, 1),
(15, 2, 'Blue Motos', 'assets/products/prod8.jpg', 2, 1500, 4, 8, 1),
(16, 4, 'Kid Educational Beads Toy', 'assets/products/b0625195-2b44-406f-a4c0-93bc09b26822.fd598e72ca1ab19973bf00acc55e4182.webp', 2, 35, 2, 8, 1),
(17, 3, 'Globe Ball', 'assets/products/globe.png', 2, 105, 1, 8, 1),
(18, 5, 'Birthday Ballons', 'assets/products/prod2.jpg', 1, 125, 1, 8, 1),
(19, 2, 'Blue Motos', 'assets/products/prod8.jpg', 2, 1500, 1, 8, 1),
(20, 4, 'Kid Educational Beads Toy', 'assets/products/b0625195-2b44-406f-a4c0-93bc09b26822.fd598e72ca1ab19973bf00acc55e4182.webp', 2, 35, 1, 8, 1);

--
-- Triggers `cart`
--
DELIMITER $$
CREATE TRIGGER `user_log` BEFORE INSERT ON `cart` FOR EACH ROW INSERT INTO user_log(`details`) VALUES("Added product to cart")
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_photo`) VALUES
(1, 'Ballons', 'assets/products/balloons.png'),
(2, 'Toys', 'assets/products/toys.png'),
(3, 'Cake', 'assets/products/cake.png'),
(4, 'Loot Bags', 'assets/products/lootbags.png');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_admin` int(11) DEFAULT 0,
  `conversation_id` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `transaction_no` varchar(255) NOT NULL,
  `ordered_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `shipping_id` int(11) NOT NULL,
  `shipping_fee` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `transaction_no`, `ordered_at`, `status`, `total`, `shipping_address`, `shipping_id`, `shipping_fee`, `user_id`, `payment_method`) VALUES
(4, 'Feb-23-00004', '2023-02-21 09:48:33', 4, 3030, 'Gogon Centro, Virac, Catanduanes', 1, 100, 8, 0),
(5, 'PJFEB230000000005', '2023-02-13 09:48:33', 1, 3110, 'Gogon Centro, Virac, Catanduanes', 1, 100, 8, 0),
(6, 'PJFEB230000000006', '2023-02-21 11:20:24', 0, 105, 'Gogon Centro, Virac, Catanduanes', 1, 100, 8, 0),
(7, 'PJFEB230000000007', '2023-02-22 23:41:42', 1, 1660, 'REGION V (BICOL REGION) CATANDUANES VIRAC (Capital) 4800 Gogon Centro PUROK 4 GOGN CENTRO VIRAC CATANDUANES 333', 1, 100, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_photo` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `product_photo`, `price`, `quantity`) VALUES
(3, 4, 13, 'Kid Toy', 'assets/products/R (7).jpg', 10, 3),
(4, 4, 15, 'Blue Motos', 'assets/products/prod8.jpg', 1500, 2),
(5, 5, 13, 'Kid Toy', 'assets/products/R (7).jpg', 10, 4),
(6, 5, 15, 'Blue Motos', 'assets/products/prod8.jpg', 1500, 2),
(7, 5, 16, 'Kid Educational Beads Toy', 'assets/products/b0625195-2b44-406f-a4c0-93bc09b26822.fd598e72ca1ab19973bf00acc55e4182.webp', 35, 2),
(8, 6, 17, 'Globe Ball', 'assets/products/globe.png', 105, 1),
(9, 7, 18, 'Birthday Ballons', 'assets/products/prod2.jpg', 125, 1),
(10, 7, 19, 'Blue Motos', 'assets/products/prod8.jpg', 1500, 1),
(11, 7, 20, 'Kid Educational Beads Toy', 'assets/products/b0625195-2b44-406f-a4c0-93bc09b26822.fd598e72ca1ab19973bf00acc55e4182.webp', 35, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status_code` int(11) NOT NULL,
  `status_label` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status_code`, `status_label`, `description`) VALUES
(1, -1, 'Cancelled', 'Order i s cancelled'),
(2, 0, 'Order Placed', 'Order is pending.'),
(3, 1, 'Packed', 'Order is packed and ready for shipment'),
(4, 2, 'Shipped', 'Order is in shipment.'),
(5, 3, 'Out for Delivery', 'Rider will attempt to deliver your order.'),
(6, 4, 'Delivered', 'Order is successfully delivered.'),
(7, 5, 'tracked', '0');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(11) NOT NULL,
  `method_code` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_disabled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `method_code`, `description`, `is_disabled`) VALUES
(1, 1, 'Cash On Delivery', 0),
(2, 2, 'GCash', 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `stocks` bigint(20) NOT NULL,
  `is_featured` int(11) DEFAULT 0,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `price`, `description`, `stocks`, `is_featured`, `photo`) VALUES
(2, 2, 'Blue Motos', '1500', 'Blue motor \r\nbattery', 10, 1, 'assets/products/prod8.jpg'),
(3, 2, 'Globe Ball', '105', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dictum non consectetur a erat nam at lectus. Feugiat nibh sed pulvinar proin. A lacus vestibulum sed arcu non odio euismod. Pretium', 200, 1, 'assets/products/globe.png'),
(4, 2, 'Kid Educational Beads Toy', '35', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dictum non consectetur a erat nam at lectus. Feugiat nibh sed pulvinar proin. A lacus vestibulum sed arcu non odio euismod. Pretium', 100, 1, 'assets/products/b0625195-2b44-406f-a4c0-93bc09b26822.fd598e72ca1ab19973bf00acc55e4182.webp'),
(5, 1, 'Birthday Ballons', '125', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dictum non consectetur a erat nam at lectus. Feugiat nibh sed pulvinar proin. A lacus vestibulum sed arcu non odio euismod. Pretium', 30, 0, 'assets/products/prod2.jpg'),
(6, 2, 'Kid Toy', '10', 'kjshdjkahsdkjhasd', 120, 0, 'assets/products/R (7).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `description`, `price`) VALUES
(1, 'Standard Delivery', 100),
(2, 'Urgent Delivery', 250);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_address`
--

CREATE TABLE `shipping_address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `region` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `region_code` varchar(255) NOT NULL,
  `province_code` varchar(255) NOT NULL,
  `city_code` varchar(255) NOT NULL,
  `barangay_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_address`
--

INSERT INTO `shipping_address` (`id`, `user_id`, `region`, `province`, `city`, `barangay`, `street_name`, `house_no`, `zip_code`, `fullname`, `phone`, `region_code`, `province_code`, `city_code`, `barangay_code`) VALUES
(2, 8, 'REGION V (BICOL REGION)', 'CATANDUANES', 'VIRAC (Capital)', 'Gogon Centro', 'PUROK 4 GOGN CENTRO VIRAC CATANDUANES', '333', '4800', 'Zafe, Marlo', '09691624065', '05', '0520', '052011', '052011026');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `email`, `address`, `contact`, `username`, `password`, `is_verified`) VALUES
(8, 'Marlo', 'A.', 'Zafe', 'marlozafe13@gmail.com', 'Gogon Centro, Virac, Catanduanes', '09691624065', 'marlozafe', '$2y$10$xiHz2xApMjken43vLKdq9eVnIFlEKAKuaLSfteuTIimrj3TzxmqJ.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `id` int(11) NOT NULL,
  `details` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_log`
--

INSERT INTO `user_log` (`id`, `details`, `created_at`) VALUES
(1, 'Added product to cart', '2023-02-21 08:34:58'),
(2, 'Added product to cart', '2023-02-21 11:16:23'),
(3, 'Added product to cart', '2023-02-21 11:21:58'),
(4, 'Added product to cart', '2023-02-21 11:53:35'),
(5, 'Added product to cart', '2023-02-22 20:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL COMMENT '0 - unused\r\n1-used',
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `verification_codes`
--

INSERT INTO `verification_codes` (`id`, `code`, `user_id`, `createdAt`, `status`, `expiry`) VALUES
(1, '96C92B', 8, '2023-02-13 00:08:43', 0, '2023-02-13 00:18:43'),
(2, 'E8137A', 8, '2023-02-13 00:10:38', 0, '2023-02-13 00:20:38'),
(3, '355CAE', 8, '2023-02-13 00:10:54', 0, '2023-02-13 00:20:54'),
(4, '2811D5', 8, '2023-02-13 00:11:53', 0, '2023-02-13 00:21:53'),
(5, 'B68067', 8, '2023-02-13 00:12:37', 0, '2023-02-13 00:22:37'),
(6, 'BEFBA4', 8, '2023-02-13 00:26:56', 0, '2023-02-13 00:36:56'),
(7, '082F12', 8, '2023-02-13 01:02:23', 0, '2023-02-13 01:12:23'),
(8, 'C5FF93', 8, '2023-02-13 01:16:30', 0, '2023-02-13 01:26:30'),
(9, 'F36642', 8, '2023-02-13 01:29:40', 0, '2023-02-13 01:39:40'),
(10, 'A9EB9C', 8, '2023-02-13 01:40:34', 0, '2023-02-13 01:50:34'),
(11, '169D56', 8, '2023-02-14 20:42:18', 0, '2023-02-14 20:52:18'),
(12, '2EBDFC', 8, '2023-02-14 21:10:27', 0, '2023-02-14 21:20:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversation_id` (`conversation_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_no_2` (`transaction_no`),
  ADD KEY `transaction_no` (`transaction_no`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD CONSTRAINT `shipping_address_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD CONSTRAINT `verification_codes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
