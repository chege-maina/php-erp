-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2021 at 02:09 PM
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
-- Table structure for table `tbl_sale`
--

CREATE TABLE `tbl_sale` (
  `quote_no` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `terms` varchar(50) NOT NULL,
  `due_date` date NOT NULL,
  `time` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `user` varchar(50) NOT NULL,
  `sub_total` varchar(100) NOT NULL,
  `tax` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `branch_location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sale`
--

INSERT INTO `tbl_sale` (`quote_no`, `date`, `customer_name`, `terms`, `due_date`, `time`, `status`, `user`, `sub_total`, `tax`, `amount`, `branch_location`) VALUES
(99889, '2021-02-24', 'Kasper Alvarez', '37', '2021-03-04', '11:03:51', 'pending', 'Jael Joel', '11006710', '0', '11006710', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  ADD PRIMARY KEY (`quote_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  MODIFY `quote_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99890;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
