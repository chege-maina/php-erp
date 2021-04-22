-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 08:24 AM
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
-- Table structure for table `tbl_voucher_items`
--

CREATE TABLE `tbl_voucher_items` (
  `voucher_no` varchar(100) NOT NULL,
  `ledger` varchar(50) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `id` int(100) NOT NULL,
  `date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_voucher_items`
--

INSERT INTO `tbl_voucher_items` (`voucher_no`, `ledger`, `amount`, `type`, `id`, `date`) VALUES
('CN-007', 'Meeee', '1', 'Debit', 67, '2017-12-28'),
('CN-008', 'Meeee', '1', 'Debit', 69, '2017-12-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_voucher_items`
--
ALTER TABLE `tbl_voucher_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voucher_no` (`voucher_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_voucher_items`
--
ALTER TABLE `tbl_voucher_items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
