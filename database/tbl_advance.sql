-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 01:06 PM
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
-- Table structure for table `tbl_advance`
--

CREATE TABLE `tbl_advance` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `nat` varchar(50) NOT NULL,
  `job` varchar(50) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `date_issued` date NOT NULL,
  `year` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_advance`
--

INSERT INTO `tbl_advance` (`fname`, `lname`, `nat`, `job`, `amount`, `date_issued`, `year`, `month`, `status`) VALUES
('Xaviera', 'Simmons', '35', '614', '69420', '2021-04-28', '121212', 'February', 'pending');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
