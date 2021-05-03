-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 10:11 AM
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
-- Table structure for table `tbl_nhif`
--

CREATE TABLE `tbl_nhif` (
  `id` int(11) NOT NULL,
  `fromnhif` varchar(50) NOT NULL,
  `tonhif` varchar(50) NOT NULL,
  `rate` varchar(50) NOT NULL,
  `descnhif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_nhif`
--

INSERT INTO `tbl_nhif` (`id`, `fromnhif`, `tonhif`, `rate`, `descnhif`) VALUES
(6, '0', '5999', '150', '2012'),
(7, '6000', '7999', '300', '2012'),
(8, '8000', '11999', '400', '2012'),
(9, '12000', '14999', '500', '2012'),
(10, '15000', '19999', '600', '2012'),
(11, '20000', '24999', '750', '2012'),
(12, '25000', '29999', '850', '2012'),
(13, '30000', '34999', '900', '2012'),
(14, '35000', '39999', '950', '2012'),
(15, '40000', '44999', '1000', '2012');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_nhif`
--
ALTER TABLE `tbl_nhif`
  ADD PRIMARY KEY (`id`,`fromnhif`,`tonhif`,`rate`,`descnhif`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_nhif`
--
ALTER TABLE `tbl_nhif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
