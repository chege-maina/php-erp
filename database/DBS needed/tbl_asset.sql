-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 11:53 AM
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
-- Table structure for table `tbl_asset`
--

CREATE TABLE `tbl_asset` (
  `name` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `tag_no` varchar(100) NOT NULL,
  `branch` varchar(15) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `descpt` varchar(30) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `dep_rate` varchar(15) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `dep_method` varchar(50) NOT NULL,
  `wear_tear` varchar(50) NOT NULL,
  `asset_status` varchar(50) NOT NULL,
  `financier` varchar(30) NOT NULL,
  `loan_ref` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `asset_name` varchar(100) NOT NULL,
  `asset_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_asset`
--

INSERT INTO `tbl_asset` (`name`, `number`, `tag_no`, `branch`, `unit`, `descpt`, `weight`, `date`, `dep_rate`, `cost`, `dep_method`, `wear_tear`, `asset_status`, `financier`, `loan_ref`, `status`, `asset_name`, `asset_code`) VALUES
('Ivy Wagner', '62', '35', 'MM1', 'Pieces', 'In sequi adipisci do', '60', '1978-09-23', '40', '100', 'Reducing', 'Class 2', 'inactive', 'Quidem sit exercita', '22', 'pending', '', ''),
('Kitra Villarreal', '96', '49', 'MM1', 'Pieces', 'Laboriosam voluptas', '68', '1980-01-04', '57', '11', 'Reducing', 'Class 3', 'disposed', 'Quia sunt in repell', '47', 'pending', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_asset`
--
ALTER TABLE `tbl_asset`
  ADD PRIMARY KEY (`number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
