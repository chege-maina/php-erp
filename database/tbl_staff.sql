-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2021 at 02:08 PM
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
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `f_name` varchar(50) NOT NULL,
  `m_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `passport` varchar(50) NOT NULL,
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
  `begin_date` date NOT NULL,
  `duration` varchar(16) NOT NULL,
  `end_date` date NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `report_to` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;



ALTER TABLE `tbl_staff`  ADD `head_of` varchar(50) NOT NULL,
 ADD `region` varchar(50) NOT NULL,
 ADD `currency` varchar(50) NOT NULL,
 ADD `shift` varchar(50) NOT NULL,
 ADD `employ_type` varchar(50) NOT NULL,
 ADD `off_days` varchar(50) NOT NULL,
 ADD `pay_type` varchar(50) NOT NULL,
 ADD `salary` varchar(50) NOT NULL,
 ADD `income_tax` varchar(50) NOT NULL,
 ADD `deduct_nhif` varchar(50) NOT NULL,
 ADD `deduct_nssf` varchar(50) NOT NULL,
 ADD `account_name` varchar(50) NOT NULL,
 ADD `account_no` varchar(50) NOT NULL,
 ADD `bank_name` varchar(50) NOT NULL,
 ADD `sort_code` varchar(50) NOT NULL,
 ADD `s_mobile_no` varchar(50) NOT NULL,
 ADD `s_bank_branch` varchar(50) NOT NULL,
 ADD `s_payment` int(11) NOT NULL,
 ADD `status` varchar(15) NOT NULL DEFAULT 'pending',
 ADD `branch` varchar(50) NOT NULL AFTER `report_to`;

--
-- Dumping data for table `tbl_staff`
--

--
-- Indexes for dumped tables
--

--ALTER TABLE `tbl_staff`
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD UNIQUE KEY `nat_id` (`nat_id`,`pin_no`,`nssf_no`,`nhif_no`,`job_no`,`account_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
