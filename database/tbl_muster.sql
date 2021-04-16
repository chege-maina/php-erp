-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 10:26 AM
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
-- Table structure for table `tbl_muster`
--

CREATE TABLE `tbl_muster` (
  `must_year` varchar(50) NOT NULL,
  `must_month` varchar(50) NOT NULL,
  `paye_year` varchar(50) NOT NULL,
  `nhif_year` varchar(50) NOT NULL,
  `emp_no` varchar(50) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `branch` varchar(15) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `salary` varchar(100) NOT NULL,
  `absentee` varchar(50) NOT NULL,
  `earnings` varchar(100) NOT NULL,
  `paye` varchar(100) NOT NULL,
  `nssf` varchar(100) NOT NULL,
  `nhif` varchar(100) NOT NULL,
  `advance` varchar(100) NOT NULL,
  `loan` varchar(100) NOT NULL,
  `deduct` varchar(100) NOT NULL,
  `pay` varchar(100) NOT NULL,
  `nssf_employer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_muster`
--
ALTER TABLE `tbl_muster`
  ADD PRIMARY KEY (`must_year`,`must_month`,`emp_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
