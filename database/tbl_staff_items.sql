-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2021 at 01:47 PM
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
-- Table structure for table `tbl_staff_items`
--

CREATE TABLE `tbl_staff_items` (
  `f_name` varchar(50) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `photo` varchar(50) NOT NULL,
  `nat_id` varchar(50) NOT NULL,
  `pin_no` varchar(50) NOT NULL,
  `res` varchar(20) NOT NULL,
  `nssf_no` varchar(50) NOT NULL,
  `nhif_no` varchar(50) NOT NULL,
  `off_mail` varchar(50) NOT NULL,
  `pers_mail` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `mobile_no` varchar(50) NOT NULL,
  `phone_no` varchar(50) NOT NULL,
  `ext_no` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `county` varchar(50) NOT NULL,
  `postal_code` varchar(50) NOT NULL,
  `job_no` varchar(50) NOT NULL,
  `employ_date` date NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `report_to` varchar(50) NOT NULL,
  `head_of` varchar(50) NOT NULL,
  `region` varchar(50) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `shift` varchar(50) NOT NULL,
  `off_days` varchar(50) NOT NULL,
  `pay_type` varchar(50) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `income_tax` varchar(50) NOT NULL,
  `contributions` varchar(50) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `bank_branch` varchar(50) NOT NULL,
  `sort_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_staff_items`
--
ALTER TABLE `tbl_staff_items`
  ADD UNIQUE KEY `nat_id` (`nat_id`,`pin_no`,`nssf_no`,`nhif_no`,`job_no`,`account_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
