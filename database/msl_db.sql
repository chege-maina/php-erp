-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2021 at 04:01 PM
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
('821', 'Eric', 'Bird', '19', '', '0000-00-00', '4909', '01', 'pending'),
('821', 'Eric', 'Bird', '19', '', '0000-00-00', '4909', '01', 'pending'),
('Bird', '19', '<input type=\"number\" required=\"\" class=\"form-contr', '', '', '0000-00-00', '8599', '01', 'pending'),
('Bird', '<input type=\"number\" required=\"\" class=\"form-contr', '', '19', '', '0000-00-00', '3555', 'January', 'pending'),
('Bird', '<input type=\"number\" required=\"\" class=\"form-contr', '', '19', '', '0000-00-00', '4002', 'January', 'pending'),
('Bird', '821', '', '19', '', '0000-00-00', '5950', 'January', 'pending'),
('Bird', '821', '', '19', '', '0000-00-00', '3499', 'January', 'pending'),
('Simmons', '614', '', '35', '', '0000-00-00', '2019', 'February', 'pending'),
('Eric', 'Bird', '19', '821', '', '3333-11-22', '2323', 'March', 'pending'),
('Eric', 'Bird', '19', '821', '', '3333-11-22', '2323', 'March', 'pending'),
('Xaviera', 'Simmons', '35', '614', '69420', '2021-04-28', '121212', 'February', 'pending'),
('Eric', 'Bird', '19', '821', '', '0000-00-00', '6890', 'February', 'pending'),
('Eric', 'Bird', '19', '821', '11', '0000-00-00', '2021', 'February', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `employee_name` varchar(50) NOT NULL,
  `att_date` varchar(50) NOT NULL,
  `employee_no` varchar(50) NOT NULL,
  `branch` varchar(15) NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `late_entry` varchar(20) NOT NULL,
  `early_exit` varchar(20) NOT NULL,
  `id` bigint(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`employee_name`, `att_date`, `employee_no`, `branch`, `job_title`, `status`, `late_entry`, `early_exit`, `id`) VALUES
('ID No# 82', '2021-04-10', '225', 'mm2', 'Animi', 'present', 'false', 'true', 10);

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
-- Table structure for table `tbl_benefit`
--

CREATE TABLE `tbl_benefit` (
  `benefit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_benefit`
--

INSERT INTO `tbl_benefit` (`benefit`) VALUES
('Cars'),
('FUEL'),
('House'),
('Transport');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bene_deduct`
--

CREATE TABLE `tbl_bene_deduct` (
  `benefit` varchar(50) NOT NULL,
  `b_month` varchar(50) NOT NULL,
  `b_year` varchar(50) NOT NULL,
  `emp_no` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fixed` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `rate` varchar(20) NOT NULL,
  `total` varchar(100) NOT NULL,
  `type` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'MM2', 'war@maisha.com', '+254743120978', '8976-00100', 'Bungoma, Kenya'),
(5, 'Kidd Ward Associates', 'xaqor@mailinator.com', '+1 (556) 327-5221', 'Quaerat saepe sit do', 'Quod tempora deserun');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_branch_levels`
--

CREATE TABLE `tbl_branch_levels` (
  `product_name` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
  `min_level` varchar(50) NOT NULL,
  `max_level` varchar(50) NOT NULL,
  `reorder` varchar(50) NOT NULL
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
(1, 'Mabati'),
(2, 'pencil');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_companyloans`
--

CREATE TABLE `tbl_companyloans` (
  `date` date NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  `emp_no` varchar(50) NOT NULL,
  `loan_type` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `balance` varchar(100) NOT NULL,
  `installment` varchar(100) NOT NULL,
  `pc_interest` varchar(100) NOT NULL,
  `issue_date` date NOT NULL,
  `start_date` date NOT NULL,
  `int_type` varchar(20) NOT NULL,
  `fringe_tax` varchar(20) NOT NULL,
  `id` bigint(20) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `loan_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_companyloans`
--

INSERT INTO `tbl_companyloans` (`date`, `emp_name`, `designation`, `department`, `emp_no`, `loan_type`, `description`, `amount`, `balance`, `installment`, `pc_interest`, `issue_date`, `start_date`, `int_type`, `fringe_tax`, `id`, `status`, `loan_id`) VALUES
('1991-12-10', 'National ID No# 82', 'Animi', 'all', '225', 'loan', 'medical', '69', '69', '58', '32', '1974-03-08', '1999-02-06', 'reducing', 'yes', 14, 'pending', '225 1974-03-08'),
('1987-05-28', 'National ID No# 82', 'Animi', 'all', '225', 'damage', 'types', '35', '35', '6', '25', '1995-01-30', '1990-10-06', 'straight', 'no', 15, 'pending', '225 1995-01-30'),
('1992-06-10', 'National ID No# 82', 'Animi', 'all', '225', 'damage', 'lost', '70', '70', '38', '98', '2019-08-15', '2011-03-24', 'straight', 'yes', 16, 'pending', '225 2019-08-15');

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
  `credit_limit` varchar(100) NOT NULL,
  `sales_rep` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`name`, `email`, `physical_address`, `postal_address`, `tel_no`, `tax_id`, `payment_terms`, `credit_limit`, `sales_rep`, `status`) VALUES
('Eve Wall', 'gofexe@mailinator.com', 'Qui fugiat aut maio', 'Id lorem accusantium', '+1 (925) 742-1989', 'Velit sed dolore cup', '4', '57', 'CHEGE MAINA', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deduction`
--

CREATE TABLE `tbl_deduction` (
  `deduction` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_deduction`
--

INSERT INTO `tbl_deduction` (`deduction`) VALUES
('NHIF'),
('NSSF');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`id`, `name`) VALUES
(2, 'ACCOUNTANT'),
(4, 'Cars'),
(1, 'DRIVER'),
(5, 'HR'),
(3, 'SALES REP');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp_benefit`
--

CREATE TABLE `tbl_emp_benefit` (
  `id` bigint(20) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `nat` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `job` varchar(100) NOT NULL,
  `benefit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_emp_benefit`
--

INSERT INTO `tbl_emp_benefit` (`id`, `fname`, `lname`, `nat`, `type`, `job`, `benefit`) VALUES
(1, 'Eric', 'Bird', '19', 'benefit', '821', 'Cars'),
(2, 'Eric', 'Bird', '19', 'deduction', '821', 'NHIF');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp_leave`
--

CREATE TABLE `tbl_emp_leave` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `nat` varchar(100) NOT NULL,
  `job` varchar(100) NOT NULL,
  `empleave` varchar(100) NOT NULL,
  `num_days` varchar(50) NOT NULL,
  `opening_balance` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_emp_leave`
--

INSERT INTO `tbl_emp_leave` (`id`, `fname`, `lname`, `nat`, `job`, `empleave`, `num_days`, `opening_balance`, `status`) VALUES
(1, 'Josiah', 'Perkins', '82', '225', 'Annual', '0', '0', 'approved'),
(2, 'Eric', 'Bird', '19', '821', 'Maternity', '12', '34', 'approved'),
(3, 'Josiah', 'Perkins', '82', '225', 'Maternity', '34', '11', 'approved');

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leavecat`
--

CREATE TABLE `tbl_leavecat` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_leavecat`
--

INSERT INTO `tbl_leavecat` (`id`, `name`) VALUES
(1, 'Annual'),
(2, 'Maternity');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_muster`
--

CREATE TABLE `tbl_muster` (
  `must_year` varchar(50) NOT NULL,
  `must_month` varchar(50) NOT NULL,
  `paye_year` varchar(50) NOT NULL,
  `nhif_year` varchar(50) NOT NULL,
  `emp_no` varchar(50) NOT NULL,
  `emp_name` varchar(50) NOT NULL,
  `branch` varchar(15) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `salary` varchar(100) NOT NULL,
  `absentee` varchar(50) NOT NULL,
  `earnings` varchar(100) NOT NULL,
  `paye` varchar(100) NOT NULL,
  `nssf` varchar(100) NOT NULL,
  `nhif` varchar(100) NOT NULL,
  `advance` varchar(100) NOT NULL,
  `loan` varchar(100) NOT NULL,
  `deduct` varchar(100) NOT NULL,
  `pay` varchar(100) NOT NULL,
  `nssf_employer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nssf`
--

CREATE TABLE `tbl_nssf` (
  `rate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `tbl_paye`
--

CREATE TABLE `tbl_paye` (
  `id` int(11) NOT NULL,
  `from` varchar(50) NOT NULL,
  `to` varchar(50) NOT NULL,
  `rate` varchar(50) NOT NULL,
  `desc` varchar(50) NOT NULL
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
  `bulk_unit` varchar(20) NOT NULL,
  `conversion` varchar(50) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift`
--

CREATE TABLE `tbl_shift` (
  `shift_id` int(50) NOT NULL,
  `shift_name` varchar(50) NOT NULL,
  `start_time` varchar(50) NOT NULL,
  `end_time` varchar(50) NOT NULL,
  `work_hours` varchar(50) NOT NULL,
  `non_work` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_shift`
--

INSERT INTO `tbl_shift` (`shift_id`, `shift_name`, `start_time`, `end_time`, `work_hours`, `non_work`) VALUES
(4, 'Brendan Case', '15:44', '16:54', '81', '72'),
(5, 'Hector Short', '22:29', '09:04', '62', '55');

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
  `account_no` varchar(50) NOT NULL,
  `begin_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;


ALTER TABLE `tbl_staff`
  ADD `employ_date` date NOT NULL AFTER `begin_date`,
  ADD `duration` varchar(16) NOT NULL AFTER `employ_date`,
  ADD `end_date` date NOT NULL AFTER `duration`,
  ADD `job_title` varchar(50) NOT NULL AFTER `end_date`,
  ADD `department` varchar(50) NOT NULL AFTER `job_title`,
  ADD `report_to` varchar(50) NOT NULL AFTER `department`,
  ADD `head_of` varchar(50) NOT NULL AFTER `report_to`,
  ADD `region` varchar(50) NOT NULL AFTER `head_of`,
  ADD `currency` varchar(50) NOT NULL AFTER `region`,
  ADD `shift` varchar(50) NOT NULL AFTER `currency`,
  ADD `employ_type` varchar(50) NOT NULL AFTER `shift`,
  ADD `off_days` varchar(50) NOT NULL AFTER `employ_type`,
  ADD `pay_type` varchar(50) NOT NULL AFTER `off_days`,
  ADD `salary` varchar(50) NOT NULL AFTER `pay_type`,
  ADD `income_tax` varchar(50) NOT NULL AFTER `salary`,
  ADD `deduct_nhif` varchar(50) NOT NULL AFTER `income_tax`,
  ADD `deduct_nssf` varchar(50) NOT NULL AFTER `deduct_nhif`,
  ADD `account_name` varchar(50) NOT NULL AFTER `deduct_nssf`,
  ADD `bank_name` varchar(50) NOT NULL AFTER `account_name`,
  ADD `sort_code` varchar(50) NOT NULL AFTER `bank_name`,
  ADD `s_mobile_no` varchar(50) NOT NULL AFTER `sort_code`,
  ADD `s_bank_branch` varchar(50) NOT NULL AFTER `s_mobile_no`,
  ADD `s_payment` int(11) NOT NULL AFTER `s_bank_branch`,
  ADD `status` varchar(15) NOT NULL DEFAULT 'pending' AFTER `s_payment`,
  ADD `branch` varchar(50) NOT NULL AFTER `status`;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`f_name`, `m_name`, `l_name`, `gender`, `dob`, `passport`, `nat_id`, `pin_no`, `res`, `nssf_no`, `nhif_no`, `off_mail`, `pers_mail`, `country`, `mobile_no`, `phone_no`, `ext_no`, `city`, `county`, `postal_code`, `job_no`, `employ_date`, `begin_date`, `duration`, `end_date`, `job_title`, `department`, `report_to`, `head_of`, `region`, `currency`, `shift`, `employ_type`, `off_days`, `pay_type`, `salary`, `income_tax`, `deduct_nhif`, `deduct_nssf`, `account_name`, `account_no`, `bank_name`, `sort_code`, `s_mobile_no`, `s_bank_branch`, `s_payment`, `status`, `branch`) VALUES
('Eric', 'Tate Hammond', 'Bird', 'Male', '2007-07-17', '/uploads/Screenshot (2).png', '19', '36', 'Resident', '27', '43', 'fylydukog@mailinator.com', 'pogez@mailinator.com', 'Australia', '6', '12', '98', 'Voluptate quos et un', 'Qui cupidatat tempor', '28402', '821', '1982-07-26', '1991-03-21', 'Quo officia aliq', '1978-08-19', 'Harum', 'all', 'all', 'all', 'Nairobi', 'KES', 'Regular', '1982-07-26', 'SATURDAY', 'basic', '2', 'none', 'true', 'false', '', '', '', '', '', '', 0, 'pending', 'mm1'),
('Xaviera', 'Gabriel Mcclure', 'Simmons', 'Female', '2011-06-28', '/uploads/Screenshot (2).png', '35', '20', 'Resident', '1', '65', 'vany@mailinator.com', 'luqu@mailinator.com', 'Viet Nam', '83', '67', '58', 'Elit ipsum ea sint', 'Molestias quia quos', '54824', '614', '1981-01-13', '2010-03-06', 'Est eligendi min', '2004-04-04', 'Rerum quo voluptas f', 'ACCOUNTANT', 'all', 'all', 'Nairobi', 'KES', 'Regular', '1981-01-13', 'MONDAY', 'net', '9', 'none', 'true', 'false', '', '', '', '', '', '', 0, 'pending', 'undefined'),
('Philip', 'Amaya Padilla', 'Kelley', 'Male', '1995-11-14', '/uploads/Screenshot (2).png', '76', '100', 'Resident', '90', '46', 'juquzudam@mailinator.com', 'coberasa@mailinator.com', 'Curacao', '74', '99', '81', 'Magni nesciunt cill', 'Quis laboriosam vit', '84185', '704', '1985-04-02', '1976-03-22', 'Unde adipisci et', '2004-05-24', 'Voluptatum dolor per', 'ACCOUNTANT', 'all', 'all', 'Nairobi', 'JPY', 'Regular', '1985-04-02', 'THURSDAY', 'basic', '2', 'none', 'true', 'false', '', '', '', '', '', '', 0, 'pending', 'undefined'),
('Josiah', 'Blaine Dickerson', 'Perkins', 'Female', '2015-11-18', '/uploads/Screenshot (2).png', '82', '85', 'Resident', '73', '77', 'liqiraduda@mailinator.com', 'fyfi@mailinator.com', 'British Indian Ocean Territory', '58', '99', '22', 'Consequatur laudanti', 'Velit occaecat volu', '86287', '225', '1990-10-13', '2014-10-13', 'Nulla repellendu', '1983-12-03', 'Animi', 'all', 'all', 'all', 'Nairobi', 'JPY', 'Regular', '1990-10-13', 'SUNDAY', 'consolidated', '4', 'none', 'true', 'false', 'Callum Acevedo', 'Quia vel hic sed min', 'Michelle Cash', 'Ut omnis esse expli', '357', 'Aut hic qui sequi ut', 0, 'approved', 'mm2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staff_items`
--

CREATE TABLE `tbl_staff_items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `relation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_staff_items`
--

INSERT INTO `tbl_staff_items` (`id`, `name`, `email`, `phone`, `relation`) VALUES
(1, 'Animi non qui quia', '+1 (419) 354-9206', '+1 (419) 354-9206', 'Enim officiis ex qui');

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
  `receipt_no` bigint(100) NOT NULL,
  `lpo_number` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'pending',
  `invoice_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`id`, `name`, `category`, `sub_cat_code`) VALUES
(1, 'devki mabati', 'Mabati', '001-001'),
(2, 'nataraj', 'pencil', '002-001');

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
  `number_of_days` varchar(50) NOT NULL DEFAULT '30',
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(1, 'Ch', 'Chuma');

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
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_no` (`employee_no`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`bank_name`,`acc_no`);

--
-- Indexes for table `tbl_benefit`
--
ALTER TABLE `tbl_benefit`
  ADD PRIMARY KEY (`benefit`);

--
-- Indexes for table `tbl_bene_deduct`
--
ALTER TABLE `tbl_bene_deduct`
  ADD PRIMARY KEY (`benefit`,`b_month`,`b_year`,`emp_no`);

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
-- Indexes for table `tbl_companyloans`
--
ALTER TABLE `tbl_companyloans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`name`,`email`);

--
-- Indexes for table `tbl_deduction`
--
ALTER TABLE `tbl_deduction`
  ADD PRIMARY KEY (`deduction`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_emp_benefit`
--
ALTER TABLE `tbl_emp_benefit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_emp_leave`
--
ALTER TABLE `tbl_emp_leave`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tbl_leavecat`
--
ALTER TABLE `tbl_leavecat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_muster`
--
ALTER TABLE `tbl_muster`
  ADD PRIMARY KEY (`must_year`,`must_month`,`emp_no`);

--
-- Indexes for table `tbl_nhif`
--
ALTER TABLE `tbl_nhif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_nssf`
--
ALTER TABLE `tbl_nssf`
  ADD PRIMARY KEY (`rate`);

--
-- Indexes for table `tbl_paybill`
--
ALTER TABLE `tbl_paybill`
  ADD PRIMARY KEY (`rem_no`);

--
-- Indexes for table `tbl_paye`
--
ALTER TABLE `tbl_paye`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  ADD PRIMARY KEY (`shift_id`),
  ADD UNIQUE KEY `shift_name` (`shift_name`);

--
-- Indexes for table `tbl_staff`
--
ALTER TABLE `tbl_staff`
  ADD UNIQUE KEY `nat_id` (`nat_id`,`pin_no`,`nssf_no`,`nhif_no`,`job_no`,`account_no`);

--
-- Indexes for table `tbl_staff_items`
--
ALTER TABLE `tbl_staff_items`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_companyloans`
--
ALTER TABLE `tbl_companyloans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_emp_benefit`
--
ALTER TABLE `tbl_emp_benefit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_emp_leave`
--
ALTER TABLE `tbl_emp_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `salesbill_no` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_invoice_items`
--
ALTER TABLE `tbl_invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_leavecat`
--
ALTER TABLE `tbl_leavecat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchaseorder`
--
ALTER TABLE `tbl_purchaseorder`
  MODIFY `po_number` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchaseorder_items`
--
ALTER TABLE `tbl_purchaseorder_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_bill`
--
ALTER TABLE `tbl_purchase_bill`
  MODIFY `purchasebill_no` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_purchase_bill_items`
--
ALTER TABLE `tbl_purchase_bill_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  MODIFY `quote_no` bigint(20) NOT NULL AUTO_INCREMENT;

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
  MODIFY `rem_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_remittance_items`
--
ALTER TABLE `tbl_remittance_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_requisition`
--
ALTER TABLE `tbl_requisition`
  MODIFY `requisition_No` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_requisition_items`
--
ALTER TABLE `tbl_requisition_items`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  MODIFY `quote_no` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  MODIFY `shift_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_staff_items`
--
ALTER TABLE `tbl_staff_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_store`
--
ALTER TABLE `tbl_store`
  MODIFY `receipt_no` bigint(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_store_item`
--
ALTER TABLE `tbl_store_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
