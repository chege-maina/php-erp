-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2021 at 10:39 AM
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
-- Table structure for table `tbl_branch`
--

CREATE TABLE `tbl_branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `branch_location` varchar(100) NOT NULL,
  `contact_person` varchar(100) NOT NULL,
  `telephone_no` int(100) NOT NULL
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
(2, 'CEMENT'),
(1, 'METAL BARS');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone_no` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `customer_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `product_supplier` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_code`, `product_name`, `product_unit`, `product_category`, `min_level`, `max_level`, `reorder`, `product_image`, `dsp_price`, `amount_before_tax`, `dpp_inc_tax`, `applicable_tax`, `profit_margin`, `product_supplier`, `user`) VALUES
(1, 'TANK', 'Piece', 'tanks', '12', '13', '13', 'weretrtet.png', 0, 0, 0, 0, 0, '', ''),
(2, 'TARAJI', 'PIECES', 'PENCIL', '9', '17', '33', 'OIP.jpg', 3000, 0, 0, 0, 0, '', ''),
(3, 'CHANK', 'asd,jbhkj', 'TANK', '667', '667', '76', '/assets/img/item-images/php.png', 0, 0, 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requisition`
--

CREATE TABLE `tbl_requisition` (
  `requisition_No` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `branch` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_requisition_items`
--

CREATE TABLE `tbl_requisition_items` (
  `id` int(11) NOT NULL,
  `requisition_No` bigint(100) NOT NULL,
  `prroduct_code` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_unit` varchar(10) NOT NULL,
  `product_quantity` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale`
--

CREATE TABLE `tbl_sale` (
  `sales_invoice_no` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(15) NOT NULL,
  `cashier` varchar(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sale_items`
--

CREATE TABLE `tbl_sale_items` (
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `sales_invoice_no` varchar(100) NOT NULL,
  `branch_location` varchar(50) NOT NULL,
  `id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_sale_items`
--

INSERT INTO `tbl_sale_items` (`product_code`, `product_name`, `qty`, `sales_invoice_no`, `branch_location`, `id`) VALUES
('1', 'TANK', '50', '12345', 'MAISHA STEEL 1', 1),
('2', 'TARAJI', '20', '2344555', 'OLA', 2),
('3', 'CHANK', '50', '09983', 'MAISHE STEEL 2', 3),
('2', 'TARAJI', '10', '768644', 'OLA', 4),
('2', 'TARAJI', '3', '758655', 'OLA', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store`
--

CREATE TABLE `tbl_store` (
  `date` date NOT NULL,
  `time` varchar(10) NOT NULL,
  `branch_location` varchar(100) NOT NULL,
  `warehouse_manager` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `store_invoice_no` varchar(100) NOT NULL,
  `receipt_no` bigint(100) NOT NULL,
  `lpo_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_store_item`
--

CREATE TABLE `tbl_store_item` (
  `qty` varchar(50) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_code` varchar(100) NOT NULL,
  `branch_location` varchar(50) NOT NULL,
  `receipt_no` varchar(100) NOT NULL,
  `id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_store_item`
--

INSERT INTO `tbl_store_item` (`qty`, `product_name`, `product_code`, `branch_location`, `receipt_no`, `id`) VALUES
('100', 'TANK', '1', 'MAISHA STEEL 1', '34565', 1),
('30', 'TARAJI', '2', 'OLA', '25365', 2),
('100', 'CHANK', '3', 'MAISHA STEEL 2', '977557', 3),
('33', 'TARAJI', '2', 'OLA', '997898', 4),
('3', 'TARAJI', '2', 'OLA', '32552', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE `tbl_supplier` (
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone_no` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `supplier_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`name`, `email`, `telephone_no`, `address`, `supplier_id`) VALUES
('SIMBA CEMENT', 'simba@mabati.com', '+254783467854', '20100-45', '120934567'),
('DEVKI', 'devki@steel.com', '+254756432168', '10010-69', '238495968');

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
(1, 'KGS', 'KILOGRAMS'),
(2, 'BGS', 'BAGS'),
(3, 'PCS', 'PIECES'),
(4, 'LTRS', 'LITRES');

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
('dir@maisha.com', '$2y$10$Jisk2Nl0cHrTa0id8f2kIeQ9My1mruHswrJwj3J1tMenC538wbPCa', 'director', 'mm2', 'Kesav', 'Kesav', 'ON', 'ON'),
('procurement.maishasteel@gmail.com', 'procurement123', 'procurement', 'main', 'James', 'Kevin', 'ON', 'OFF'),
('storemanager.maishasteel@gmail.com', 'storemanager123', 'store manager', 'mm1', 'Jael', 'Joel', 'OFF', 'ON');

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_code`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `supplier_id` (`product_supplier`);

--
-- Indexes for table `tbl_requisition`
--
ALTER TABLE `tbl_requisition`
  ADD PRIMARY KEY (`requisition_No`);

--
-- Indexes for table `tbl_requisition_items`
--
ALTER TABLE `tbl_requisition_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `requisition_No` (`requisition_No`);

--
-- Indexes for table `tbl_sale`
--
ALTER TABLE `tbl_sale`
  ADD PRIMARY KEY (`sales_invoice_no`),
  ADD UNIQUE KEY `customer_name` (`customer_name`);

--
-- Indexes for table `tbl_sale_items`
--
ALTER TABLE `tbl_sale_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_invoice_no` (`sales_invoice_no`);

--
-- Indexes for table `tbl_store`
--
ALTER TABLE `tbl_store`
  ADD PRIMARY KEY (`receipt_no`);

--
-- Indexes for table `tbl_store_item`
--
ALTER TABLE `tbl_store_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `receipt_no` (`receipt_no`);

--
-- Indexes for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_tax`
--
ALTER TABLE `tbl_tax`
  ADD PRIMARY KEY (`col_tax`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_branch`
--
ALTER TABLE `tbl_branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_code` bigint(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_requisition`
--
ALTER TABLE `tbl_requisition`
  MODIFY `requisition_No` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_requisition_items`
--
ALTER TABLE `tbl_requisition_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_sale_items`
--
ALTER TABLE `tbl_sale_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_store`
--
ALTER TABLE `tbl_store`
  MODIFY `receipt_no` bigint(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_store_item`
--
ALTER TABLE `tbl_store_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `unit_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;