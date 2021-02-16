-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2021 at 11:02 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msl_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfer_items`
--

CREATE TABLE `tbl_transfer_items` (
  `id` bigint(20) NOT NULL,
  `transfer_no` varchar(50) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `product_quantity` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `branch` varchar(50) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `branch_from` varchar(10) NOT NULL DEFAULT 'noted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transfer_items`
--

INSERT INTO `tbl_transfer_items` (`id`, `transfer_no`, `product_code`, `product_name`, `product_unit`, `product_quantity`, `status`, `branch`, `balance`, `branch_from`) VALUES
(1, '1', '52', 'Hayden Duran', 'kgs', '12', 'pending', 'MM2', '10', 'noted'),
(2, '1', '53', 'Wyoming Wilkinson', 'lts', '15', 'pending', 'MM2', '20', 'noted'),
(3, '2', '52', 'Hayden Duran', 'kgs', '1', 'pending', 'MM2', '12', 'noted'),
(4, '3', '52', 'Hayden Duran', 'kgs', '11', 'pending', 'MM2', '12', 'noted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_transfer_items`
--
ALTER TABLE `tbl_transfer_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_transfer_items`
--
ALTER TABLE `tbl_transfer_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
