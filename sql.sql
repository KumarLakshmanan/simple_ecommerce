-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 26, 2024 at 07:05 PM
-- Server version: 10.11.7-MariaDB-cll-lve
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
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(6) NOT NULL,
  `room_id` int(6) NOT NULL,
  `patient_name` varchar(255) NOT NULL,
  `patient_address` varchar(255) NOT NULL,
  `patient_phone` varchar(255) NOT NULL,
  `patient_email` varchar(255) NOT NULL,
  `payee_type` enum('PERSONAL','COMPANY') NOT NULL,
  `payee_name` varchar(255) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `expiry_year` int(4) NOT NULL,
  `expiry_month` int(2) NOT NULL,
  `cvc` int(3) NOT NULL,
  `card_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `room_name` varchar(255) NOT NULL,
  `room_cost` int(6) NOT NULL,
  `check_in` timestamp NULL DEFAULT current_timestamp(),
  `check_out` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `room_id`, `patient_name`, `patient_address`, `patient_phone`, `patient_email`, `payee_type`, `payee_name`, `card_number`, `expiry_year`, `expiry_month`, `cvc`, `card_name`, `created_at`, `updated_at`, `room_name`, `room_cost`, `check_in`, `check_out`) VALUES
(1, 41, 'Lakshmanan R', 'test', '6382758585', 'test@email.com', 'PERSONAL', 'Lakshmanan R', '4481980048849676', 2, 2028, 111, 'LAKSHMANAN R', '2024-04-26 18:54:19', '2024-04-26 18:54:19', 'Private Bedroom', 50, '2024-04-26 18:55:36', '2024-04-26 18:55:44'),
(2, 31, 'Lakshmanan R', '98, Middle street, Chennai', '6382775774', 'test@gmail.com', 'PERSONAL', 'LAKSHMANAN R', '4481980048849676', 2, 2028, 0, 'LAKSHMANAN R', '2024-04-26 19:03:29', '2024-04-26 19:03:29', 'Private Bedroom', 50, '2024-04-26 19:03:29', '2024-04-26 19:03:29');


CREATE TABLE `rooms` (
  `id` int(6) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost` int(6) NOT NULL,
  `available` tinyint(1) NOT NULL,
  `current_occupant` int(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `cost`, `available`, `current_occupant`, `created_at`, `updated_at`) VALUES
(1, 'Open Ward Bedroom', 40, 0, 3, '2024-04-26 18:06:28', '2024-04-26 18:59:05'),
(2, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(3, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(4, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(5, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(6, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(7, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(8, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(9, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(10, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(11, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(12, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(13, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(14, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(15, 'Open Ward Bedroom', 40, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(16, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(17, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(18, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(19, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(20, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(21, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(22, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(23, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(24, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(25, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(26, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(27, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(28, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(29, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(30, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(31, 'Private Bedroom', 50, 0, 4, '2024-04-26 18:06:28', '2024-04-26 19:03:29'),
(32, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(33, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(34, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(35, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(36, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(37, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(38, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(39, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(40, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(41, 'Private Bedroom', 50, 1, 0, '2024-04-26 18:06:28', '2024-04-26 18:54:50'),
(42, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(43, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(44, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28'),
(45, 'Private Bedroom', 50, 1, NULL, '2024-04-26 18:06:28', '2024-04-26 18:06:28');

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
(13, '1', '92bbb38037ceb3d72ef39a04cba00992', '2024-04-27 00:32:39', 'admin@codingfronted.in', '117.199.128.112'),
(12, '1', 'faf8f52282cd38513149bc358b2637ff', '2024-04-26 23:19:52', 'admin@codingfronted.in', '117.199.128.112'),
(11, '1', '3166d1de42e8a04ee178cbf49489f492', '2024-04-26 23:15:26', 'admin@codingfronted.in', '117.199.128.112'),
(10, '1', '81b7712c9ccb6e64e27a3936edcee159', '2024-04-26 23:15:16', 'admin@codingfronted.in', '117.199.128.112');

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
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;