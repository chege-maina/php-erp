-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2021 at 02:54 PM
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
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `employee_name` varchar(50) NOT NULL,
  `att_date` date NOT NULL,
  `employee_no` varchar(100) NOT NULL,
  `branch` varchar(15) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `late_entry` varchar(20) NOT NULL,
  `early_exit` varchar(20) NOT NULL,
  `description` varchar(15) NOT NULL DEFAULT 'pending',
  `d_month` varchar(100) NOT NULL,
  `d_year` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`employee_name`, `att_date`, `employee_no`, `branch`, `job_title`, `status`, `late_entry`, `early_exit`, `description`, `d_month`, `d_year`) VALUES
('Josiah Perkins', '2021-05-03', '225', 'mm2', 'Animi', 'pending', 'true', 'true', 'absent', '', ''),
('Josiah Perkins', '2021-05-13', '225', 'mm2', 'Animi', 'pending', 'true', 'true', 'onleave', 'May', '2021'),
('Josiah Perkins', '2021-05-22', '225', 'mm2', 'Animi', 'active', 'true', 'true', 'absent', 'May', '2021');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`att_date`,`employee_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
