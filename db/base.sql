-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2021 at 02:53 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rest_payment`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id_payment` int(11) NOT NULL,
  `invoice` varchar(32) NOT NULL,
  `merchant_id` varchar(32) NOT NULL,
  `item_name` varchar(155) NOT NULL,
  `amount` float NOT NULL,
  `payment_type` enum('virtual_account','credit_card') NOT NULL DEFAULT 'virtual_account',
  `customer_name` varchar(55) NOT NULL,
  `status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `created_at` datetime NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id_payment`, `invoice`, `merchant_id`, `item_name`, `amount`, `payment_type`, `customer_name`, `status`, `created_at`, `modified_at`) VALUES
(9, 'INV123-123', '10', 'SKU-A-123', 100000, 'virtual_account', 'Amri Hidayatulloh', 'paid', '2021-05-25 13:19:02', '2021-05-25 11:19:02'),
(10, 'INV123-1234', '10', 'SKU-A-123', 100000, 'virtual_account', 'Amri Hidayatulloh', 'pending', '2021-05-25 13:25:05', '2021-05-25 11:25:05');

-- --------------------------------------------------------

--
-- Table structure for table `payment_logs`
--

CREATE TABLE `payment_logs` (
  `id_log` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `additional_info` text NOT NULL,
  `status` enum('pending','paid','failed') NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_logs`
--

INSERT INTO `payment_logs` (`id_log`, `payment_id`, `additional_info`, `status`, `created_at`) VALUES
(1, 10, '811781528813819', 'pending', '2021-05-25 13:25:05'),
(2, 9, '', 'paid', '2021-05-25 12:51:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indexes for table `payment_logs`
--
ALTER TABLE `payment_logs`
  ADD PRIMARY KEY (`id_log`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `payment_logs`
--
ALTER TABLE `payment_logs`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
