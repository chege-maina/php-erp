-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2021 at 01:04 PM
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
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel_no` varchar(100) NOT NULL,
  `postal_address` varchar(50) NOT NULL,
  `physical_address` varchar(50) NOT NULL,
  `tax_id` varchar(50) NOT NULL,
  `payment_terms` varchar(100) NOT NULL,
  `number_of_days` varchar(50) NOT NULL DEFAULT '30'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `name`, `email`, `tel_no`, `postal_address`, `physical_address`, `tax_id`, `payment_terms`, `number_of_days`) VALUES
(241, 'KIM JONG', 'jjj', '98839ukjn', ',jo8o8j0j', 'kjjh8809pjjpok', 'klkjpjj0k', 'jkhohpi', '30'),
(242, 'KIM JONTE', 'jjjhhhh', '98839ukjn', ',jo8o8j0j', 'kjjh8809pjjpok', 'klkjpjj0k', 'jkhohpi', '30'),
(243, 'KANYE', 'jjjhhhhhh', '98839ukjn', ',jo8o8j0j', 'kjjh8809pjjpok', 'klkjpjj0k', 'jkhohpi', '30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=244;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
