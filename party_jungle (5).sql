-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2023 at 02:34 AM
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
(20, 4, 'Kid Educational Beads Toy', 'assets/products/b0625195-2b44-406f-a4c0-93bc09b26822.fd598e72ca1ab19973bf00acc55e4182.webp', 2, 35, 1, 8, 1),
(21, 2, 'Blue Motos', 'assets/products/prod8.jpg', 2, 1500, 3, 8, 1),
(22, 2, 'Blue Motos', 'assets/products/prod8.jpg', 2, 1500, 1, 8, 1),
(24, 4, 'Kid Educational Beads Toy', 'assets/products/b0625195-2b44-406f-a4c0-93bc09b26822.fd598e72ca1ab19973bf00acc55e4182.webp', 2, 35, 1, 8, 1),
(25, 6, 'Kid Toy', 'assets/products/R (7).jpg', 2, 10, 2, 8, 1),
(26, 4, 'Kid Educational Beads Toy', 'assets/products/b0625195-2b44-406f-a4c0-93bc09b26822.fd598e72ca1ab19973bf00acc55e4182.webp', 2, 35, 2, 8, 1),
(28, 2, 'Blue Motos', 'assets/products/prod8.jpg', 2, 1500, 3, 8, 1),
(29, 2, 'Blue Motos', 'assets/products/prod8.jpg', 2, 1500, 10, 8, 1),
(30, 8, 'Car', 'assets/products/prod4.jpg', 2, 2000, 3, 8, 1),
(31, 2, 'Blue Motos', 'assets/products/prod8.jpg', 2, 1500, 2, 9, 1);

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
(1, 'Balloons', 'assets/products/balloons.png'),
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
  `message` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `is_admin`, `conversation_id`, `message`, `created_at`, `status`, `type`) VALUES
(2, 8, 0, 1, 'Do you have something like this?', '2023-02-24 10:54:08', 2, 1),
(3, 8, 0, 1, 'sfasfsaf', '2023-02-24 10:54:33', 2, 1),
(4, 8, 0, 1, 'asasda', '2023-02-24 10:55:11', 2, 1),
(5, 8, 0, 1, 'Hello', '2023-02-24 10:55:43', 2, 1),
(6, 8, 0, 1, 'Hi', '2023-02-24 10:56:15', 2, 1),
(7, 8, 0, 1, 'Hi', '2023-02-24 11:00:36', 2, 1),
(8, 8, 0, 1, '', '2023-02-25 11:56:28', 2, 2),
(9, 8, 0, 1, 'asdfs', '2023-02-25 11:56:41', 2, 1),
(10, 8, 0, 1, 'fghfghfghf', '2023-02-25 12:00:38', 2, 1),
(11, 8, 0, 1, 'adsasdasd', '2023-02-25 12:58:49', 2, 0),
(12, 8, 0, 1, 'hey', '2023-02-25 12:59:05', 2, 0),
(13, 8, 0, 1, 'hey', '2023-02-25 12:59:09', 2, 0),
(14, 8, 0, 1, 'sdasd', '2023-02-25 13:00:29', 2, 0),
(15, 8, 0, 1, 'assdasd', '2023-02-25 13:00:53', 2, 0),
(16, 8, 0, 1, 'Heyyy\r\n', '2023-02-25 13:01:00', 2, 0),
(17, 8, 0, 1, 'asda', '2023-02-25 13:01:04', 2, 0),
(18, 8, 0, 1, 'asdasd', '2023-02-25 13:01:43', 2, 0),
(19, 8, 0, 1, 'sdas', '2023-02-25 13:01:48', 2, 0),
(20, 8, 0, 1, 'asdasdasdsad', '2023-02-25 13:02:33', 2, 0),
(21, 8, 0, 1, 'asdasd', '2023-02-25 13:02:57', 2, 0),
(22, 8, 0, 1, 'adasd', '2023-02-25 13:04:35', 2, 0),
(23, 8, 0, 1, 'asdads', '2023-02-25 13:04:49', 2, 0),
(24, 8, 0, 1, '', '2023-02-25 13:30:04', 2, 2),
(25, 8, 0, 1, 'dfgdfg', '2023-02-25 13:32:07', 2, 0),
(26, 8, 0, 1, 'sdfsdfsd', '2023-02-25 13:33:23', 2, 0),
(27, 8, 0, 1, '', '2023-02-25 14:20:48', 2, 2),
(28, 8, 0, 1, '', '2023-02-25 14:24:34', 2, 2),
(29, 8, 0, 1, 'kjhgjhg\r\n', '2023-02-25 15:45:53', 2, 0),
(30, 8, 0, 1, '', '2023-02-25 15:47:14', 2, 2),
(31, 8, 0, 1, 'Hello, just wanna ask if my orders will be packed today?', '2023-02-25 17:20:30', 2, 0),
(32, 8, 1, 1, 'asd', '2023-02-25 23:44:15', 2, 0),
(33, 8, 1, 1, 'hjkhjkhjkhj', '2023-02-26 00:06:37', 2, 0),
(35, 8, 1, 1, 'We have this truck set po', '2023-02-26 00:12:09', 2, 1),
(36, 8, 0, 1, 'Okayy', '2023-02-26 00:13:36', 2, 0),
(37, 8, 0, 1, 'heyy', '2023-02-26 00:13:52', 2, 0),
(38, 8, 1, 1, 'Yeah of course!', '2023-02-26 00:14:04', 2, 0),
(39, 8, 0, 1, 'Is this still available po?', '2023-02-26 00:14:36', 2, 1),
(40, 8, 1, 1, 'yes', '2023-02-26 00:15:06', 2, 0),
(41, 8, 0, 1, 'ok', '2023-02-26 00:15:14', 2, 0),
(42, 8, 1, 1, 'yeah', '2023-02-26 00:15:44', 2, 0),
(43, 8, 0, 1, 'ehy\r\n', '2023-02-26 00:20:48', 2, 0),
(44, 8, 1, 1, 'a', '2023-02-26 00:21:39', 2, 0),
(45, 8, 0, 1, 'hey\r\n', '2023-02-26 00:35:22', 2, 0),
(46, 8, 0, 1, 'Good day!', '2023-02-26 11:08:29', 2, 0),
(47, 8, 1, 1, 'Hello, how can we help you?', '2023-02-26 11:09:12', 2, 0),
(48, 8, 0, 1, 'Do you have something like this?', '2023-02-26 11:09:53', 2, 1),
(49, 8, 0, 1, '', '2023-02-26 11:10:54', 2, 2),
(50, 8, 0, 1, '', '2023-02-26 11:11:30', 2, 2),
(51, 8, 1, 1, '', '2023-02-26 17:08:49', 2, 2),
(52, 9, 0, 2, 'Good Day!', '2023-02-27 00:52:24', 2, 0),
(53, 9, 1, 2, 'Hello po', '2023-02-27 01:05:18', 2, 0),
(54, 9, 0, 2, 'Can i order this?', '2023-02-27 01:05:32', 2, 1),
(55, 9, 1, 2, 'Yes po, will update the stocks', '2023-02-27 01:06:37', 2, 0),
(56, 9, 1, 2, 'Okay na po', '2023-02-27 01:07:03', 2, 0),
(57, 9, 0, 2, 'Thank You😊', '2023-02-27 01:07:20', 2, 0),
(58, 9, 1, 2, '🥰 ', '2023-02-27 01:07:38', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat_attachments`
--

CREATE TABLE `chat_attachments` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat_attachments`
--

INSERT INTO `chat_attachments` (`id`, `chat_id`, `photo`) VALUES
(1, 4, 'assets/products/331352255_1382525719159689_1532452007019766500_n__1_-removebg-preview.png'),
(2, 4, 'assets/products/331131005_439078378373682_3481418679130977098_n-removebg.png'),
(3, 4, 'assets/products/331131005_439078378373682_3481418679130977098_n.jpg'),
(4, 4, 'assets/products/331099331_509615721109193_1624576246502108598_n.jpg'),
(5, 5, 'assets/products/331131005_439078378373682_3481418679130977098_n-removebg.png'),
(6, 5, 'assets/products/331131005_439078378373682_3481418679130977098_n.jpg'),
(7, 5, 'assets/products/331099331_509615721109193_1624576246502108598_n.jpg'),
(8, 6, 'assets/products/331131005_439078378373682_3481418679130977098_n-removebg.png'),
(9, 6, 'assets/products/331131005_439078378373682_3481418679130977098_n.jpg'),
(10, 6, 'assets/products/331099331_509615721109193_1624576246502108598_n.jpg'),
(11, 7, 'assets/products/331131005_439078378373682_3481418679130977098_n-removebg.png'),
(12, 7, 'assets/products/331131005_439078378373682_3481418679130977098_n.jpg'),
(13, 7, 'assets/products/331099331_509615721109193_1624576246502108598_n.jpg'),
(14, 8, 'assets/products/331131005_439078378373682_3481418679130977098_n-removebg.png'),
(15, 9, 'assets/products/331131005_439078378373682_3481418679130977098_n.jpg'),
(16, 10, 'assets/products/331131005_439078378373682_3481418679130977098_n.jpg'),
(17, 10, 'assets/products/331099331_509615721109193_1624576246502108598_n.jpg'),
(18, 24, 'assets/products/331352255_1382525719159689_1532452007019766500_n__1_-removebg-preview.png'),
(19, 24, 'assets/products/331131005_439078378373682_3481418679130977098_n-removebg.png'),
(20, 24, 'assets/products/331131005_439078378373682_3481418679130977098_n.jpg'),
(21, 27, 'assets/products/331131005_439078378373682_3481418679130977098_n-removebg.png'),
(22, 27, 'assets/products/331131005_439078378373682_3481418679130977098_n.jpg'),
(23, 27, 'assets/products/331099331_509615721109193_1624576246502108598_n.jpg'),
(24, 27, 'assets/products/331503135_892622055128793_1713449568627288022_n (1).jpg'),
(25, 27, 'assets/products/331503135_892622055128793_1713449568627288022_n.jpg'),
(26, 28, 'assets/products/331352255_1382525719159689_1532452007019766500_n__1_-removebg-preview.png'),
(27, 28, 'assets/products/331131005_439078378373682_3481418679130977098_n-removebg.png'),
(28, 28, 'assets/products/331131005_439078378373682_3481418679130977098_n.jpg'),
(29, 30, 'assets/products/331131005_439078378373682_3481418679130977098_n-removebg.png'),
(31, 35, 'assets/products/prod13.jpg'),
(32, 39, 'assets/products/prod11.jpg'),
(33, 48, 'assets/products/black-red.png'),
(34, 49, 'assets/products/prod1.jpg'),
(35, 50, 'assets/products/prod6.jpg'),
(36, 51, 'assets/products/lootbags.png'),
(37, 54, 'assets/products/prod8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conversations`
--

INSERT INTO `conversations` (`id`, `user_id`) VALUES
(1, 8),
(2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `message_types`
--

CREATE TABLE `message_types` (
  `id` int(11) NOT NULL,
  `type_code` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message_types`
--

INSERT INTO `message_types` (`id`, `type_code`, `description`) VALUES
(1, 0, 'plain message'),
(2, 1, 'attachments_only'),
(3, 2, 'message_with_attachments'),
(4, 3, 'product_only');

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
(12, 'PJFEB230000000012', '2023-02-26 01:05:34', 2, 15000, 'REGION V (BICOL REGION) CATANDUANES VIRAC (Capital) 4800 Gogon Centro PUROK 4 GOGN CENTRO VIRAC CATANDUANES 333', 1, 100, 8, 1),
(13, 'PJFEB230000000013', '2023-02-26 17:57:48', 1, 6000, 'REGION V (BICOL REGION) CATANDUANES VIRAC (Capital) 4800 Gogon Centro PUROK 4 GOGN CENTRO VIRAC CATANDUANES 333', 1, 100, 8, 1),
(14, 'PJFEB230000000014', '2023-02-27 01:13:34', 0, 3000, 'AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM) CATANDUANES BAGAMANOC 4800 A. Beltran (Camalig) PUROK 4 GOGN CENTRO VIRAC CATANDUANES 333', 1, 100, 9, 1);

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
(18, 12, 29, 'Blue Motos', 'assets/products/prod8.jpg', 1500, 10),
(19, 13, 30, 'Car', 'assets/products/prod4.jpg', 2000, 3),
(20, 14, 31, 'Blue Motos', 'assets/products/prod8.jpg', 1500, 2);

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
(6, 4, 'Delivered', 'Order is successfully delivered.');

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
(2, 2, 'Blue Motos', '1500', 'Blue motor \r\nbattery', 15, 1, 'assets/products/prod8.jpg'),
(4, 2, 'Kid Educational Beads Toy', '35', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dictum non consectetur a erat nam at lectus. Feugiat nibh sed pulvinar proin. A lacus vestibulum sed arcu non odio euismod. Pretium', 100, 1, 'assets/products/b0625195-2b44-406f-a4c0-93bc09b26822.fd598e72ca1ab19973bf00acc55e4182.webp'),
(5, 1, 'Birthday Ballons', '125', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Dictum non consectetur a erat nam at lectus. Feugiat nibh sed pulvinar proin. A lacus vestibulum sed arcu non odio euismod. Pretium', 30, 0, 'assets/products/prod2.jpg'),
(6, 2, 'Baby Doll Toy Set', '250', 'kjshdjkahsdkjhasd', 120, 0, 'assets/products/prod12.jpg'),
(8, 2, 'Car', '2000', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut morbi tincidunt augue interdum velit euismod.', 200, 0, 'assets/products/prod4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_chats`
--

CREATE TABLE `product_chats` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_variants_group`
--

CREATE TABLE `product_variants_group` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reservation_status`
--

CREATE TABLE `reservation_status` (
  `id` int(11) NOT NULL,
  `status_code` int(11) NOT NULL,
  `status_label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation_status`
--

INSERT INTO `reservation_status` (`id`, `status_code`, `status_label`) VALUES
(1, 0, 'Pending'),
(2, 1, 'Declined'),
(3, 2, 'Cancelled'),
(4, 3, 'Approved'),
(5, 4, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `photo`) VALUES
(3, 'Party Organizer', 'We decorate birthday party', 'assets/products/bg_1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `service_options`
--

CREATE TABLE `service_options` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_options`
--

INSERT INTO `service_options` (`id`, `label`, `price`, `service_id`) VALUES
(4, '1st Class', 1500, 3),
(5, '2nd Class', 700, 3),
(6, 'fghfghfg', 5555, 4),
(7, 'fgjhfghfg', 546, 5),
(8, 'ghfghfgh', 546456, 6),
(9, 'ghjghj', 56756, 7);

-- --------------------------------------------------------

--
-- Table structure for table `service_reservations`
--

CREATE TABLE `service_reservations` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_option_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_reservations`
--

INSERT INTO `service_reservations` (`id`, `date`, `time`, `service_id`, `service_option_id`, `created_at`, `status`, `user_id`) VALUES
(1, '2023-02-27', '22:13:15', 3, 4, '2023-02-26 22:13:08', 0, 8),
(2, '2023-02-28', '23:45:00', 3, 4, '2023-02-26 23:45:58', 0, 8),
(3, '2023-03-13', '18:00:00', 3, 4, '2023-02-27 08:19:29', 0, 8);

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
(2, 8, 'REGION V (BICOL REGION)', 'CATANDUANES', 'VIRAC (Capital)', 'Gogon Centro', 'PUROK 4 GOGN CENTRO VIRAC CATANDUANES', '333', '4800', 'Zafe, Marlo', '09691624065', '05', '0520', '052011', '052011026'),
(6, 9, 'AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)', 'CATANDUANES', 'BAGAMANOC', 'A. Beltran (Camalig)', 'PUROK 4 GOGN CENTRO VIRAC CATANDUANES', '333', '4800', 'Mar S Arcz', '09637266066', '', '0520', '', '160205003');

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
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `email`, `address`, `contact`, `username`, `password`, `is_verified`, `photo`) VALUES
(8, 'Marlo', 'A.', 'Zafe', 'marlozafe13@gmail.com', 'Gogon Centro, Virac, Catanduanes', '09691624065', 'marlozafe', '$2y$10$sAgXfXG7IwrGj8.TKL7bCOhjVrUSOhbVeT2X.Gd8msSZOnxnjfwQu', 1, 'assets/products/OIP.jpg'),
(9, 'Mar', 'S', 'Arcz', 'mar19arcz@gmail.com', 'Gogon Centro, Virac, Catanduanes', '09691624065', 'mararcz', '$2y$10$g1Epc4KYTIu9V0PPdHVKNeQwy66PtrvOvAvU6kI2byWWMcS8r2CUC', 1, 'assets/products/profile.jpg');

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
(5, 'Added product to cart', '2023-02-22 20:13:52'),
(6, 'Added product to cart', '2023-02-23 20:36:29'),
(7, 'Added product to cart', '2023-02-23 22:27:55'),
(8, 'Added product to cart', '2023-02-24 00:05:55'),
(9, 'Added product to cart', '2023-02-24 15:16:11'),
(10, 'Added product to cart', '2023-02-24 17:52:02'),
(11, 'Added product to cart', '2023-02-24 17:52:18'),
(12, 'Added product to cart', '2023-02-25 17:27:03'),
(13, 'Added product to cart', '2023-02-26 00:57:07'),
(14, 'Added product to cart', '2023-02-26 01:05:19'),
(15, 'Added product to cart', '2023-02-26 17:09:19'),
(16, 'Added product to cart', '2023-02-27 01:08:16');

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
(12, '2EBDFC', 8, '2023-02-14 21:10:27', 0, '2023-02-14 21:20:27'),
(13, 'E056F3', 9, '2023-02-27 00:47:24', 0, '2023-02-27 00:57:24');

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
-- Indexes for table `chat_attachments`
--
ALTER TABLE `chat_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_id` (`chat_id`);

--
-- Indexes for table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `message_types`
--
ALTER TABLE `message_types`
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
-- Indexes for table `product_chats`
--
ALTER TABLE `product_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variants_group`
--
ALTER TABLE `product_variants_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation_status`
--
ALTER TABLE `reservation_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_options`
--
ALTER TABLE `service_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_reservations`
--
ALTER TABLE `service_reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `service_option_id` (`service_option_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `chat_attachments`
--
ALTER TABLE `chat_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message_types`
--
ALTER TABLE `message_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_chats`
--
ALTER TABLE `product_chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_variants_group`
--
ALTER TABLE `product_variants_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation_status`
--
ALTER TABLE `reservation_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `service_options`
--
ALTER TABLE `service_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `service_reservations`
--
ALTER TABLE `service_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_attachments`
--
ALTER TABLE `chat_attachments`
  ADD CONSTRAINT `chat_attachments_ibfk_1` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `conversations`
--
ALTER TABLE `conversations`
  ADD CONSTRAINT `conversations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_reservations`
--
ALTER TABLE `service_reservations`
  ADD CONSTRAINT `service_reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_reservations_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `service_reservations_ibfk_3` FOREIGN KEY (`service_option_id`) REFERENCES `service_options` (`id`) ON DELETE CASCADE;

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
