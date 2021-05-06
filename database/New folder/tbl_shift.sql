-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2021 at 02:59 PM
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
-- Table structure for table `tbl_shift`
--

CREATE TABLE `tbl_shift` (
  `shift_name` varchar(100) NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `end_time` varchar(50) NOT NULL,
  `work_hours` varchar(50) NOT NULL,
  `non_work` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_shift`
--

INSERT INTO `tbl_shift` (`shift_name`, `start_time`, `end_time`, `work_hours`, `non_work`, `status`) VALUES
('Alfreda Wilson', '05:43', '07:00', '3', '83', 'active'),
('Ocean Torres', '17:37', '10:40', '41', '63', 'rejected');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  ADD PRIMARY KEY (`shift_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
