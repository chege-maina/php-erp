-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2021 at 07:57 AM
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
-- Table structure for table `tbl_emp_leave`
--

CREATE TABLE `tbl_emp_leave` (
  `id` bigint(20) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `nat` varchar(100) NOT NULL,
  `job` varchar(100) NOT NULL,
  `empleave` varchar(100) NOT NULL,
  `num_days` varchar(50) NOT NULL,
  `opening_balance` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_emp_leave`
--

INSERT INTO `tbl_emp_leave` (`id`, `fname`, `lname`, `nat`, `job`, `empleave`, `num_days`, `opening_balance`, `status`) VALUES
(1, 'Josiah', 'Perkins', '82', '225', 'Annual', '0', '0', 'approved'),
(2, 'Eric', 'Bird', '19', '821', 'Maternity', '12', '34', 'approved'),
(3, 'Josiah', 'Perkins', '82', '225', 'Maternity', '34', '11', 'approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_emp_leave`
--
ALTER TABLE `tbl_emp_leave`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_emp_leave`
--
ALTER TABLE `tbl_emp_leave`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
