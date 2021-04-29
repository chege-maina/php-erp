-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2021 at 10:07 AM
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
('Eden Cline', 'Kuame Johns', '5000'),
('Georgia Frye', 'Dolan Mendoza', '10000'),
('Georgia Frye', 'Leila Stokes', '6000'),
('Kaden Dawson', 'Leila Stokes', '5100');

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
('Xaviera', 'Simmons', '35', '614', '69420', '2021-04-28', '121212', 'February', 'pending'),
('Geoffrey', 'Levine', '42', '272', '4000', '2020-04-07', '2006', 'November', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_asset`
--

CREATE TABLE `tbl_asset` (
  `name` varchar(100) NOT NULL,
  `number` varchar(100) NOT NULL,
  `tag_no` varchar(100) NOT NULL,
  `branch` varchar(15) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `descpt` varchar(30) NOT NULL,
  `weight` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `dep_rate` varchar(15) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `dep_method` varchar(50) NOT NULL,
  `wear_tear` varchar(50) NOT NULL,
  `asset_status` varchar(50) NOT NULL,
  `financier` varchar(30) NOT NULL,
  `loan_ref` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `asset_name` varchar(100) NOT NULL,
  `asset_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_asset`
--

INSERT INTO `tbl_asset` (`name`, `number`, `tag_no`, `branch`, `unit`, `descpt`, `weight`, `date`, `dep_rate`, `cost`, `dep_method`, `wear_tear`, `asset_status`, `financier`, `loan_ref`, `status`, `asset_name`, `asset_code`) VALUES
('Ivy Wagner', '62', '35', 'MM1', 'Pieces', 'In sequi adipisci do', '60', '1978-09-23', '40', '100', 'Reducing', 'Class 2', 'inactive', 'Quidem sit exercita', '22', 'pending', '', ''),
('Kitra Villarreal', '96', '49', 'MM1', 'Pieces', 'Laboriosam voluptas', '68', '1980-01-04', '57', '11', 'Reducing', 'Class 3', 'disposed', 'Quia sunt in repell', '47', 'pending', '', '');

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
('Josiah Perkins', '1998-06-05', '225', 'mm2', 'Animi officia sed a', 'absent', 'true', 'false', 9);

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
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bene_deduct`
--

INSERT INTO `tbl_bene_deduct` (`benefit`, `b_month`, `b_year`, `emp_no`, `name`, `fixed`, `qty`, `rate`, `total`, `type`, `status`) VALUES
('NHIF', 'November', '2006', '272', 'Geoffrey Levine', '0', '107', '8', '856', 'deduction', 'pending'),
('NSSF', 'November', '2006', '272', 'Geoffrey Levine', '200', '0', '0', '200', 'deduction', 'pending'),
('Transport', 'November', '2006', '272', 'Geoffrey Levine', '1001', '0', '0', '1001', 'benefit', 'pending');

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
  `reorder` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_branch_levels`
--

INSERT INTO `tbl_branch_levels` (`product_name`, `branch`, `min_level`, `max_level`, `reorder`) VALUES
('Eden Cline', 'MM1', '120', '500', '150'),
('Georgia Frye', 'MM1', '120', '500', '200'),
('Georgia Frye', 'MM2', '130', '600', '300'),
('Kaden Dawson', 'MM1', '10', '100', '50'),
('Kaden Dawson', 'MM2', '5', '69', '30'),
('Marsden Myers', 'MM1', '20', '500', '100'),
('Sierra Gutierrez', 'MM1', '120', '300', '150'),
('Sierra Gutierrez', 'MM2', '120', '400', '200');

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
(1, 'CEMENT'),
(3, 'dsgfsd'),
(2, 'gggg'),
(5, 'haha'),
(4, 'willie');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chart_account_details`
--

CREATE TABLE `tbl_chart_account_details` (
  `number` varchar(10) NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` enum('debit','credit') NOT NULL DEFAULT 'debit',
  `carrying_forward` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_chart_account_details`
--

INSERT INTO `tbl_chart_account_details` (`number`, `title`, `type`, `carrying_forward`) VALUES
('010000', 'Assets', 'debit', 0),
('010100', 'Cash And Financial Assets', 'debit', 1),
('010101', 'Land and Buildings', 'debit', 0),
('010102', 'Financial Assets (Investments)', 'debit', 0),
('010103', 'Restricted Cash and Financial Assets', 'debit', 0),
('010104', 'Motor Vehicles Saloon Cars', 'debit', 0),
('010105', 'Motor Vehicles Lorries and Canters', 'debit', 1),
('010106', 'Computer', 'debit', 1),
('010200', 'Receivables And Contracts', 'debit', 0),
('010201', 'Accounts, Notes And Loans Receivable', 'debit', 0),
('010202', 'Contracts', 'debit', 0),
('010203', 'Nontrade And Other Receivables', 'debit', 0),
('010300', 'Inventory', 'debit', 0),
('010301', 'Merchandise', 'debit', 0),
('010302', 'Raw Material, Parts And Supplies', 'debit', 0),
('010303', 'Work In Process', 'debit', 0),
('010304', 'Finished Goods', 'debit', 0),
('010305', 'Other Inventory', 'debit', 0),
('010400', 'Accruals And Additional Assets', 'debit', 0),
('010401', 'Prepaid Expense', 'debit', 0),
('010402', 'Accrued Income', 'debit', 0),
('010403', 'Additional Assets', 'debit', 0),
('010500', 'Property, Plant And Equipment', 'debit', 0),
('010501', 'Land And Land Improvements', 'debit', 0),
('010502', 'Buildings, Structures And Improvements', 'debit', 0),
('010503', 'Machinery And Equipment', 'debit', 0),
('010504', 'Furniture And Fixtures', 'debit', 0),
('010505', 'Additional Property, Plant And Equipment', 'debit', 0),
('010506', 'Construction In Progress', 'credit', 0),
('010507', 'Accumulated Depreciation And Depletion', 'debit', 0),
('010600', 'Intangible Assets (Excluding Goodwill)', 'debit', 0),
('010601', 'Intellectual Property', 'debit', 0),
('010602', 'Computer Software', 'debit', 0),
('010603', 'Trade And Distribution Assets', 'debit', 0),
('010604', 'Contracts And Rights', 'debit', 0),
('010605', 'Right To Use Assets (Classified By Type)', 'debit', 0),
('010606', 'Other Intangible Assets', 'debit', 0),
('010607', 'Acquisition In Progress', 'credit', 0),
('010608', 'Accumulated Amortization', 'debit', 0),
('010700', 'Goodwill', 'credit', 0),
('020000', 'Liabilities', 'credit', 0),
('020100', 'Payables Statements', 'credit', 0),
('020101', 'Trade Payables', 'credit', 0),
('020102', 'Dividends Payable', 'credit', 0),
('020103', 'Interest Payable', 'credit', 0),
('020104', 'Other Payables', 'credit', 0),
('020200', 'Accruals And Other Liabilities', 'credit', 0),
('020201', 'Accrued Expenses', 'credit', 0),
('020202', 'Deferred Income (Unearned Revenue) ', 'credit', 0),
('020203', 'Accrued Taxes (Other Than Payroll)', 'credit', 0),
('020204', 'Other (Non-Financial) Liabilities', 'credit', 0),
('020300', 'Financial Labilities', 'credit', 0),
('020301', 'Notes Payable', 'credit', 0),
('020302', 'Loans Payable', 'credit', 0),
('020303', 'Bonds (Debentures)', 'credit', 0),
('020304', 'Other Debts And Borrowings', 'credit', 0),
('020305', 'Lease Obligations', 'credit', 0),
('020306', 'Derivative Financial Liabilities', 'credit', 0),
('020307', 'Other Liabilities', 'credit', 0),
('020400', 'Provisions (Contingencies)', 'credit', 0),
('020401', 'Customer Related Provisions', 'credit', 0),
('020402', 'Ligation And Regulatory Provisions', 'credit', 0),
('020403', 'Other Provisions', 'credit', 0),
('030000', 'Equity', 'credit', 0),
('030100', 'Owners Equity (Attributable To Owners Of Parent)', 'credit', 0),
('030101', 'Equity At par (Issued Capital)', 'credit', 0),
('030102', 'Additional Paid-in Capital', 'credit', 0),
('030200', 'Retained Earnings', 'credit', 0),
('030201', 'Appropriated', 'credit', 0),
('030202', 'Unappropriated', 'debit', 0),
('030203', 'Deficit ', 'debit', 0),
('030204', 'In Suspense', 'debit', 0),
('030300', 'Accumulated OCI (US GAAP)', 'debit', 0),
('030400', 'Other Reserves (IFRS)', 'debit', 0),
('030500', 'Other Equity Items', 'debit', 0),
('030501', 'ESOP Related Items', 'debit', 0),
('030502', 'Subscribed Stock Receivables', 'debit', 0),
('030503', 'Treasury Stock', 'credit', 0),
('030504', 'Miscellaneous Equity', 'credit', 0),
('030600', 'Noncontrolling (Minority) Interest', 'credit', 0),
('040000', 'Revenue', 'credit', 0),
('040100', 'Recognized Point Of Time', 'credit', 0),
('040101', 'Goods', 'credit', 0),
('040102', 'Services', 'credit', 0),
('040200', 'Recognized Over Time', 'credit', 0),
('040201', 'Products', 'credit', 0),
('040202', 'Services', 'debit', 0),
('040300', 'Adjustments', 'debit', 0),
('040301', 'Variable Consideration', 'debit', 0),
('040302', 'Consideration Paid (Payable) To Customers', 'debit', 0),
('040303', 'Other Adjustments', 'debit', 0),
('050000', 'Expenses', 'debit', 0),
('050100', 'Expenses Classified By Nature', 'debit', 0),
('050101', 'Material And Merchandise', 'debit', 0),
('050102', 'Employee Benefits', 'debit', 0),
('050103', 'Services', 'debit', 0),
('050104', 'Rent, Depreciation, Amortization And Depletion', 'debit', 0),
('050105', 'Increase (Decrease) In Inventories Of Finished Goods And Work In Progress', 'debit', 0),
('050106', 'Other Work Performed By Entity And Capitalized', 'debit', 0),
('050200', 'Expenses Classified By Function', 'debit', 0),
('050201', 'Cost Of Sales', 'debit', 0),
('050202', 'Selling, General And Administrative ', 'debit', 0),
('050203', 'Accounts Receivable, Credit Loss (Reversal)', 'debit', 0),
('050204', 'Finance Costs', 'debit', 0),
('060000', 'Other (Non-Operating) Income And Expenses', 'debit', 0),
('060100', 'Other Revenue And Expenses', 'debit', 0),
('060101', 'Other Revenue', 'credit', 0),
('060102', 'Other Expenses', 'debit', 0),
('060200', 'Gains And Losses', 'debit', 0),
('060201', 'Foreign Currency Transaction Gain (Loss)', 'debit', 0),
('060202', 'Gain (Loss) On Investments', 'debit', 0),
('060203', 'Gain (Loss) On Derivatives', 'debit', 0),
('060204', 'Gain (Loss) On Disposal Of Assets', 'debit', 0),
('060205', 'Debt Related Gain (Loss)', 'debit', 0),
('060206', 'Impairment Loss', 'debit', 0),
('060207', 'Other Gains And (Losses)', 'debit', 0),
('060300', 'Taxes (Other Than Income And Payroll) And Fees', 'debit', 0),
('060301', 'Real Estate Taxes And Insurance', 'debit', 0),
('060302', 'Highway (Road) Taxes And Tolls', 'debit', 0),
('060303', 'Direct Tax And License Fees', 'debit', 0),
('060304', 'Excise And Sales Taxes', 'debit', 0),
('060305', 'Customs Fees And Duties (Not Classified As Sales Or Excise)', 'debit', 0),
('060306', 'Non-Deductible VAT (GST)', 'debit', 0),
('060307', 'General Insurance Expense', 'debit', 0),
('060308', 'Administrative Fees (Revenue Stamps)', 'debit', 0),
('060309', 'Fines And Penalties', 'debit', 0),
('060310', 'Miscellaneous Taxes', 'debit', 0),
('060311', 'Other Taxes And Fees', 'debit', 0),
('060400', 'Income Tax Expense (Benefit)', 'debit', 0),
('070000', 'Intercompany And Related Party Accounts', 'debit', 0),
('070100', 'Intercompany And Related Party Assets', 'debit', 0),
('070101', 'Intercompany Balances (Eliminated In Consolidation)', 'debit', 0),
('070102', 'Related Party Balances (Reported Or Disclosed)', 'debit', 0),
('070103', 'Intercompany Investments', 'debit', 0),
('070200', 'Intercompany And Related Party Liabilities', 'credit', 0),
('070201', 'Intercompany Balances (Eliminated In Consolidation)', 'credit', 0),
('070202', 'Related Party Balances (Reported Or Disclosed)', 'credit', 0),
('070300', 'Intercompany And Related Party Income And Expense', 'credit', 0),
('070301', 'Intercompany And Related Party Income', 'credit', 0),
('070302', 'Intercompany And Related Party Expenses', 'debit', 0),
('070303', 'Income (Loss) From Equity Method Investments', 'credit', 0),
('345543', 'rrraah', 'debit', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chart_parent_child`
--

CREATE TABLE `tbl_chart_parent_child` (
  `child_number` varchar(10) NOT NULL,
  `parent_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_chart_parent_child`
--

INSERT INTO `tbl_chart_parent_child` (`child_number`, `parent_number`) VALUES
('010100', '010000'),
('010200', '010000'),
('010300', '010000'),
('010400', '010000'),
('010500', '010000'),
('010600', '010000'),
('010700', '010000'),
('345543', '010000'),
('010101', '010100'),
('010102', '010100'),
('010103', '010100'),
('010104', '010100'),
('010105', '010100'),
('010106', '010100'),
('010201', '010200'),
('010202', '010200'),
('010203', '010200'),
('010301', '010300'),
('010302', '010300'),
('010303', '010300'),
('010304', '010300'),
('010305', '010300'),
('010401', '010400'),
('010402', '010400'),
('010403', '010400'),
('010501', '010500'),
('010502', '010500'),
('010503', '010500'),
('010504', '010500'),
('010506', '010500'),
('010507', '010500'),
('010505', '010506'),
('010601', '010600'),
('010602', '010600'),
('010603', '010600'),
('010604', '010600'),
('010605', '010600'),
('010606', '010600'),
('010607', '010600'),
('010608', '010600'),
('020100', '020000'),
('020200', '020000'),
('020300', '020000'),
('020400', '020000'),
('020101', '020100'),
('020102', '020100'),
('020103', '020100'),
('020104', '020100'),
('020201', '020200'),
('020202', '020200'),
('020203', '020200'),
('020204', '020200'),
('020301', '020300'),
('020302', '020300'),
('020303', '020300'),
('020304', '020300'),
('020305', '020300'),
('020306', '020300'),
('020307', '020300'),
('020401', '020400'),
('020402', '020400'),
('020403', '020400'),
('030100', '030000'),
('030200', '030000'),
('030300', '030000'),
('030400', '030000'),
('030500', '030000'),
('030600', '030000'),
('030101', '030100'),
('030102', '030100'),
('030201', '030200'),
('030202', '030200'),
('030203', '030200'),
('030204', '030200'),
('030501', '030500'),
('030502', '030500'),
('030503', '030500'),
('030504', '030500'),
('040100', '040000'),
('040200', '040000'),
('040300', '040000'),
('040101', '040100'),
('040102', '040100'),
('040201', '040200'),
('040202', '040200'),
('040301', '040300'),
('040302', '040300'),
('040303', '040300'),
('050100', '050000'),
('050200', '050000'),
('050101', '050100'),
('050102', '050100'),
('050103', '050100'),
('050104', '050100'),
('050105', '050100'),
('050106', '050100'),
('050201', '050200'),
('050202', '050200'),
('050203', '050200'),
('050204', '050200'),
('060100', '060000'),
('060200', '060000'),
('060300', '060000'),
('060400', '060000'),
('060101', '060100'),
('060102', '060100'),
('060201', '060200'),
('060202', '060200'),
('060203', '060200'),
('060204', '060200'),
('060205', '060200'),
('060206', '060200'),
('060207', '060200'),
('060301', '060300'),
('060302', '060300'),
('060303', '060300'),
('060304', '060300'),
('060305', '060300'),
('060306', '060300'),
('060307', '060300'),
('060308', '060300'),
('060309', '060300'),
('060310', '060300'),
('060311', '060300'),
('070100', '070000'),
('070200', '070000'),
('070300', '070000'),
('070101', '070100'),
('070102', '070100'),
('070103', '070100'),
('070201', '070200'),
('070202', '070200'),
('070301', '070300'),
('070302', '070300'),
('070303', '070300');

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
('2021-04-06', 'National ID No# 42', 'Repudiandae veniam', 'Reprehenderit et ul', '272', 'damage', 'fuel', '1200', '1200', '1200', '0', '2021-04-08', '2021-04-08', 'none', 'yes', 1, 'pending', '272 2021-04-08');

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
  `sales_rep` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`name`, `email`, `physical_address`, `postal_address`, `tel_no`, `tax_id`, `payment_terms`, `credit_limit`, `sales_rep`, `status`) VALUES
('Whitney Walters', 'huly@mailinator.com', 'Eum voluptas ut volu', 'Eiusmod molestias il', '+1 (483) 975-7668', 'Omnis esse exercitat', '28', '85', 'KIPGHOGE', 'pending');

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
(1, 'Geoffrey', 'Levine', '42', 'deduction', '272', 'NHIF'),
(2, 'Geoffrey', 'Levine', '42', 'deduction', '272', 'NSSF'),
(3, 'Geoffrey', 'Levine', '42', 'benefit', '272', 'FUEL'),
(4, 'Geoffrey', 'Levine', '42', 'benefit', '272', 'Transport');

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
(1, '2', 'Whitney Walters', '28', '2021-03-19', '2021-04-16', '16424.21', 'approved', '14158.8', '2265.41', 'Jael Joel', '', '', '0', 'MM2'),
(2, '1', 'Whitney Walters', '28', '2021-04-28', '2021-05-26', '41893.63', 'approved', '36115.2', '5778.43', 'Jael Joel', '', '', '0', 'MM2');

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
(1, '1', '2', '001_002_001', 'Kaden Dawson', 'kg', '1', '6000', '6840', 'pending', 'Jael Joel', '14', 'MM2', '840'),
(2, '1', '2', '002_001_001', 'Marsden Myers', 'kg', '1', '6420', '7318.80', 'pending', 'Jael Joel', '14', 'MM2', '898.80'),
(3, '2', '1', '001_002_001', 'Kaden Dawson', 'kg', '0.4', '6907', '27360.00', 'pending', 'Jael Joel', '14', 'MM2', '3360.00'),
(4, '2', '1', '002_001_004', 'Georgia Frye', 'kg', '0.1', '8950', '8755.20', 'pending', 'Jael Joel', '14', 'MM2', '1075.20');

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
-- Table structure for table `tbl_ledger`
--

CREATE TABLE `tbl_ledger` (
  `ledger_name` varchar(200) NOT NULL,
  `group_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ledger`
--

INSERT INTO `tbl_ledger` (`ledger_name`, `group_code`) VALUES
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ledger_amounts`
--

CREATE TABLE `tbl_ledger_amounts` (
  `group_code` varchar(100) NOT NULL,
  `ledger` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ledger_amounts`
--

INSERT INTO `tbl_ledger_amounts` (`group_code`, `ledger`, `amount`, `date`, `status`) VALUES
('010107', 'EQUITY BANK', '114000.00000000001', '2021-04-27', 'Credit'),
('010107', 'KCB', '41171.32603448276', '2021-04-28', 'Debit'),
('010201', 'Whitney Walters', '41171.32603448276', '2021-04-28', 'Credit'),
('020101', 'Dolan Mendoza', '114000.00000000001', '2021-04-27', 'Debit');

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nssf`
--

CREATE TABLE `tbl_nssf` (
  `rate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_nssf`
--

INSERT INTO `tbl_nssf` (`rate`) VALUES
('200');

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

--
-- Dumping data for table `tbl_paybill`
--

INSERT INTO `tbl_paybill` (`supplier_name`, `rem_no`, `cheque_no`, `bank_name`, `amount`, `cheque_type`, `pay_type`, `status`, `date`) VALUES
('Leila Stokes', '1', '45665', 'EQUITY BANK', '87210', 'interbank', 'pay', 'paid', '2021-04-02'),
('Leila Stokes', '2', '65', 'KCB', '31122', 'inhouse', 'pay', 'paid', '2021-04-27'),
('Dolan Mendoza', '3', '76', 'EQUITY BANK', '228000.00000000003', 'inhouse', 'pay', 'paid', '2021-04-28'),
('Dolan Mendoza', '4', '54', 'Mannix Merrill', '114000.00000000001', 'interbank', 'pay', 'paid', '2021-04-29');

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
  `relief` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_paye`
--

INSERT INTO `tbl_paye` (`id`, `fromnhif`, `tonhif`, `rate`, `descnhif`, `relief`) VALUES
(6, '77', '59', '69', '2014', '2400'),
(7, '50', '35', '21', '2014', '2400'),
(8, '85', '35', '22', '2014', '2400'),
(9, '39', '29', '50', '2014', '2400'),
(10, '1', '10164', '10', '2012', '2400'),
(11, '10165', '19740', '15', '2012', '2400'),
(12, '19741', '29316', '20', '2012', '2400'),
(13, '29317', '38892', '25', '2012', '2400'),
(14, '38893', '99999999', '30', '2012', '2400'),
(15, '61', '61', '25', '2008', '1200'),
(16, '68', '93', '0', '2008', '1200'),
(17, '46', '13', '35', '2008', '1200'),
(18, '44', '13', '15', '2008', '1200'),
(19, '23', '83', '51', '2008', '1200');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prdmapping`
--

CREATE TABLE `tbl_prdmapping` (
  `id` int(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `group_code` varchar(100) NOT NULL,
  `ledger` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_prdmapping`
--

INSERT INTO `tbl_prdmapping` (`id`, `product_code`, `product_name`, `group_code`, `ledger`, `status`) VALUES
(11, '001_002_001', 'Kaden Dawson', '050201', 'Purchase Account', 'When Purchasing'),
(12, '001_002_001', 'Kaden Dawson', '040101', 'Sale of FMCG Products', 'When Selling'),
(15, '002_001_004', 'Georgia Frye', '050201', 'Purchase Account', 'When Purchasing'),
(16, '002_001_004', 'Georgia Frye', '040101', 'Sale of Harware Items', 'When Selling');

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
  `status` varchar(15) NOT NULL DEFAULT 'pending',
  `atomic_unit` varchar(100) NOT NULL,
  `conversion` varchar(200) NOT NULL,
  `bs_price` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `product_name`, `product_code`, `product_unit`, `product_category`, `weight`, `sub_category`, `product_image`, `dsp_price`, `amount_before_tax`, `dpp_inc_tax`, `applicable_tax`, `profit_margin`, `user`, `status`, `atomic_unit`, `conversion`, `bs_price`) VALUES
(1, 'Kaden Dawson', '001_002_001', 'kg', 'CEMENT', '38', 'funky', '/uploads/gg.png', 6000, 5000, 5700, 14, 20, 'Jael Joel', 'active', 'gm', '10', '6907'),
(2, 'Marsden Myers', '002_001_001', 'kg', 'gggg', '58', 'heaven yes', '/uploads/gg.png', 6420, 5000, 5700, 14, 28, 'Jael Joel', 'active', 'gm', '10', '8009'),
(3, 'Sierra Gutierrez', '002_001_002', 'kg', 'gggg', '92', 'heaven yes', '/uploads/error1.png', 6100, 4500, 4500, 14, 36, 'Jael Joel', 'active', 'kg', '1', '6400'),
(4, 'Eden Cline', '002_001_003', 'kg', 'gggg', '91', 'heaven yes', '/uploads/schedule.png', 7099, 4565, 4565, 0, 56, 'Jael Joel', 'active', 'kg', '1', '5000'),
(5, 'Georgia Frye', '002_001_004', 'kg', 'gggg', '97', 'heaven yes', '/uploads/error1.png', 7680, 5000, 5000, 14, 54, 'Jael Joel', 'pending', 'gm', '10', '8950');

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
(1, 'Leila Stokes', 'MM2', '2021-03-17', '11:27', 'Jael Joel', 'done', '76500', '12240', '88740'),
(2, 'Leila Stokes', 'MM2', '2021-03-22', '11:53', 'Jael Joel', 'done', '5100', '816', '5916'),
(3, 'Dolan Mendoza', 'MM2', '2021-04-06', '17:44', 'Jael Joel', 'partial', '500000', '80000', '580000'),
(4, 'Leila Stokes', 'MM2', '2021-04-28', '09:37', 'Jael Joel', 'partial', '27300', '4368', '31668');

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
(1, '1', '001_002_001', 'Kaden Dawson', 'kg', '15', '5100', '76500', 'done', 'MM2'),
(2, '2', '001_002_001', 'Kaden Dawson', 'kg', '1', '5100', '5100', 'done', 'MM2'),
(3, '3', '002_001_004', 'Georgia Frye', 'kg', '50', '10000', '500000', 'partial', 'MM2'),
(4, '4', '001_002_001', 'Kaden Dawson', 'kg', '3', '5100', '15300', 'partial', 'MM2'),
(5, '4', '002_001_004', 'Georgia Frye', 'kg', '2', '6000', '12000', 'partial', 'MM2');

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
(1, '1', 'Leila Stokes', '19', 'HHFG', '2021-03-17', '2021-04-05', 'GGDAF', '59160', 'approved', '51000', '8160', 'Jael Joel', '1'),
(2, '1', 'Leila Stokes', '19', 'HFYHBUV', '2021-03-18', '2021-04-06', 'ADDDSEC', '29580', 'approved', '25500', '4080', 'Jael Joel', '2'),
(3, '2', 'Leila Stokes', '19', 'GGGFGHYRUYJN', '2021-04-28', '2021-05-17', 'SDFSDGF', '5916', 'approved', '5100', '816', 'Jael Joel', '3'),
(4, '4', 'Leila Stokes', '19', 'HJFUYGUKJH', '2021-04-28', '2021-05-17', 'GGFG', '12876', 'approved', '11100', '1776', 'Jael Joel', '6'),
(5, '4', 'Leila Stokes', '19', 'HJFUYGUKJH', '2021-04-29', '2021-05-18', 'JKGIUU', '12876', 'approved', '11100', '1776', 'Jael Joel', '6'),
(6, '3', 'Dolan Mendoza', '24', 'HKGJYF7657', '2021-04-27', '2021-05-21', 'SDGER44', '232000', 'approved', '200000', '32000', 'Jael Joel', '4'),
(7, '3', 'Dolan Mendoza', '24', 'HJFJYG775876', '2021-04-27', '2021-05-21', 'SE454F', '116000', 'approved', '100000', '16000', 'Jael Joel', '5');

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
(1, '1', '1', '001_002_001', 'Kaden Dawson', 'kg', '10', '5100', '51000', 'pending', 'Jael Joel', '1', 'GGDAF'),
(2, '1', '1', '001_002_001', 'Kaden Dawson', 'kg', '10', '5100', '51000', 'pending', 'Jael Joel', '1', 'GGDAF'),
(3, '1', '1', '001_002_001', 'Kaden Dawson', 'kg', '10', '5100', '51000', 'pending', 'Jael Joel', '1', 'GGDAF'),
(4, '1', '1', '001_002_001', 'Kaden Dawson', 'kg', '10', '5100', '51000', 'pending', 'Jael Joel', '1', 'GGDAF'),
(5, '1', '1', '001_002_001', 'Kaden Dawson', 'kg', '10', '5100', '51000', 'pending', 'Jael Joel', '1', 'GGDAF'),
(6, '1', '1', '001_002_001', 'Kaden Dawson', 'kg', '10', '5100', '51000', 'pending', 'Jael Joel', '1', 'GGDAF'),
(7, '2', '1', '001_002_001', 'Kaden Dawson', 'kg', '5', '5100', '25500', 'pending', 'Jael Joel', '2', 'ADDDSEC'),
(8, '3', '2', '002_001_004', 'Georgia Frye', 'kg', '20', '10000', '200000', 'pending', 'Jael Joel', '3', 'SDFSDGF'),
(9, '3', '2', '001_002_001', 'Kaden Dawson', 'kg', '1', '5100', '5100', 'pending', 'Jael Joel', '3', 'SDFSDGF'),
(10, '3', '2', '001_002_001', 'Kaden Dawson', 'kg', '1', '5100', '5100', 'pending', 'Jael Joel', '3', 'SDFSDGF'),
(11, '4', '4', '001_002_001', 'Kaden Dawson', 'kg', '1', '5100', '5100', 'pending', 'Jael Joel', '6', 'GGFG'),
(12, '4', '4', '002_001_004', 'Georgia Frye', 'kg', '1', '6000', '6000', 'pending', 'Jael Joel', '6', 'GGFG'),
(13, '5', '4', '001_002_001', 'Kaden Dawson', 'kg', '1', '5100', '5100', 'pending', 'Jael Joel', '6', 'JKGIUU'),
(14, '5', '4', '002_001_004', 'Georgia Frye', 'kg', '1', '6000', '6000', 'pending', 'Jael Joel', '6', 'JKGIUU'),
(15, '6', '3', '002_001_004', 'Georgia Frye', 'kg', '20', '10000', '200000', 'pending', 'Jael Joel', '4', 'SDGER44'),
(16, '7', '3', '002_001_004', 'Georgia Frye', 'kg', '10', '10000', '100000', 'pending', 'Jael Joel', '5', 'SE454F');

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
(1, '2021-03-17', 'Whitney Walters', '28', '2021-03-25', '14:41', 'done', 'Jael Joel', '214776', '26376', '214776', 'MM2'),
(2, '2021-03-18', 'Whitney Walters', '28', '2021-03-26', '10:42', 'done', 'Jael Joel', '14158.8', '1738.8', '14158.8', 'MM2');

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
  `branch_location` varchar(100) NOT NULL,
  `conversion` varchar(100) NOT NULL,
  `atm_price` varchar(100) NOT NULL,
  `entered_price` varchar(100) NOT NULL,
  `selected_unit` varchar(100) NOT NULL,
  `atm_unit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_quotation_items`
--

INSERT INTO `tbl_quotation_items` (`quote_no`, `product_code`, `product_name`, `unit`, `price`, `qty`, `amount`, `tax`, `status`, `tax_pc`, `branch_location`, `conversion`, `atm_price`, `entered_price`, `selected_unit`, `atm_unit`) VALUES
(1, '001_002_001', 'Kaden Dawson', 'kg', '6000', '100', '684000', '84000', 'done', '14', 'MM2', '', '', '', '', ''),
(1, '002_001_001', 'Marsden Myers', 'kg', '6420', '100', '731880', '89880', 'done', '14', 'MM2', '', '', '', '', ''),
(2, '001_002_001', 'Kaden Dawson', 'kg', '6000', '1', '6840.00', '840.00', 'done', '14', 'MM2', '', '', '', '', ''),
(2, '002_001_001', 'Marsden Myers', 'kg', '6420', '1', '7318.80', '898.80', 'done', '14', 'MM2', '', '', '', '', '');

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
(1, 'Whitney Walters', '2021-03-19', '16424.21', '16424.21', '0', 'done', 'Jael Joel'),
(2, 'Whitney Walters', '2021-04-29', '41893.63', '41171.32603448276', '722.3039655172414', 'done', 'Jael Joel');

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
(1, 1, '2021-04-16', '1', '16424.21', '0', '16424.21', 'Whitney Walters', '2021-03-19', 'done', 'Jael Joel'),
(2, 2, '2021-05-26', '2', '41893.63', '722.30396551724', '41171.326034483', 'Whitney Walters', '2021-04-29', 'done', 'Jael Joel');

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
(1, 'Leila Stokes', '2021-03-17', '88740', '87210', '1530.0000000000002', 'done', 'Jael Joel'),
(2, 'Leila Stokes', '2021-04-28', '31668', '31122', '546', 'done', 'Jael Joel'),
(3, 'Dolan Mendoza', '2021-04-28', '232000', '228000.00000000003', '4000.0000000000005', 'done', 'Jael Joel'),
(4, 'Dolan Mendoza', '2021-04-28', '116000', '114000.00000000001', '2000.0000000000002', 'done', 'Jael Joel');

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
(1, 1, '2021-04-05', 'GGDAF', '59160', '1020', '58140', 'Leila Stokes', '2021-03-17', 'done', 'Jael Joel'),
(2, 1, '2021-04-06', 'ADDDSEC', '29580', '510', '29070', 'Leila Stokes', '2021-03-17', 'done', 'Jael Joel'),
(3, 2, '2021-05-17', 'SDFSDGF', '5916', '102', '5814', 'Leila Stokes', '2021-04-28', 'done', 'Jael Joel'),
(4, 2, '2021-05-17', 'GGFG', '12876', '222', '12654', 'Leila Stokes', '2021-04-28', 'done', 'Jael Joel'),
(5, 2, '2021-05-18', 'JKGIUU', '12876', '222', '12654', 'Leila Stokes', '2021-04-28', 'done', 'Jael Joel'),
(6, 3, '2021-05-21', 'SDGER44', '232000', '4000', '228000', 'Dolan Mendoza', '2021-04-28', 'done', 'Jael Joel'),
(7, 4, '2021-05-21', 'SE454F', '116000', '2000', '114000', 'Dolan Mendoza', '2021-04-28', 'done', 'Jael Joel');

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
(1, '2021-03-17', '10:39', 'Jael Joel', 'MM2', 'done'),
(2, '2021-03-22', '11:48', 'Jael Joel', 'MM2', 'done'),
(3, '2021-04-06', '17:36', 'Jael Joel', 'MM2', 'done'),
(4, '2021-04-28', '09:33', 'Jael Joel', 'MM2', 'done');

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
(1, '1', '001_002_001', 'Kaden Dawson', 'kg', '15', 'done', 'MM2', '1'),
(2, '2', '001_002_001', 'Kaden Dawson', 'kg', '1', 'done', 'MM2', '13'),
(3, '3', '002_001_004', 'Georgia Frye', 'kg', '50', 'done', 'MM2', '230'),
(4, '4', '002_001_004', 'Georgia Frye', 'kg', '2', 'done', 'MM2', '260'),
(5, '4', '001_002_001', 'Kaden Dawson', 'kg', '3', 'done', 'MM2', '19');

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
(1, '2021-04-28', 'Whitney Walters', '28', 'done', 'Jael Joel', '36,115.20', '4,435.20', '31,680.00', 'MM2');

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
  `branch_location` varchar(100) NOT NULL,
  `conversion` varchar(10) NOT NULL,
  `atm_price` varchar(100) NOT NULL,
  `entered_price` varchar(100) NOT NULL,
  `selected_unit` varchar(100) NOT NULL,
  `atm_unit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sale_items`
--

INSERT INTO `tbl_sale_items` (`quote_no`, `product_code`, `product_name`, `unit`, `price`, `qty`, `amount`, `tax`, `status`, `tax_pc`, `branch_location`, `conversion`, `atm_price`, `entered_price`, `selected_unit`, `atm_unit`) VALUES
(1, '001_002_001', 'Kaden Dawson', 'kg', '6907', '0.4', '27360.00', '3360.00', 'done', '14', 'MM2', '10', '6000', '6000', 'atomic_unit', 'gm'),
(1, '002_001_004', 'Georgia Frye', 'kg', '8950', '0.1', '8755.20', '1075.20', 'done', '14', 'MM2', '10', '7680', '7680', 'atomic_unit', 'gm');

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
  `employ_date` date NOT NULL,
  `begin_date` date NOT NULL,
  `duration` varchar(16) NOT NULL,
  `end_date` date NOT NULL,
  `job_title` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `report_to` varchar(50) NOT NULL,
  `branch` varchar(50) NOT NULL,
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
  `status` varchar(15) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tbl_staff`
--

INSERT INTO `tbl_staff` (`f_name`, `m_name`, `l_name`, `gender`, `dob`, `passport`, `nat_id`, `pin_no`, `res`, `nssf_no`, `nhif_no`, `off_mail`, `pers_mail`, `country`, `mobile_no`, `phone_no`, `ext_no`, `city`, `county`, `postal_code`, `job_no`, `employ_date`, `begin_date`, `duration`, `end_date`, `job_title`, `department`, `report_to`, `branch`, `head_of`, `region`, `currency`, `shift`, `employ_type`, `off_days`, `pay_type`, `salary`, `income_tax`, `deduct_nhif`, `deduct_nssf`, `account_name`, `account_no`, `bank_name`, `sort_code`, `s_mobile_no`, `s_bank_branch`, `s_payment`, `status`) VALUES
('Geoffrey', 'Kirby Carrillo', 'Levine', 'Male', '1973-11-03', '/uploads/kua uone.png', '42', '31', 'Resident', '15', '69', 'jaqylorafo@mailinator.com', 'xakyx@mailinator.com', 'Jamaica', '39', '95', '94', 'Nihil reiciendis rep', 'Officia tempor elit', '52841', '272', '1979-02-06', '2021-04-06', 'Aliquip non accu', '2023-02-06', 'Repudiandae veniam', 'Reprehenderit et ul', 'all', 'undefined', 'all', 'Nairobi', 'KES', 'Regular', '1979-02-06', 'FRIDAY', 'net', '40000', 'primary', 'true', 'true', '', '', '', '', '469', '', 0, 'approved'),
('Aquila', 'Doris Hartman', 'Rios', 'Male', '2004-08-31', '/uploads/kua uone (1).png', '58', '73', 'Resident', '10', '32', 'zenehoc@mailinator.com', 'sufafu@mailinator.com', 'Philippines', '4', '46', '59', 'Sunt voluptatem duis', 'Accusamus in proiden', '97654', '580', '1975-12-04', '2017-10-10', 'Quaerat tempore ', '2014-02-22', 'Quis necessitatibus', 'Ullam at est corpori', 'all', 'undefined', 'all', 'Nairobi', 'JPY', 'Regular', '1975-12-04', 'WEDNESDAY', 'consolidated', '12', 'none', 'true', 'true', '', '', '', '', '', '', 0, 'pending');

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
(1, 'Animi non qui quia', '+1 (419) 354-9206', '+1 (419) 354-9206', 'Enim officiis ex qui'),
(2, 'Vitae dolorum facili', '+1 (339) 995-1394', '+1 (339) 995-1394', 'Cupiditate obcaecati'),
(3, 'Qui ab rerum earum l', '+1 (423) 546-2199', '+1 (423) 546-2199', 'Nulla dolores sed sa'),
(4, 'Dolore pariatur Ear', '+1 (844) 283-5693', '+1 (844) 283-5693', 'Nesciunt eiusmod de');

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

--
-- Dumping data for table `tbl_store`
--

INSERT INTO `tbl_store` (`date`, `time`, `branch`, `user`, `supplier_name`, `receipt_no`, `lpo_number`, `status`, `invoice_no`) VALUES
('2021-03-17', '11:40', 'MM2', 'Jael Joel', 'Leila Stokes', 1, '1', 'done', 'HHFG'),
('2021-03-17', '11:48', 'MM2', 'Jael Joel', 'Leila Stokes', 2, '1', 'done', 'HFYHBUV'),
('2021-03-22', '11:54', 'MM2', 'Jael Joel', 'Leila Stokes', 3, '2', 'done', 'GGGFGHYRUYJN'),
('2021-04-06', '17:47', 'MM2', 'Jael Joel', 'Dolan Mendoza', 4, '3', 'done', 'HKGJYF7657'),
('2021-04-06', '17:48', 'MM2', 'Jael Joel', 'Dolan Mendoza', 5, '3', 'done', 'HJFJYG775876'),
('2021-04-28', '09:37', 'MM2', 'Jael Joel', 'Leila Stokes', 6, '4', 'done', 'HJFUYGUKJH');

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
('10', 'Kaden Dawson', '001-002-001', 'MM1', 'opening_bal', 1, 'opening_bal', 'kg', 'done'),
('1', 'Kaden Dawson', '001-002-001', 'MM2', 'opening_bal', 2, 'opening_bal', 'kg', 'done'),
('10', 'Kaden Dawson', '001_002_001', 'MM2', '1', 3, '1', 'kg', 'done'),
('5', 'Kaden Dawson', '001_002_001', 'MM2', '2', 4, '1', 'kg', 'done'),
('1', 'Marsden Myers', '002_001_001', 'MM1', 'opening_bal', 5, 'opening_bal', 'kg', 'done'),
('1', 'Kaden Dawson', '001_002_001', 'MM2', '3', 6, '2', 'kg', 'done'),
('123', 'Sierra Gutierrez', '002_001_002', 'MM1', 'opening_bal', 7, 'opening_bal', '', 'done'),
('203', 'Sierra Gutierrez', '002_001_002', 'MM2', 'opening_bal', 8, 'opening_bal', '', 'done'),
('130', 'Eden Cline', '002_001_003', 'MM1', 'opening_bal', 9, 'opening_bal', 'kg', 'done'),
('180', 'Georgia Frye', '002_001_004', 'MM1', 'opening_bal', 10, 'opening_bal', 'kg', 'done'),
('230', 'Georgia Frye', '002_001_004', 'MM2', 'opening_bal', 11, 'opening_bal', 'kg', 'done'),
('20', 'Georgia Frye', '002_001_004', 'MM2', '4', 12, '3', 'kg', 'done'),
('10', 'Georgia Frye', '002_001_004', 'MM2', '5', 13, '3', 'kg', 'done'),
('1', 'Kaden Dawson', '001_002_001', 'MM2', '6', 14, '4', 'kg', 'done'),
('1', 'Georgia Frye', '002_001_004', 'MM2', '6', 15, '4', 'kg', 'done');

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
(1, 'swara', 'CEMENT', '001-001'),
(2, 'funky', 'CEMENT', '001-002'),
(3, 'heaven yes', 'gggg', '002_001'),
(4, 'hdhhd', 'haha', '005_001');

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
  `status` varchar(100) NOT NULL DEFAULT 'pending'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `name`, `email`, `tel_no`, `postal_address`, `physical_address`, `tax_id`, `payment_terms`, `number_of_days`, `status`) VALUES
(1, 'Leila Stokes', 'pinaki@mailinator.com', '+1 (813) 909-5333', 'Minim rerum dolores ', 'Animi est nostrud q', 'Id debitis voluptat', '19', '30', 'pending'),
(2, 'Kuame Johns', 'myjykyw@mailinator.com', '+1 (803) 798-8085', 'Atque accusamus inci', 'Voluptatibus volupta', 'Quo perferendis recu', '30', '30', 'pending'),
(3, 'Dolan Mendoza', 'medokitizu@mailinator.com', '+1 (785) 947-5304', 'Ipsa incididunt in ', 'Distinctio In ea an', 'Veniam in consequat', '24', '30', 'pending');

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
(1, '2021-03-19', '11:45', 'Jael Joel', 'MM2', 'pending', 'noted'),
(2, '2021-04-20', '10:09', 'James Kevin', 'MM1', 'pending', 'noted');

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
(1, '1', '001_002_001', 'Kaden Dawson', 'kg', '9', 'pending', 'MM2', '4', 'noted'),
(2, '2', '002_001_003', 'Eden Cline', 'kg', '1', 'pending', 'MM1', '130', 'noted');

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
(1, 'KG', 'Kilogenes'),
(2, 'gm', 'grams');

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voucher`
--

CREATE TABLE `tbl_voucher` (
  `voucher_type` varchar(20) NOT NULL,
  `voucher_no` varchar(100) NOT NULL,
  `debit` varchar(30) NOT NULL,
  `credit` varchar(30) NOT NULL,
  `remarks` text NOT NULL,
  `date` date NOT NULL,
  `id` int(11) NOT NULL,
  `branch` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_voucher`
--

INSERT INTO `tbl_voucher` (`voucher_type`, `voucher_no`, `debit`, `credit`, `remarks`, `date`, `id`, `branch`) VALUES
('Credit', 'CN-008', '1', '1', 'Id mollit ex lorem n', '2017-12-28', 35, ''),
('Credit', 'CN-003', '1', '1', 'Id mollit ex lorem n', '2017-12-28', 36, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_voucher_items`
--

CREATE TABLE `tbl_voucher_items` (
  `voucher_no` varchar(100) NOT NULL,
  `ledger` varchar(50) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `id` int(100) NOT NULL,
  `date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_voucher_items`
--

INSERT INTO `tbl_voucher_items` (`voucher_no`, `ledger`, `amount`, `type`, `id`, `date`) VALUES
('CN-007', 'Meeee', '1', 'Debit', 67, '2017-12-28'),
('CN-008', 'Meeee', '1', 'Debit', 69, '2017-12-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `supplier_product`
--
ALTER TABLE `supplier_product`
  ADD PRIMARY KEY (`product_name`,`supplier_name`);

--
-- Indexes for table `tbl_asset`
--
ALTER TABLE `tbl_asset`
  ADD PRIMARY KEY (`number`);

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
-- Indexes for table `tbl_chart_account_details`
--
ALTER TABLE `tbl_chart_account_details`
  ADD PRIMARY KEY (`number`);

--
-- Indexes for table `tbl_chart_parent_child`
--
ALTER TABLE `tbl_chart_parent_child`
  ADD PRIMARY KEY (`child_number`),
  ADD KEY `parent_number` (`parent_number`);

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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_emp_benefit`
--
ALTER TABLE `tbl_emp_benefit`
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
-- Indexes for table `tbl_ledger`
--
ALTER TABLE `tbl_ledger`
  ADD PRIMARY KEY (`ledger_name`),
  ADD KEY `group_code` (`group_code`);

--
-- Indexes for table `tbl_ledger_amounts`
--
ALTER TABLE `tbl_ledger_amounts`
  ADD PRIMARY KEY (`group_code`,`ledger`,`amount`,`date`,`status`);

--
-- Indexes for table `tbl_muster`
--
ALTER TABLE `tbl_muster`
  ADD PRIMARY KEY (`must_year`,`must_month`,`emp_no`);

--
-- Indexes for table `tbl_nhif`
--
ALTER TABLE `tbl_nhif`
  ADD PRIMARY KEY (`id`,`fromnhif`,`tonhif`,`rate`,`descnhif`);

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
  ADD PRIMARY KEY (`id`,`fromnhif`,`tonhif`,`rate`,`descnhif`);

--
-- Indexes for table `tbl_prdmapping`
--
ALTER TABLE `tbl_prdmapping`
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
-- Indexes for table `tbl_voucher`
--
ALTER TABLE `tbl_voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_voucher_items`
--
ALTER TABLE `tbl_voucher_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voucher_no` (`voucher_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_companyloans`
--
ALTER TABLE `tbl_companyloans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_emp_benefit`
--
ALTER TABLE `tbl_emp_benefit`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `salesbill_no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_invoice_items`
--
ALTER TABLE `tbl_invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_leavecat`
--
ALTER TABLE `tbl_leavecat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_nhif`
--
ALTER TABLE `tbl_nhif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_paye`
--
ALTER TABLE `tbl_paye`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_prdmapping`
--
ALTER TABLE `tbl_prdmapping`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_purchaseorder`
--
ALTER TABLE `tbl_purchaseorder`
  MODIFY `po_number` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_purchaseorder_items`
--
ALTER TABLE `tbl_purchaseorder_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_purchase_bill`
--
ALTER TABLE `tbl_purchase_bill`
  MODIFY `purchasebill_no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_purchase_bill_items`
--
ALTER TABLE `tbl_purchase_bill_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_quotation`
--
ALTER TABLE `tbl_quotation`
  MODIFY `quote_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `rem_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_remittance_items`
--
ALTER TABLE `tbl_remittance_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_requisition`
--
ALTER TABLE `tbl_requisition`
  MODIFY `requisition_No` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_requisition_items`
--
ALTER TABLE `tbl_requisition_items`
  MODIFY `id` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  MODIFY `quote_no` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  MODIFY `shift_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_staff_items`
--
ALTER TABLE `tbl_staff_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_store`
--
ALTER TABLE `tbl_store`
  MODIFY `receipt_no` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_store_item`
--
ALTER TABLE `tbl_store_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_transfer`
--
ALTER TABLE `tbl_transfer`
  MODIFY `transfer_no` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_transfer_items`
--
ALTER TABLE `tbl_transfer_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `unit_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_voucher`
--
ALTER TABLE `tbl_voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_voucher_items`
--
ALTER TABLE `tbl_voucher_items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_chart_parent_child`
--
ALTER TABLE `tbl_chart_parent_child`
  ADD CONSTRAINT `tbl_chart_parent_child_ibfk_1` FOREIGN KEY (`child_number`) REFERENCES `tbl_chart_account_details` (`number`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_chart_parent_child_ibfk_2` FOREIGN KEY (`parent_number`) REFERENCES `tbl_chart_account_details` (`number`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_ledger`
--
ALTER TABLE `tbl_ledger`
  ADD CONSTRAINT `tbl_ledger_ibfk_1` FOREIGN KEY (`group_code`) REFERENCES `tbl_chart_account_details` (`number`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
