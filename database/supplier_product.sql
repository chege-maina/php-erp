-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2021 at 01:04 PM
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
-- Table structure for table `supplier_product`
--

CREATE TABLE `supplier_product` (
  `product_name` varchar(50) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `product_cost` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier_product`
--

INSERT INTO `supplier_product` (`product_name`, `supplier_name`, `product_cost`) VALUES
('CHANK', 'KANYE', '8890'),
('CHANK', 'KIM JONG', '3564'),
('CHANK', 'KIM JONTE', '877'),
('TANK', 'KANYE', '778'),
('TANK', 'KIM JONG', '2679'),
('TANK', 'KIM JONTE', '77'),
('TARAJI', 'KANYE', '200'),
('TARAJI', 'KIM JONG', '1660'),
('TARAJI', 'KIM JONTE', '277');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `supplier_product`
--
ALTER TABLE `supplier_product`
  ADD PRIMARY KEY (`product_name`,`supplier_name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
