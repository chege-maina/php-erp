-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 02:42 PM
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
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `salesbill_no` int(100) NOT NULL,
  `so_number` varchar(100) NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `payment_terms` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `due_date` date NOT NULL,
  `total` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `total_bf_tax` varchar(30) NOT NULL,
  `tax` varchar(15) NOT NULL,
  `user` varchar(50) NOT NULL,
  `receipt_no` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`salesbill_no`, `so_number`, `customer_name`, `payment_terms`, `date`, `due_date`, `total`, `status`, `total_bf_tax`, `tax`, `user`, `receipt_no`, `branch`) VALUES
(4, '2', 'Lenore Freeman', '37', '2021-02-18', '2021-03-27', '11368', 'approved', '9800', '1568', 'Jael Joel', '1', ''),
(5, '2', 'Lenore Freeman', '37', '2021-02-22', '2021-03-31', '7076', 'approved', '6100', '976', 'Jael Joel', '2', ''),
(6, '2', 'Lenore Freeman', '37', '2021-02-24', '2021-04-02', '1508', 'pending', '1300', '208', 'Jael Joel', '3', ''),
(7, '2', 'Lenore Freeman', '37', '2021-02-24', '2021-04-02', '1508', 'pending', '1300', '208', 'Jael Joel', '4', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`salesbill_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `salesbill_no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
