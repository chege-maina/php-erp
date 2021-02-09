-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2021 at 10:24 AM
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
-- Table structure for table `tbl_purchaseorder`
--

CREATE TABLE `tbl_purchaseorder` (
  `po_number` bigint(20) NOT NULL,
  `supplier_name` varchar(50) NOT NULL,
  `supplier_id` varchar(50) NOT NULL,
  `branch` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(20) NOT NULL,
  `user` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'pending'
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
  `status` varchar(10) NOT NULL DEFAULT 'pending'
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
('1', 'TANK', '50', '12345', 'MM1', 1),
('2', 'TARAJI', '20', '2344555', 'MM2', 2),
('3', 'CHANK', '50', '09983', 'MM1', 3),
('2', 'TARAJI', '10', '768644', 'MM2', 4),
('2', 'TARAJI', '3', '758655', 'MM2', 5),
('2', 'TARAJI', '20', '35345', 'MM1', 6);

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
('100', 'TANK', '1', 'MM1', '34565', 1),
('30', 'TARAJI', '2', 'MM2', '25365', 2),
('100', 'CHANK', '3', 'MM1', '977557', 3),
('33', 'TARAJI', '2', 'MM2', '997898', 4),
('3', 'TARAJI', '2', 'MM2', '32552', 5),
('50', 'TARAJI', '2', 'MM1', '456346', 6);

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
  `credit_limit` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`supplier_id`, `name`, `email`, `tel_no`, `postal_address`, `physical_address`, `tax_id`, `credit_limit`) VALUES
(1, 'Bruce Tom', 'tom@gmail.com', '0745673456', '1656 Edsel Road\r\nSherman Oaks, CA 91403', '', '3463', '234355'),
(5, 'Clara Gilliam', 'clara@gmail.com', '0745678723', '63 Woodridge Lane\r\nMemphis, TN 38138', '', '34645', '56465'),
(6, 'Fredrick Jaji', 'fredrickjaji@hotmail.com', '0710334287', 'Nairobi', '', '6u5u85', '3463'),
(7, 'Antonio J. Forbes', 'anto@gmail.com', '9867454657', '403 Snyder Avenue\r\nCharlotte, NC 28208', '', '34645', '34645'),
(8, 'Charles D. Horst', 'Charlse@gmail.com', '098754445', '1636 Walnut Hill Drive\r\nCincinnati, OH 45202', '', 'e6654e', '34645'),
(238, 'Pius Wairimu', 'pius@gmail.com', '5097945790', 'PO BOX 85532-80100', '', '214533', '5667788'),
(224, 'Jael Joy', 'jaji@newageassociates.co.ke', ' 10710334287', 'Nairobi', '', 'AO123247o9', '1,000,000');

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
('dir@maisha.com', '$2y$10$Jisk2Nl0cHrTa0id8f2kIeQ9My1mruHswrJwj3J1tMenC538wbPCa', 'Director', 'MM1', 'Kesav', 'Kesav', 'ON', 'ON'),
('pro@maisha.com', '$2y$10$6k7MhrmNzez4yVGYfv7puuj3sBd9Ruq.h4F5iSI9o13fx/jojQx.y', 'Procurement officer', 'MM1', 'James', 'Kevin', 'ON', 'OFF'),
('war2@maisha.com', '$2y$10$fZRa.4ynKAjy6utKTzpP0ew09leLuE2ZgyN.kpUt3T2/kAhOJz5Vu', 'Warehouse manager', 'MM1', 'Monica', 'Njeri', 'ON', 'OFF'),
('war@maisha.com', '$2y$10$6cjuL5jaX3lBxr8NpKZ5VunRdrSUoHGU7bEuFHGDZ4Jrzhp/5DS8u', 'Warehouse manager', 'MM2', 'Jael', 'Joel', 'OFF', 'ON');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `supplier_product`
--
ALTER TABLE `supplier_product`
  ADD PRIMARY KEY (`product_name`,`supplier_name`);

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
-- AUTO_INCREMENT for table `tbl_sale_items`
--
ALTER TABLE `tbl_sale_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_store`
--
ALTER TABLE `tbl_store`
  MODIFY `receipt_no` bigint(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_store_item`
--
ALTER TABLE `tbl_store_item`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_supplier`
--
ALTER TABLE `tbl_supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;

--
-- AUTO_INCREMENT for table `tbl_unit`
--
ALTER TABLE `tbl_unit`
  MODIFY `unit_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
