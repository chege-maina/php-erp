-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2021 at 07:09 AM
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
('Hayden Duran', 'Irene Odonnell', '2000'),
('Hayden Duran', 'Lenore Freeman', '1100'),
('Wyoming Wilkinson', 'Irene Odonnell', '900'),
('Wyoming Wilkinson', 'Lenore Freeman', '1300');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `bank_name` varchar(50) NOT NULL,
  `branch_name` varchar(15) NOT NULL,
  `acc_no` varchar(254) NOT NULL,
  `acc_name` varchar(50) NOT NULL,
  `currency` varchar(100) NOT NULL,
  `opening_bal` varchar(254) NOT NULL,
  `clear_days` varchar(50) NOT NULL,
  `od_limit` varchar(100) NOT NULL,
  `id_interest` varchar(100) NOT NULL,
  `over_limit` varchar(100) NOT NULL,
  `late_charges` varchar(100) NOT NULL,
  `opening_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`bank_name`, `branch_name`, `acc_no`, `acc_name`, `currency`, `opening_bal`, `clear_days`, `od_limit`, `id_interest`, `over_limit`, `late_charges`, `opening_date`) VALUES
('EQUITY BANK', 'KARATINA', '255445666', 'JUMANJI2', 'KSHS', '20', '3', '400', '12', '3', '3', '2021-02-07'),
('KCB', 'RUIRU', '625556', 'JUMANJI', 'KSHS', '1000', '2', '1000000', '11', '4', '5', '2021-02-20'),
('Mannix Merrill', 'Richard Miranda', '510', 'Russell Walter', 'KSHS', '1000', '2', '82000', '34', '82000', '2', '2021-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branch`
--

CREATE TABLE `tbl_branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `email` varchar(20) NOT NULL,
  `tel_no` varchar(20) NOT NULL,
  `postal_address` varchar(20) NOT NULL,
  `physical_address` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_branch`
--

INSERT INTO `tbl_branch` (`branch_id`, `branch_name`, `email`, `tel_no`, `postal_address`, `physical_address`) VALUES
(1, 'MM1', 'war2@maisha.com', '+254756473898', '567-00100', 'Ruiru,Nairobi'),
(2, 'MM2', 'war@maisha.com', '+254743120978', '8976-00100', 'Bungoma, Kenya');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_code` int(11) NOT NULL,
  `category_name` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_code`, `category_name`) VALUES
(3, 'CEMENT'),
(4, 'CHUMA');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `physical_address` varchar(100) NOT NULL,
  `postal_address` varchar(100) NOT NULL,
  `tel_no` varchar(100) NOT NULL,
  `tax_id` varchar(20) NOT NULL,
  `payment_terms` varchar(100) NOT NULL,
  `credit_limit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`name`, `email`, `physical_address`, `postal_address`, `tel_no`, `tax_id`, `payment_terms`, `credit_limit`) VALUES
('Kasper Alvarez', 'recizujen@mailinator.com', 'Doloribus sed corpor', 'Sit dolorem quis ad', '+1 (197) 224-6953', 'Aliquam consectetur', '37', '3000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `salesbill_no` int(100) NOT NULL,
  `so_number` varchar(100) NOT NULL,
  `customer_name` varchar(20) NOT NULL,
  `payment_terms` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `due_date` date NOT NULL,
  `total` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `total_bf_tax` varchar(30) NOT NULL,
  `tax` varchar(15) NOT NULL,
  `user` varchar(50) NOT NULL,
  `driver_name` varchar(100) NOT NULL,
  `truck_no` varchar(100) NOT NULL,
  `transport_cost` varchar(100) NOT NULL,
  `branch` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`salesbill_no`, `so_number`, `customer_name`, `payment_terms`, `date`, `due_date`, `total`, `status`, `total_bf_tax`, `tax`, `user`, `driver_name`, `truck_no`, `transport_cost`, `branch`) VALUES
(36, '99891', 'Kasper Alvarez', '37', '2021-03-03', '2021-04-09', '13652.6', 'approved', '3160', '505.6', 'Jael Joel', 'HUMPHREY MWANGI', 'KCY-409J', '9987', 'MM2'),
(37, '99891', 'Kasper Alvarez', '37', '2021-03-03', '2021-04-09', '3671.6', 'pending', '3160', '505.6', 'Jael Joel', 'HUMPHREY MWANGI', 'KCY-409J', '6', 'MM2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice_items`
--

CREATE TABLE `tbl_invoice_items` (
  `id` int(11) NOT NULL,
  `salesbill_no` varchar(100) NOT NULL,
  `so_number` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `unit` varchar(15) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `user` varchar(50) NOT NULL,
  `tax_pc` varchar(100) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `tax` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_invoice_items`
--

INSERT INTO `tbl_invoice_items` (`id`, `salesbill_no`, `so_number`, `product_code`, `product_name`, `unit`, `qty`, `price`, `total`, `status`, `user`, `tax_pc`, `branch`, `tax`) VALUES
(49, '34', '99891', '52', 'Hayden Duran', 'kgs', '100', '10', '1160', 'pending', 'Jael Joel', '', 'MM2', '160'),
(50, '34', '99891', '53', 'Wyoming Wilkinson', 'lts', '1', '2000', '2000.00', 'pending', 'Jael Joel', '', 'MM2', '0.00'),
(51, '35', '99891', '52', 'Hayden Duran', 'kgs', '100', '10', '1160', 'pending', 'Jael Joel', '16', 'MM2', '160'),
(52, '35', '99891', '53', 'Wyoming Wilkinson', 'lts', '1', '2000', '2000.00', 'pending', 'Jael Joel', '0', 'MM2', '0.00'),
(53, '36', '99891', '52', 'Hayden Duran', 'kgs', '100', '10', '1160', 'pending', 'Jael Joel', '16', 'MM2', '160'),
(54, '36', '99891', '53', 'Wyoming Wilkinson', 'lts', '1', '2000', '2000.00', 'pending', 'Jael Joel', '0', 'MM2', '0.00'),
(55, '37', '99891', '52', 'Hayden Duran', 'kgs', '100', '10', '1160', 'pending', 'Jael Joel', '16', 'MM2', '160'),
(56, '37', '99891', '53', 'Wyoming Wilkinson', 'lts', '1', '2000', '2000.00', 'pending', 'Jael Joel', '0', 'MM2', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_paybill`
--

CREATE TABLE `tbl_paybill` (
  `supplier_name` varchar(50) NOT NULL,
  `rem_no` varchar(100) NOT NULL,
  `cheque_no` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `cheque_type` varchar(50) NOT NULL,
  `pay_type` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_paybill`
--

INSERT INTO `tbl_paybill` (`supplier_name`, `rem_no`, `cheque_no`, `bank_name`, `amount`, `cheque_type`, `pay_type`, `status`, `date`) VALUES
('Kasper Alvarez', '2', '987665', 'EQUITY BANK', '13417.210344827587', 'inhouse', 'receipt', 'pending', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_code` bigint(254) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_unit` varchar(254) NOT NULL,
  `product_category` varchar(254) NOT NULL,
  `min_level` varchar(50) NOT NULL,
  `max_level` varchar(50) NOT NULL,
  `reorder` varchar(50) NOT NULL,
  `product_image` varchar(254) NOT NULL,
  `dsp_price` int(254) NOT NULL,
  `amount_before_tax` int(50) NOT NULL,
  `dpp_inc_tax` int(50) NOT NULL,
  `applicable_tax` int(50) NOT NULL,
  `profit_margin` int(50) NOT NULL,
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_code`, `product_name`, `product_unit`, `product_category`, `min_level`, `max_level`, `reorder`, `product_image`, `dsp_price`, `amount_before_tax`, `dpp_inc_tax`, `applicable_tax`, `profit_margin`, `user`) VALUES
(52, 'Hayden Duran', 'kgs', 'chuma', '9', '500', '18', '/uploads/php.png', 1000, 91000, 91000, 16, 63, 'Jael Joel'),
(53, 'Wyoming Wilkinson', 'lts', 'cement', '21', '400', '67', '/uploads/php.png', 2000, 7800, 7800, 0, 37, 'Jael Joel');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchaseorder`
--

CREATE TABLE `tbl_purchaseorder` (
  `po_number` bigint(20) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(20) NOT NULL,
  `user` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `before_tax` varchar(50) NOT NULL,
  `tax_amt` varchar(50) NOT NULL,
  `po_total` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchaseorder`
--

INSERT INTO `tbl_purchaseorder` (`po_number`, `supplier_name`, `branch`, `date`, `time`, `user`, `status`, `before_tax`, `tax_amt`, `po_total`) VALUES
(2, 'Lenore Freeman', 'MM2', '2021-02-15', '13:15', 'Jael Joel', 'done', '18500', '2960', '21460'),
(3, 'Lenore Freeman', 'MM2', '2021-02-24', '10:31', 'Jael Joel', 'approved', '31000', '4960', '35960');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchaseorder_items`
--

CREATE TABLE `tbl_purchaseorder_items` (
  `id` bigint(20) NOT NULL,
  `po_number` varchar(20) NOT NULL,
  `product_code` varchar(20) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `product_unit` varchar(20) NOT NULL,
  `product_quantity` varchar(20) NOT NULL,
  `product_cost` varchar(20) NOT NULL,
  `total` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `branch` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchaseorder_items`
--

INSERT INTO `tbl_purchaseorder_items` (`id`, `po_number`, `product_code`, `product_name`, `product_unit`, `product_quantity`, `product_cost`, `total`, `status`, `branch`) VALUES
(1, '2', '52', 'Hayden Duran', 'kgs', '5', '1100', '5500', 'done', 'MM2'),
(2, '2', '53', 'Wyoming Wilkinson', 'lts', '10', '1300', '13000', 'done', 'MM2'),
(3, '3', '52', 'Hayden Duran', 'kgs', '14', '1100', '15400', 'approved', 'MM2'),
(4, '3', '53', 'Wyoming Wilkinson', 'lts', '12', '1300', '15600', 'approved', 'MM2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_bill`
--

CREATE TABLE `tbl_purchase_bill` (
  `purchasebill_no` int(100) NOT NULL,
  `po_number` varchar(100) NOT NULL,
  `supplier_name` varchar(20) NOT NULL,
  `payment_terms` varchar(20) NOT NULL,
  `delivery_note_no` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `due_date` date NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `total` varchar(30) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `total_bf_tax` varchar(30) NOT NULL,
  `tax` varchar(15) NOT NULL,
  `user` varchar(50) NOT NULL,
  `receipt_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchase_bill`
--

INSERT INTO `tbl_purchase_bill` (`purchasebill_no`, `po_number`, `supplier_name`, `payment_terms`, `delivery_note_no`, `date`, `due_date`, `invoice_no`, `total`, `status`, `total_bf_tax`, `tax`, `user`, `receipt_no`) VALUES
(4, '2', 'Lenore Freeman', '37', '66huu', '2021-02-18', '2021-03-27', 'SDJO78M', '11368', 'approved', '9800', '1568', 'Jael Joel', '1'),
(5, '2', 'Lenore Freeman', '37', 'dn1000', '2021-02-22', '2021-03-31', 'HHGGHGWJ', '7076', 'approved', '6100', '976', 'Jael Joel', '2'),
(6, '2', 'Lenore Freeman', '37', 'del_No', '2021-02-24', '2021-04-02', 'UIYYGHB', '1508', 'pending', '1300', '208', 'Jael Joel', '3'),
(7, '2', 'Lenore Freeman', '37', '6gutr6', '2021-02-24', '2021-04-02', 'HJGYG', '1508', 'pending', '1300', '208', 'Jael Joel', '4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_bill_items`
--

CREATE TABLE `tbl_purchase_bill_items` (
  `id` int(11) NOT NULL,
  `purchasebill_no` varchar(100) NOT NULL,
  `po_number` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `unit` varchar(15) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `product_cost` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `user` varchar(50) NOT NULL,
  `receipt_no` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_purchase_bill_items`
--

INSERT INTO `tbl_purchase_bill_items` (`id`, `purchasebill_no`, `po_number`, `product_code`, `product_name`, `unit`, `qty`, `product_cost`, `total`, `status`, `user`, `receipt_no`, `invoice_no`) VALUES
(7, '4', '2', '52', 'Hayden Duran', 'kgs', '3', '1100', '3300', 'pending', 'Jael Joel', '1', 'SDJO78M'),
(8, '4', '2', '53', 'Wyoming Wilkinson', 'lts', '5', '1300', '6500', 'pending', 'Jael Joel', '1', 'SDJO78M'),
(9, '5', '2', '52', 'Hayden Duran', 'kgs', '2', '1100', '2200', 'pending', 'Jael Joel', '2', 'HHGGHGWJ'),
(10, '5', '2', '53', 'Wyoming Wilkinson', 'lts', '3', '1300', '3900', 'pending', 'Jael Joel', '2', 'HHGGHGWJ'),
(11, '6', '2', '53', 'Wyoming Wilkinson', 'lts', '1', '1300', '1300', 'pending', 'Jael Joel', '3', 'UIYYGHB'),
(12, '7', '2', '53', 'Wyoming Wilkinson', 'lts', '1', '1300', '1300', 'pending', 'Jael Joel', '4', 'HJGYG');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation`
--

CREATE TABLE `tbl_quotation` (
  `quote_no` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `terms` varchar(50) NOT NULL,
  `due_date` date NOT NULL,
  `time` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `user` varchar(50) NOT NULL,
  `sub_total` varchar(100) NOT NULL,
  `tax` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `branch_location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_quotation`
--

INSERT INTO `tbl_quotation` (`quote_no`, `date`, `customer_name`, `terms`, `due_date`, `time`, `status`, `user`, `sub_total`, `tax`, `amount`, `branch_location`) VALUES
(1, '2021-02-24', 'Kasper Alvarez', '37', '2021-03-04', '14:15:52', 'done', 'Jael Joel', '17569604', '2373280', '17569604', 'MM2'),
(2, '2021-02-24', 'Kasper Alvarez', '37', '2021-03-04', '16:58', 'done', 'Jael Joel', '3160', '160', '3160', 'MM2'),
(3, '2021-02-26', 'Kasper Alvarez', '37', '2021-03-06', '15:16', 'pending', 'Jael Joel', '2000', '0', '2000', 'MM2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_items`
--

CREATE TABLE `tbl_quotation_items` (
  `quote_no` bigint(254) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `amount` varchar(254) NOT NULL,
  `tax` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `tax_pc` varchar(10) NOT NULL,
  `branch_location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_quotation_items`
--

INSERT INTO `tbl_quotation_items` (`quote_no`, `product_code`, `product_name`, `unit`, `price`, `qty`, `amount`, `tax`, `status`, `tax_pc`, `branch_location`) VALUES
(1, '52', 'Hayden Duran', 'kgs', '148330', '100', '17206280.00', '2373280.00', 'done', '16', 'MM2'),
(1, '53', 'Wyoming Wilkinson', 'lts', '10686', '34', '363324.00', '0.00', 'done', '0', 'MM2'),
(2, '52', 'Hayden Duran', 'kgs', '10', '100', '1160', '160', 'done', '16', 'MM2'),
(2, '53', 'Wyoming Wilkinson', 'lts', '2000', '1', '2000.00', '0.00', 'done', '0', 'MM2'),
(3, '53', 'Wyoming Wilkinson', 'lts', '2000', '1', '2000.00', '0.00', 'pending', '0', 'MM2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receiptadv`
--

CREATE TABLE `tbl_receiptadv` (
  `rem_no` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(100) NOT NULL,
  `payable` varchar(100) NOT NULL,
  `wht` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_receiptadv`
--

INSERT INTO `tbl_receiptadv` (`rem_no`, `customer_name`, `date`, `amount`, `payable`, `wht`, `status`, `user`) VALUES
(1, 'Kasper Alvarez', '2021-03-03', '13652.6', '13417.210344827587', '235.38965517241382', 'rejected', 'Jael Joel'),
(2, 'Kasper Alvarez', '2021-03-03', '13652.6', '13417.210344827587', '235.38965517241382', 'done', 'Jael Joel');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receiptadv_items`
--

CREATE TABLE `tbl_receiptadv_items` (
  `id` int(11) NOT NULL,
  `rem_no` int(100) NOT NULL,
  `due_date` date NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `amount_due` varchar(100) NOT NULL,
  `wht` varchar(100) NOT NULL,
  `payable` varchar(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_receiptadv_items`
--

INSERT INTO `tbl_receiptadv_items` (`id`, `rem_no`, `due_date`, `invoice_no`, `amount_due`, `wht`, `payable`, `customer_name`, `date`, `status`, `user`) VALUES
(1, 1, '2021-04-09', '36', '13652.6', '235.38965517241', '13417.210344828', 'Kasper Alvarez', '2021-03-03', 'rejected', 'Jael Joel'),
(2, 2, '2021-04-09', '36', '13652.6', '235.38965517241', '13417.210344828', 'Kasper Alvarez', '2021-03-03', 'done', 'Jael Joel');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_remittance`
--

CREATE TABLE `tbl_remittance` (
  `rem_no` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(100) NOT NULL,
  `payable` varchar(100) NOT NULL,
  `wht` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_remittance`
--

INSERT INTO `tbl_remittance` (`rem_no`, `supplier_name`, `date`, `amount`, `payable`, `wht`, `status`, `user`) VALUES
(1, 'Lenore Freeman', '2021-02-22', '11368', '11172', '196.00000000000003', 'approved', 'Jael Joel'),
(3, 'Lenore Freeman', '2021-02-24', '7076', '6954', '122.00000000000001', 'approved', 'Jael Joel');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_remittance_items`
--

CREATE TABLE `tbl_remittance_items` (
  `id` int(11) NOT NULL,
  `rem_no` int(100) NOT NULL,
  `due_date` date NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `amount_due` varchar(100) NOT NULL,
  `wht` varchar(100) NOT NULL,
  `payable` varchar(100) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_remittance_items`
--

INSERT INTO `tbl_remittance_items` (`id`, `rem_no`, `due_date`, `invoice_no`, `amount_due`, `wht`, `payable`, `supplier_name`, `date`, `status`, `user`) VALUES
(1, 1, '2021-03-27', 'SDJO78M', '11368', '196', '11172', 'Lenore Freeman', '2021-02-22', 'approved', 'Jael Joel'),
(5, 3, '2021-03-31', 'HHGGHGWJ', '7076', '122', '6954', 'Lenore Freeman', '2021-02-24', 'approved', 'Jael Joel');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requisition`
--

CREATE TABLE `tbl_requisition` (
  `requisition_No` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_requisition`
--

INSERT INTO `tbl_requisition` (`requisition_No`, `date`, `time`, `user`, `branch`, `status`) VALUES
(4, '2021-02-15', '13:12', 'Jael Joel', 'MM2', 'done'),
(5, '2021-02-15', '14:28', 'Jael Joel', 'MM2', 'done'),
(6, '2021-02-15', '20:30', 'Jael Joel', 'MM2', 'done'),
(7, '2021-02-23', '11:21', 'Jael Joel', 'MM2', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requisition_items`
--

CREATE TABLE `tbl_requisition_items` (
  `id` bigint(100) NOT NULL,
  `requisition_No` varchar(50) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_unit` varchar(10) NOT NULL,
  `product_quantity` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `branch` varchar(50) NOT NULL,
  `balance` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_requisition_items`
--

INSERT INTO `tbl_requisition_items` (`id`, `requisition_No`, `product_code`, `product_name`, `product_unit`, `product_quantity`, `status`, `branch`, `balance`) VALUES
(4, '4', '52', 'Hayden Duran', 'kgs', '5', 'done', 'MM2', '0'),
(5, '4', '53', 'Wyoming Wilkinson', 'lts', '10', 'done', 'MM2', '0'),
(6, '5', '52', 'Hayden Duran', 'kgs', '2', 'done', 'MM2', '10'),
(7, '6', '52', 'Hayden Duran', 'kgs', '12', 'done', 'MM2', '10'),
(8, '6', '53', 'Wyoming Wilkinson', 'lts', '12', 'done', 'MM2', '10'),
(9, '7', '53', 'Wyoming Wilkinson', 'lts', '10', 'pending', 'MM2', '35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale`
--

CREATE TABLE `tbl_sale` (
  `quote_no` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `terms` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `user` varchar(50) NOT NULL,
  `sub_total` varchar(100) NOT NULL,
  `tax` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `branch_location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sale`
--

INSERT INTO `tbl_sale` (`quote_no`, `date`, `customer_name`, `terms`, `status`, `user`, `sub_total`, `tax`, `amount`, `branch_location`) VALUES
(99891, '2021-02-24', 'Kasper Alvarez', '37', 'done', 'Jael Joel', '3000', '160', '3160', 'MM2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale_items`
--

CREATE TABLE `tbl_sale_items` (
  `quote_no` bigint(254) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `unit` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `amount` varchar(254) NOT NULL,
  `tax` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `tax_pc` varchar(10) NOT NULL,
  `branch_location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sale_items`
--

INSERT INTO `tbl_sale_items` (`quote_no`, `product_code`, `product_name`, `unit`, `price`, `qty`, `amount`, `tax`, `status`, `tax_pc`, `branch_location`) VALUES
(99891, '52', 'Hayden Duran', 'kgs', '10', '100', '1160', '160', 'done', '16', 'MM2'),
(99891, '53', 'Wyoming Wilkinson', 'lts', '2000', '1', '2000.00', '0.00', 'done', '0', 'MM2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff`
--

CREATE TABLE `tbl_staff` (
  `employee_no` bigint(20) NOT NULL,
  `employee_name` varchar(50) NOT NULL,
  `designation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`employee_no`, `employee_name`, `designation`) VALUES
(23, 'HUMPHREY MWANGI', 'DRIVER'),
(24, 'CHEGE MAINA', 'DRIVER');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store`
--

CREATE TABLE `tbl_store` (
  `date` date NOT NULL,
  `time` varchar(10) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `receipt_no` bigint(100) NOT NULL,
  `lpo_number` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_store`
--

INSERT INTO `tbl_store` (`date`, `time`, `branch`, `user`, `supplier_name`, `invoice_no`, `receipt_no`, `lpo_number`, `status`) VALUES
('2021-02-15', '16:50', 'MM2', 'Jael Joel', 'Lenore Freeman', '66huu', 1, '2', 'done'),
('2021-02-17', '17:28', 'MM2', 'Jael Joel', 'Lenore Freeman', 'dn1000', 2, '2', 'done'),
('2021-02-24', '10:34', 'MM2', 'Jael Joel', 'Lenore Freeman', 'del_No', 3, '2', 'done'),
('2021-02-24', '10:38', 'MM2', 'Jael Joel', 'Lenore Freeman', '6gutr6', 4, '2', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store_item`
--

CREATE TABLE `tbl_store_item` (
  `qty` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `receipt_no` varchar(50) NOT NULL,
  `id` bigint(20) NOT NULL,
  `lpo_number` varchar(100) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_store_item`
--

INSERT INTO `tbl_store_item` (`qty`, `product_name`, `product_code`, `branch`, `receipt_no`, `id`, `lpo_number`, `product_unit`, `status`) VALUES
('3', 'Hayden Duran', '52', 'MM2', '1', 7, '2', 'kgs', 'done'),
('5', 'Wyoming Wilkinson', '53', 'MM2', '1', 8, '2', 'lts', 'done'),
('2', 'Hayden Duran', '52', 'MM2', '2', 9, '2', 'kgs', 'done'),
('3', 'Wyoming Wilkinson', '53', 'MM2', '2', 10, '2', 'lts', 'done'),
('1', 'Wyoming Wilkinson', '53', 'MM2', '3', 11, '2', 'lts', 'done'),
('1', 'Wyoming Wilkinson', '53', 'MM2', '4', 12, '2', 'lts', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `supplier_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tel_no` varchar(100) NOT NULL,
  `postal_address` varchar(50) NOT NULL,
  `physical_address` varchar(50) NOT NULL,
  `tax_id` varchar(50) NOT NULL,
  `payment_terms` varchar(100) NOT NULL,
  `number_of_days` varchar(50) NOT NULL DEFAULT '30'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `name`, `email`, `tel_no`, `postal_address`, `physical_address`, `tax_id`, `payment_terms`, `number_of_days`) VALUES
(244, 'Lenore Freeman', 'xikite@mailinator.com', '+1 (863) 313-4277', 'Quia nulla aliquip a', 'Nihil velit nihil d', 'Omnis delectus fugi', '37', '30'),
(245, 'Irene Odonnell', 'dizobe@mailinator.com', '+1 (481) 252-9223', 'Tempora est reiciend', 'Eos est eiusmod non', 'Cupiditate ex facili', '45', '30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tax`
--

CREATE TABLE `tbl_tax` (
  `col_tax` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tax`
--

INSERT INTO `tbl_tax` (`col_tax`) VALUES
(0),
(1.67),
(14),
(16);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfer`
--

CREATE TABLE `tbl_transfer` (
  `transfer_no` bigint(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(15) NOT NULL,
  `user` varchar(100) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `branch_from` varchar(10) NOT NULL DEFAULT 'noted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transfer`
--

INSERT INTO `tbl_transfer` (`transfer_no`, `date`, `time`, `user`, `branch`, `status`, `branch_from`) VALUES
(1, '2021-02-15', '14:11', 'Jael Joel', 'MM2', 'stored', 'MM1'),
(2, '2021-02-15', '14:51', 'Jael Joel', 'MM2', 'done', 'MM1'),
(3, '2021-02-15', '15:54', 'Jael Joel', 'MM2', 'approved', 'noted');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfer_items`
--

CREATE TABLE `tbl_transfer_items` (
  `id` bigint(20) NOT NULL,
  `transfer_no` varchar(50) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `product_quantity` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `branch` varchar(50) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `branch_from` varchar(10) NOT NULL DEFAULT 'noted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_transfer_items`
--

INSERT INTO `tbl_transfer_items` (`id`, `transfer_no`, `product_code`, `product_name`, `product_unit`, `product_quantity`, `status`, `branch`, `balance`, `branch_from`) VALUES
(1, '1', '52', 'Hayden Duran', 'kgs', '12', 'stored', 'MM2', '10', 'MM1'),
(2, '1', '53', 'Wyoming Wilkinson', 'lts', '15', 'stored', 'MM2', '20', 'MM1'),
(3, '2', '52', 'Hayden Duran', 'kgs', '1', 'done', 'MM2', '12', 'noted'),
(4, '3', '52', 'Hayden Duran', 'kgs', '11', 'approved', 'MM2', '12', 'noted');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_unit`
--

CREATE TABLE `tbl_unit` (
  `unit_code` int(11) NOT NULL,
  `product_unit` varchar(254) NOT NULL,
  `unit_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_unit`
--

INSERT INTO `tbl_unit` (`unit_code`, `product_unit`, `unit_description`) VALUES
(7, 'KGS', 'KILOGRAMS'),
(8, 'LTS', 'LITRES'),
(9, 'PCS', 'PIECE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `email` varchar(50) NOT NULL,
  `password` varchar(254) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `status` varchar(3) NOT NULL,
  `level` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`email`, `password`, `designation`, `branch`, `first_name`, `last_name`, `status`, `level`) VALUES
('dir@maisha.com', '$2y$10$Jisk2Nl0cHrTa0id8f2kIeQ9My1mruHswrJwj3J1tMenC538wbPCa', 'Director', 'MM1', 'Kesav', 'Kesav', 'ON', 'ON'),
('pro@maisha.com', '$2y$10$6k7MhrmNzez4yVGYfv7puuj3sBd9Ruq.h4F5iSI9o13fx/jojQx.y', 'Procurement officer', 'MM1', 'James', 'Kevin', 'ON', 'OFF'),
('war2@maisha.com', '$2y$10$fZRa.4ynKAjy6utKTzpP0ew09leLuE2ZgyN.kpUt3T2/kAhOJz5Vu', 'Warehouse manager', 'MM1', 'Monica', 'Njeri', 'ON', 'OFF'),
('war@maisha.com', '$2y$10$6cjuL5jaX3lBxr8NpKZ5VunRdrSUoHGU7bEuFHGDZ4Jrzhp/5DS8u', 'Warehouse manager', 'MM2', 'Jael', 'Joel', 'OFF', 'ON');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle`
--

CREATE TABLE `tbl_vehicle` (
  `vehicle_no` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_vehicle`
--

INSERT INTO `tbl_vehicle` (`vehicle_no`, `type`) VALUES
('KCY-409J', 'Truck');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `supplier_product`
--
ALTER TABLE `supplier_product`
  ADD PRIMARY KEY (`product_name`,`supplier_name`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`bank_name`,`acc_no`);

--
-- Indexes for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_code`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`name`,`email`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  ADD PRIMARY KEY (`salesbill_no`);

--
-- Indexes for table `tbl_invoice_items`
--
ALTER TABLE `tbl_invoice_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_paybill`
--
ALTER TABLE `tbl_paybill`
  ADD PRIMARY KEY (`rem_no`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_code`),
  ADD UNIQUE KEY `product_name` (`product_name`);

--
-- Indexes for table `tbl_purchaseorder`
--
ALTER TABLE `tbl_purchaseorder`
  ADD PRIMARY KEY (`po_number`);

--
-- Indexes for table `tbl_purchaseorder_items`
--
ALTER TABLE `tbl_purchaseorder_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_purchase_bill`
--
ALTER TABLE `tbl_purchase_bill`
  ADD PRIMARY KEY (`purchasebill_no`);

--
-- Indexes for table `tbl_purchase_bill_items`
--
ALTER TABLE `tbl_purchase_bill_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  ADD PRIMARY KEY (`quote_no`);

--
-- Indexes for table `tbl_quotation_items`
--
ALTER TABLE `tbl_quotation_items`
  ADD PRIMARY KEY (`quote_no`,`product_code`);

--
-- Indexes for table `tbl_receiptadv`
--
ALTER TABLE `tbl_receiptadv`
  ADD PRIMARY KEY (`rem_no`);

--
-- Indexes for table `tbl_receiptadv_items`
--
ALTER TABLE `tbl_receiptadv_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_remittance`
--
ALTER TABLE `tbl_remittance`
  ADD PRIMARY KEY (`rem_no`);

--
-- Indexes for table `tbl_remittance_items`
--
ALTER TABLE `tbl_remittance_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_requisition`
--
ALTER TABLE `tbl_requisition`
  ADD PRIMARY KEY (`requisition_No`);

--
-- Indexes for table `tbl_requisition_items`
--
ALTER TABLE `tbl_requisition_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  ADD PRIMARY KEY (`quote_no`);

--
-- Indexes for table `tbl_sale_items`
--
ALTER TABLE `tbl_sale_items`
  ADD PRIMARY KEY (`quote_no`,`product_code`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD PRIMARY KEY (`employee_no`);

--
-- Indexes for table `tbl_store`
--
ALTER TABLE `tbl_store`
  ADD PRIMARY KEY (`receipt_no`);

--
-- Indexes for table `tbl_store_item`
--
ALTER TABLE `tbl_store_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  ADD PRIMARY KEY (`col_tax`);

--
-- Indexes for table `tbl_transfer`
--
ALTER TABLE `tbl_transfer`
  ADD PRIMARY KEY (`transfer_no`);

--
-- Indexes for table `tbl_transfer_items`
--
ALTER TABLE `tbl_transfer_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  ADD PRIMARY KEY (`unit_code`),
  ADD UNIQUE KEY `product_unit` (`product_unit`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `tbl_vehicle`
--
ALTER TABLE `tbl_vehicle`
  ADD PRIMARY KEY (`vehicle_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `salesbill_no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_invoice_items`
--
ALTER TABLE `tbl_invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_code` bigint(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbl_purchaseorder`
--
ALTER TABLE `tbl_purchaseorder`
  MODIFY `po_number` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_purchaseorder_items`
--
ALTER TABLE `tbl_purchaseorder_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_purchase_bill`
--
ALTER TABLE `tbl_purchase_bill`
  MODIFY `purchasebill_no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_purchase_bill_items`
--
ALTER TABLE `tbl_purchase_bill_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  MODIFY `quote_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_receiptadv`
--
ALTER TABLE `tbl_receiptadv`
  MODIFY `rem_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_receiptadv_items`
--
ALTER TABLE `tbl_receiptadv_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_remittance`
--
ALTER TABLE `tbl_remittance`
  MODIFY `rem_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_remittance_items`
--
ALTER TABLE `tbl_remittance_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_requisition`
--
ALTER TABLE `tbl_requisition`
  MODIFY `requisition_No` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_requisition_items`
--
ALTER TABLE `tbl_requisition_items`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  MODIFY `quote_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99892;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `employee_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_store`
--
ALTER TABLE `tbl_store`
  MODIFY `receipt_no` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_store_item`
--
ALTER TABLE `tbl_store_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `tbl_transfer`
--
ALTER TABLE `tbl_transfer`
  MODIFY `transfer_no` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_transfer_items`
--
ALTER TABLE `tbl_transfer_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `unit_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
