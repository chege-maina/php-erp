-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 21, 2021 at 06:51 AM
-- Server version: 10.5.8-MariaDB-1:10.5.8+maria~focal
-- PHP Version: 7.4.16

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
('010100', 'Cash And Financial Assets', 'debit', 0),
('010101', 'Jane Doe', 'debit', 0),
('010102', 'Financial Assets (Investments)', 'debit', 0),
('010103', 'Restricted Cash and Financial Assets', 'debit', 0),
('010104', 'Additional Financial Assets and Investments', 'debit', 0),
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
('070303', 'Income (Loss) From Equity Method Investments', 'credit', 0);

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
('010101', '010100'),
('010102', '010100'),
('010103', '010100'),
('010104', '010100'),
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
('020400', '020000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ledger`
--

CREATE TABLE `tbl_ledger` (
  `ledger_name` varchar(200) NOT NULL,
  `group_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `tbl_ledger`
--
ALTER TABLE `tbl_ledger`
  ADD PRIMARY KEY (`ledger_name`),
  ADD KEY `group_code` (`group_code`);

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
