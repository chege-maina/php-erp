-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 09:39 AM
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
-- Table structure for table `tbl_receipt_advice`
--

CREATE TABLE `tbl_receipt_advice` (
  `rem_no` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(100) NOT NULL,
  `payable` varchar(100) NOT NULL,
  `wht` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_receipt_advice`
--

INSERT INTO `tbl_receipt_advice` (`rem_no`, `customer_name`, `date`, `amount`, `payable`, `wht`, `status`, `user`) VALUES
(1, 'Lenore Freeman', '2021-02-22', '11368', '11172', '196.00000000000003', 'done', 'Jael Joel'),
(3, 'Lenore Freeman', '2021-02-24', '7076', '6954', '122.00000000000001', 'pending', 'Jael Joel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_receipt_advice`
--
ALTER TABLE `tbl_receipt_advice`
  ADD PRIMARY KEY (`rem_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_receipt_advice`
--
ALTER TABLE `tbl_receipt_advice`
  MODIFY `rem_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
