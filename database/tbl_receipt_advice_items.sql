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
-- Table structure for table `tbl_receipt_advice_items`
--

CREATE TABLE `tbl_receipt_advice_items` (
  `id` int(11) NOT NULL,
  `rem_no` int(100) NOT NULL,
  `due_date` date NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `amount_due` varchar(100) NOT NULL,
  `wht` varchar(100) NOT NULL,
  `payable` varchar(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_receipt_advice_items`
--

INSERT INTO `tbl_receipt_advice_items` (`id`, `rem_no`, `due_date`, `invoice_no`, `amount_due`, `wht`, `payable`, `customer_name`, `date`, `status`, `user`) VALUES
(1, 1, '2021-03-27', 'SDJO78M', '11368', '196', '11172', 'Lenore Freeman', '2021-02-22', 'done', 'Jael Joel'),
(5, 3, '2021-03-31', 'HHGGHGWJ', '7076', '122', '6954', 'Lenore Freeman', '2021-02-24', 'pending', 'Jael Joel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_receipt_advice_items`
--
ALTER TABLE `tbl_receipt_advice_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_receipt_advice_items`
--
ALTER TABLE `tbl_receipt_advice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
