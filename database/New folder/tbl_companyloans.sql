-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2021 at 02:55 PM
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
-- Table structure for table `tbl_companyloans`
--

CREATE TABLE `tbl_companyloans` (
  `date` date NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `emp_no` varchar(50) NOT NULL,
  `loan_type` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `installment` varchar(100) NOT NULL,
  `pc_interest` varchar(100) NOT NULL,
  `issue_date` date NOT NULL,
  `start_date` date NOT NULL,
  `int_type` varchar(20) NOT NULL,
  `fringe_tax` varchar(20) NOT NULL,
  `id` bigint(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `loan_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_companyloans`
--

INSERT INTO `tbl_companyloans` (`date`, `emp_name`, `designation`, `department`, `emp_no`, `loan_type`, `description`, `amount`, `balance`, `installment`, `pc_interest`, `issue_date`, `start_date`, `int_type`, `fringe_tax`, `id`, `status`, `loan_id`) VALUES
('1991-12-10', 'National ID No# 82', 'Animi', 'all', '225', 'loan', 'medical', '69', '69', '58', '32', '1974-03-08', '1999-02-06', 'reducing', 'yes', 14, 'pending', '225 1974-03-08'),
('1987-05-28', 'National ID No# 82', 'Animi', 'all', '225', 'damage', 'types', '35', '35', '6', '25', '1995-01-30', '1990-10-06', 'straight', 'no', 15, 'pending', '225 1995-01-30'),
('1992-06-10', 'National ID No# 82', 'Animi', 'all', '225', 'damage', 'lost', '70', '70', '38', '98', '2019-08-15', '2011-03-24', 'straight', 'yes', 16, 'pending', '225 2019-08-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_companyloans`
--
ALTER TABLE `tbl_companyloans`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_companyloans`
--
ALTER TABLE `tbl_companyloans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
