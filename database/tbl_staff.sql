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
  `report_to` varchar(50) NOT NULL,
  `head_of` varchar(50) NOT NULL,
  `region` varchar(50) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `shift` varchar(50) NOT NULL,
  `employ_type` varchar(50) NOT NULL,
  `off_days` varchar(50) NOT NULL,
  `pay_type` varchar(50) NOT NULL,
  `salary` varchar(50) NOT NULL,
  `income_tax` varchar(50) NOT NULL,
  `deduct_nhif` varchar(50) NOT NULL,
  `deduct_nssf` varchar(50) NOT NULL,
  `account_name` varchar(50) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `bank_name` varchar(50) NOT NULL,
  `sort_code` varchar(50) NOT NULL,
  `s_mobile_no` varchar(50) NOT NULL,
  `s_bank_branch` varchar(50) NOT NULL,
  `s_payment` int(11) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `branch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`f_name`, `m_name`, `l_name`, `gender`, `dob`, `passport`, `nat_id`, `pin_no`, `res`, `nssf_no`, `nhif_no`, `off_mail`, `pers_mail`, `country`, `mobile_no`, `phone_no`, `ext_no`, `city`, `county`, `postal_code`, `job_no`, `employ_date`, `begin_date`, `duration`, `end_date`, `job_title`, `department`, `report_to`, `head_of`, `region`, `currency`, `shift`, `employ_type`, `off_days`, `pay_type`, `salary`, `income_tax`, `deduct_nhif`, `deduct_nssf`, `account_name`, `account_no`, `bank_name`, `sort_code`, `s_mobile_no`, `s_bank_branch`, `s_payment`, `status`, `branch`) VALUES
('Eric', 'Tate Hammond', 'Bird', 'Male', '2007-07-17', '/uploads/Screenshot (2).png', '19', '36', 'Resident', '27', '43', 'fylydukog@mailinator.com', 'pogez@mailinator.com', 'Australia', '6', '12', '98', 'Voluptate quos et un', 'Qui cupidatat tempor', '28402', '821', '1982-07-26', '1991-03-21', 'Quo officia aliq', '1978-08-19', 'Harum nesciunt nost', 'all', 'all', 'all', 'Nairobi', 'KES', 'Regular', '1982-07-26', 'SATURDAY', 'basic', '2', 'none', 'true', 'false', '', '', '', '', '', '', 0, 'pending', 'mm1'),
('Josiah', 'Blaine Dickerson', 'Perkins', 'Female', '2015-11-18', '/uploads/Screenshot (2).png', '82', '85', 'Resident', '73', '77', 'liqiraduda@mailinator.com', 'fyfi@mailinator.com', 'British Indian Ocean Territory', '58', '99', '22', 'Consequatur laudanti', 'Velit occaecat volu', '86287', '225', '1990-10-13', '2014-10-13', 'Nulla repellendu', '1983-12-03', 'Animi officia sed a', 'all', 'all', 'all', 'Nairobi', 'JPY', 'Regular', '1990-10-13', 'SUNDAY', 'consolidated', '4', 'none', 'true', 'false', 'Callum Acevedo', 'Quia vel hic sed min', 'Michelle Cash', 'Ut omnis esse expli', '357', 'Aut hic qui sequi ut', 0, 'approved', 'mm2');

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
