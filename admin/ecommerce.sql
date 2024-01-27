-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 27, 2024 at 02:26 PM
-- Server version: 10.5.19-MariaDB-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u707479837_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `phone` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `fullname`, `password`, `role`, `created_at`, `updated_at`, `phone`) VALUES
(1, 'admin@codingfronted.in', 'Admin', 'admin123', 'admin', '2022-10-16 02:02:58', '2024-01-27 11:17:25', '6382775774');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` text NOT NULL,
  `product_images` varchar(255) NOT NULL,
  `distributor_price` varchar(255) NOT NULL,
  `retailer_price` varchar(255) NOT NULL,
  `mrp_price` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_description`, `product_images`, `distributor_price`, `retailer_price`, `mrp_price`, `created_at`, `updated_at`) VALUES
(1, 'Pure Sun CBD Oil 30 ml', 'Elementum eu facilisis sed odio morbi quis commodo odio. Mauris rhoncus aenean vel elit scelerisque mauris pellentesque. Arcu felis bibendum ut tristique et egestas. Id semper risus in hendrerit gravida rutrum. Eu mi bibendum neque egestas congue\r\n\r\nCategory: Oil\r\nSize: 30ml\r\nPlant Type: Sativa Dominant\r\nTHC: 10.3mg/g\r\nCBD: 0.33%\r\nEffects: Calm, Happy, Relaxed\r\nTags: Cannabis, oil\r\nSKU: 1234567', '1706353853_65b4e4bdb39093.95644574.png,1706353853_65b4e4bd8c91d0.89894736.png', '100', '150', '200', '2024-01-27 11:38:53', '2024-01-27 11:13:06'),
(2, 'Pure Sun CBD Oil 30 ml', 'Elementum eu facilisis sed odio morbi quis commodo odio. Mauris rhoncus aenean vel elit scelerisque mauris pellentesque. Arcu felis bibendum ut tristique et egestas. Id semper risus in hendrerit gravida rutrum. Eu mi bibendum neque egestas congue\r\n\r\nCategory: Oil\r\nSize: 30ml\r\nPlant Type: Sativa Dominant\r\nTHC: 10.3mg/g\r\nCBD: 0.33%\r\nEffects: Calm, Happy, Relaxed\r\nTags: Cannabis, oil\r\nSKU: 1234567', '1706353853_65b4e4bdb39093.95644574.png,1706353853_65b4e4bd8c91d0.89894736.png', '100', '150', '200', '2024-01-27 11:38:53', '2024-01-27 11:13:06');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `AuthId` varchar(50) NOT NULL,
  `AuthKey` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `AuthUsername` varchar(255) NOT NULL,
  `ip_addr` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `AuthId`, `AuthKey`, `created_at`, `AuthUsername`, `ip_addr`) VALUES
(1, '1', '7e70603034eaf11135c82929ec5a33fd', '2024-01-27 15:44:40', 'admin@codingfronted.in', '117.199.136.239'),
(2, '1', '78a845065e3a94adb39d3065f066cba9', '2024-01-27 16:38:57', 'admin@codingfronted.in', '117.199.136.239'),
(3, '1', '42e039c74ad88181af4f3ac57861fdbf', '2024-01-27 16:40:08', 'admin@codingfronted.in', '117.199.136.239'),
(4, '1', '3b665f37562183ebba6ac6f2ddab9c5e', '2024-01-27 16:44:02', 'admin@codingfronted.in', '117.199.136.239'),
(5, '1', 'e218eb0517ec7f36ec2c69aa459dd532', '2024-01-27 16:44:47', 'admin@codingfronted.in', '103.28.246.175');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
