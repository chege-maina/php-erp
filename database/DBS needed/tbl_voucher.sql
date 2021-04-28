-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 11:54 AM
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
-- Table structure for table `tbl_voucher`
--

CREATE TABLE `tbl_voucher` (
  `voucher_type` varchar(20) NOT NULL,
  `voucher_no` varchar(100) NOT NULL,
  `debit` varchar(30) NOT NULL,
  `credit` varchar(30) NOT NULL,
  `remarks` text NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL,
  `branch` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_voucher`
--

INSERT INTO `tbl_voucher` (`voucher_type`, `voucher_no`, `debit`, `credit`, `remarks`, `date`, `id`, `branch`) VALUES
('Credit', 'CN-008', '1', '1', 'Id mollit ex lorem n', '2017-12-28', 35, ''),
('Credit', 'CN-003', '1', '1', 'Id mollit ex lorem n', '2017-12-28', 36, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_voucher`
--
ALTER TABLE `tbl_voucher`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_voucher`
--
ALTER TABLE `tbl_voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
