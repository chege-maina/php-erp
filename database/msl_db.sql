-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2021 at 07:38 AM
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
('Xaviera Kramer', 'Maite Calderon', '1000');

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
-- Table structure for table `tbl_branch_levels`
--

CREATE TABLE `tbl_branch_levels` (
  `product_name` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `min_level` varchar(50) NOT NULL,
  `max_level` varchar(50) NOT NULL,
  `reorder` varchar(50) NOT NULL,
  `opening_bal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'CEMENT');

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
('Amir Holder', 'nufuwac@mailinator.com', 'Est eu sit quo quia', 'Aliquam quo sint asp', '+1 (232) 749-8112', 'Perferendis nihil eo', '18', '95'),
('Hilary Curry', 'rahuqexo@mailinator.com', 'Amet et eligendi re', 'Optio saepe modi al', '+1 (779) 275-2269', 'Reiciendis obcaecati', '25', '290000');

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
(1, '2', 'Hilary Curry', '18', '2021-03-08', '2021-03-26', '8309.08', 'pending', '7163', '1146.08', 'Jael Joel', '', '', '0', 'MM2'),
(2, '1', 'Hilary Curry', '25', '2021-03-08', '2021-04-02', '21903.68', 'pending', '18882.48', '3021.2', 'Jael Joel', '', '', '0', 'MM2');

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
(1, '1', '2', '1', 'Xaviera Kramer', 'kgs', '1', '369', '7163.00', 'pending', 'Jael Joel', '0', 'MM2', '0.00'),
(2, '2', '1', '1', 'Xaviera Kramer', 'kgs', '1', '7163', '7163.00', 'pending', 'Jael Joel', '0', 'MM2', '0.00'),
(3, '2', '1', '2', 'Florence Vincent', 'kgs', '1', '10103', '11719.48', 'pending', 'Jael Joel', '16', 'MM2', '1616.48');

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
  `status` varchar(15) NOT NULL DEFAULT 'paid',
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_unit` varchar(254) NOT NULL,
  `product_category` varchar(254) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `sub_category` varchar(50) NOT NULL,
  `product_image` varchar(254) NOT NULL,
  `dsp_price` int(254) NOT NULL,
  `amount_before_tax` int(50) NOT NULL,
  `dpp_inc_tax` int(50) NOT NULL,
  `applicable_tax` int(50) NOT NULL,
  `profit_margin` int(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'Maite Calderon', 'MM2', '2021-03-04', '15:11', 'Jael Joel', 'partial', '100000', '16000', '116000');

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
(1, '1', '1', 'Xaviera Kramer', 'kgs', '100', '1000', '100000', 'partial', 'MM2');

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
(1, '1', 'Maite Calderon', '5', 'HHF6', '2021-03-04', '2021-03-09', 'HFTYH', '58000', 'pending', '50000', '8000', 'Jael Joel', '1');

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
(1, '1', '1', '1', 'Xaviera Kramer', 'kgs', '50', '1000', '50000', 'pending', 'Jael Joel', '1', 'HFTYH');

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
(1, '2021-03-05', 'Hilary Curry', '25', '2021-03-13', '15:11', 'done', 'Jael Joel', '18882.48', '1616.48', '18882.48', 'MM2'),
(2, '2021-03-08', 'Hilary Curry', '25', '2021-03-16', '09:24', 'approved', 'Jael Joel', '71630', '0', '71630', 'MM2'),
(3, '2021-03-08', 'Hilary Curry', '25', '2021-03-16', '09:26', 'done', 'Jael Joel', '7163', '0', '7163', 'MM2'),
(4, '2021-03-09', 'Amir Holder', '18', '2021-03-17', '10:23', 'pending', 'Jael Joel', '11719.48', '1616.48', '11719.48', 'MM2');

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
(1, '1', 'Xaviera Kramer', 'kgs', '7163', '1', '7163.00', '0.00', 'done', '0', 'MM2'),
(1, '2', 'Florence Vincent', 'kgs', '10103', '1', '11719.48', '1616.48', 'done', '16', 'MM2'),
(2, '1', 'Xaviera Kramer', 'kgs', '200', '10', '2000', '0', 'approved', '0', 'MM2'),
(3, '1', 'Xaviera Kramer', 'kgs', '7163', '1', '7163.00', '0.00', 'done', '0', 'MM2'),
(4, '2', 'Florence Vincent', 'kgs', '10103', '1', '11719.48', '1616.48', 'pending', '16', 'MM2');

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
(2, 'Maite Calderon', '2021-03-04', '58000', '57000.00000000001', '1000.0000000000001', 'rejected', 'Jael Joel'),
(3, 'Maite Calderon', '2021-03-08', '58000', '57000.00000000001', '1000.0000000000001', 'rejected', 'Jael Joel'),
(4, 'Maite Calderon', '2021-03-08', '58000', '57000.00000000001', '1000.0000000000001', 'rejected', 'Jael Joel');

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
(2, 2, '2021-03-09', 'HFTYH', '58000', '1000', '57000', 'Maite Calderon', '2021-03-04', 'rejected', 'Jael Joel'),
(3, 3, '2021-03-09', 'HFTYH', '58000', '1000', '57000', 'Maite Calderon', '2021-03-08', 'rejected', 'Jael Joel'),
(4, 4, '2021-03-09', 'HFTYH', '58000', '1000', '57000', 'Maite Calderon', '2021-03-08', 'rejected', 'Jael Joel');

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
(1, '2021-03-04', '15:02', 'Jael Joel', 'MM2', 'done');

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
(1, '1', '1', 'Xaviera Kramer', 'kgs', '100', 'done', 'MM2', '0');

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
(1, '2021-03-05', 'Hilary Curry', '25', 'approved', 'Jael Joel', '17266', '1616.48', '18882.48', 'MM2'),
(2, '2021-03-08', 'Hilary Curry', '18', 'done', 'Jael Joel', '7,163.00', '0.00', '7,163.00', 'MM2'),
(3, '2021-03-08', 'Hilary Curry', '25', 'approved', 'Jael Joel', '7163', '0', '7163', 'MM2'),
(4, '2021-03-10', 'Hilary Curry', '18', 'pending', 'Jael Joel', '71,630.00', '0.00', '71,630.00', 'MM2');

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
(1, '1', 'Xaviera Kramer', 'kgs', '7163', '1', '7163.00', '0.00', 'done', '0', 'MM2'),
(1, '2', 'Florence Vincent', 'kgs', '10103', '1', '11719.48', '1616.48', 'done', '16', 'MM2'),
(2, '1', 'Xaviera Kramer', 'kgs', '369', '1', '7163.00', '0.00', 'done', '0', 'MM2'),
(3, '1', 'Xaviera Kramer', 'kgs', '7163', '1', '7163.00', '0.00', 'approved', '0', 'MM2'),
(4, '1', 'Xaviera Kramer', 'kgs', '366', '10', '71630.00', '0.00', 'pending', '0', 'MM2');

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
('2021-03-04', '15:23', 'MM2', 'Jael Joel', 'Maite Calderon', 'HHF6', 1, '1', 'done'),
('2021-03-05', '13:39', 'MM2', 'Jael Joel', 'Maite Calderon', 'DN1', 2, '1', 'pending'),
('2021-03-05', '13:44', 'MM2', 'Jael Joel', 'Maite Calderon', '5', 5, '1', 'rejected');

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
('350', 'Xaviera Kramer', '1', 'MM2', '1', 1, '1', 'kgs', 'done'),
('10', 'Xaviera Kramer', '1', 'MM2', '2', 2, '1', 'kgs', 'pending'),
('5', 'Xaviera Kramer', '1', 'MM2', '3', 3, '1', 'kgs', 'pending'),
('4', 'Xaviera Kramer', '1', 'MM2', '5', 4, '1', 'kgs', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `sub_cat_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(1, 'Maite Calderon', 'zekovejoz@mailinator.com', '+1 (471) 382-9539', 'Fugiat deserunt beat', 'Duis tempore repreh', 'Elit eaque illum s', '5', '30');

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
(1, 'KGS', 'Kilo');

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
-- Indexes for table `tbl_branch_levels`
--
ALTER TABLE `tbl_branch_levels`
  ADD PRIMARY KEY (`product_name`,`branch`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD UNIQUE KEY `product_code` (`product_code`);

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
  ADD PRIMARY KEY (`receipt_no`),
  ADD UNIQUE KEY `invoice_no` (`invoice_no`);

--
-- Indexes for table `tbl_store_item`
--
ALTER TABLE `tbl_store_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_cat_code` (`sub_cat_code`);

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
  MODIFY `category_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `salesbill_no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_invoice_items`
--
ALTER TABLE `tbl_invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchaseorder`
--
ALTER TABLE `tbl_purchaseorder`
  MODIFY `po_number` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_purchaseorder_items`
--
ALTER TABLE `tbl_purchaseorder_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_purchase_bill`
--
ALTER TABLE `tbl_purchase_bill`
  MODIFY `purchasebill_no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_purchase_bill_items`
--
ALTER TABLE `tbl_purchase_bill_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  MODIFY `quote_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_receiptadv`
--
ALTER TABLE `tbl_receiptadv`
  MODIFY `rem_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_receiptadv_items`
--
ALTER TABLE `tbl_receiptadv_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_remittance`
--
ALTER TABLE `tbl_remittance`
  MODIFY `rem_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_remittance_items`
--
ALTER TABLE `tbl_remittance_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_requisition`
--
ALTER TABLE `tbl_requisition`
  MODIFY `requisition_No` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_requisition_items`
--
ALTER TABLE `tbl_requisition_items`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  MODIFY `quote_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  MODIFY `employee_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_store`
--
ALTER TABLE `tbl_store`
  MODIFY `receipt_no` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_store_item`
--
ALTER TABLE `tbl_store_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_transfer`
--
ALTER TABLE `tbl_transfer`
  MODIFY `transfer_no` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transfer_items`
--
ALTER TABLE `tbl_transfer_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `unit_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
