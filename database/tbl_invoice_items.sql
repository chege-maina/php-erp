-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 09:40 AM
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
-- Table structure for table `tbl_invoice_items`
--

CREATE TABLE `tbl_invoice_items` (
  `id` int(11) NOT NULL,
  `salesbill_no` varchar(100) NOT NULL,
  `so_number` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `unit` varchar(15) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `product_cost` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `user` varchar(50) NOT NULL,
  `receipt_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice_items`
--

INSERT INTO `tbl_invoice_items` (`id`, `salesbill_no`, `so_number`, `product_code`, `product_name`, `unit`, `qty`, `product_cost`, `total`, `status`, `user`, `receipt_no`) VALUES
(7, '4', '2', '52', 'Hayden Duran', 'kgs', '3', '1100', '3300', 'pending', 'Jael Joel', '1'),
(8, '4', '2', '53', 'Wyoming Wilkinson', 'lts', '5', '1300', '6500', 'pending', 'Jael Joel', '1'),
(9, '5', '2', '52', 'Hayden Duran', 'kgs', '2', '1100', '2200', 'pending', 'Jael Joel', '2'),
(10, '5', '2', '53', 'Wyoming Wilkinson', 'lts', '3', '1300', '3900', 'pending', 'Jael Joel', '2'),
(11, '6', '2', '53', 'Wyoming Wilkinson', 'lts', '1', '1300', '1300', 'pending', 'Jael Joel', '3'),
(12, '7', '2', '53', 'Wyoming Wilkinson', 'lts', '1', '1300', '1300', 'pending', 'Jael Joel', '4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_invoice_items`
--
ALTER TABLE `tbl_invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_invoice_items`
--
ALTER TABLE `tbl_invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
