-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 07:01 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: msl_db
--

--
-- Dumping data for table tbl_ledger
--

INSERT INTO tbl_ledger (ledger_name, group_code) VALUES
('Land REF No# LR/KW/00024', '010101'),
('Land REF# 5690', '010101'),
('KAA234', '010104'),
('KAA254', '010105'),
('Cash at Hand Maisha 1', '010201'),
('Cash at Hand Ola', '010201'),
('Credit Card No# 00200', '010201'),
('Mpesa No# 0724', '010201'),
('Sale of FMCG Products', '040101'),
('Sale of Harware Items', '040101'),
('Sale of Petroleum Items', '040101'),
('Casual Wages', '050102'),
('Employee Salaries-Permanent Staff', '050102'),
('Depreciation to Motor Vehicles', '050104'),
('Rent and Leases', '050104'),
('Closing Stock', '050201'),
('Goods Returns Outwards', '050201'),
('Opening Stock', '050201'),
('Purchase Account', '050201'),
('Audit Fees', '050202'),
('Cleaning Expenses', '050202'),
('Commissions allowed to Customers', '050202'),
('Fines and Penalties', '050202'),
('Insurance Expenses', '050202'),
('Legal and Professional Fees', '050202'),
('Licences and Permits', '050202'),
('Motor Vehicle Fuel Consumption', '050202'),
('Motor Vehicle Repairs and Maintenance', '050202'),
('Motor Vehicle Tyres Account', '050202'),
('Office Expenses', '050202'),
('Printing and Stationary', '050202'),
('Bank Charges', '050204'),
('Bank Expenses and Ledger Fess', '050204'),
('Commissions on Bank Guarantee', '050204'),
('Interest on Bank Overdraft', '050204'),
('Interest on Loans', '050204'),
('Excise Duty', '060311');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
