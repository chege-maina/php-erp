-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2021 at 02:58 PM
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
-- Table structure for table `tbl_paye`
--

CREATE TABLE `tbl_paye` (
  `id` int(11) NOT NULL,
  `fromnhif` varchar(50) NOT NULL,
  `tonhif` varchar(50) NOT NULL,
  `rate` varchar(50) NOT NULL,
  `descnhif` varchar(50) NOT NULL,
  `relief` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_paye`
--

INSERT INTO `tbl_paye` (`id`, `fromnhif`, `tonhif`, `rate`, `descnhif`, `relief`, `status`) VALUES
(6, '77', '59', '69', '2014', '2400', 'pending'),
(7, '50', '35', '21', '2014', '2400', 'pending'),
(8, '85', '35', '22', '2014', '2400', 'pending'),
(9, '39', '29', '50', '2014', '2400', 'pending'),
(10, '1', '10164', '10', '2012', '2400', 'pending'),
(11, '10165', '19740', '15', '2012', '2400', 'pending'),
(12, '19741', '29316', '20', '2012', '2400', 'pending'),
(13, '29317', '38892', '25', '2012', '2400', 'pending'),
(14, '38893', '99999999', '30', '2012', '2400', 'pending'),
(15, '61', '61', '25', '2008', '1200', 'pending'),
(16, '68', '93', '0', '2008', '1200', 'pending'),
(17, '46', '13', '35', '2008', '1200', 'pending'),
(18, '44', '13', '15', '2008', '1200', 'pending'),
(19, '23', '83', '51', '2008', '1200', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_paye`
--
ALTER TABLE `tbl_paye`
  ADD PRIMARY KEY (`id`,`fromnhif`,`tonhif`,`rate`,`descnhif`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_paye`
--
ALTER TABLE `tbl_paye`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
