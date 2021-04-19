<?php
session_start();
include_once '../../includes/dbconnect.php';

$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// $query = "SELECT * FROM tbl_"

echo "Hello world!";

$con->close();

// =====================================================================
// SQL STATEMENTS TO CREATE REQURIED TABLES
// =====================================================================
// --
// -- Table structure for table `tbl_chart_account_details`
// --

// CREATE TABLE `tbl_chart_account_details` (
// `number` varchar(10) NOT NULL,
// `title` varchar(200) NOT NULL,
// `type` enum('debit','credit') NOT NULL DEFAULT 'debit'
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

// -- --------------------------------------------------------

// --
// -- Table structure for table `tbl_chart_parent_child`
// --

// CREATE TABLE `tbl_chart_parent_child` (
// `child_number` varchar(10) NOT NULL,
// `parent_number` varchar(10) NOT NULL
// ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

// --
// -- Indexes for dumped tables
// --

// --
// -- Indexes for table `tbl_chart_account_details`
// --
// ALTER TABLE `tbl_chart_account_details`
// ADD PRIMARY KEY (`number`);

// --
// -- Indexes for table `tbl_chart_parent_child`
// --
// ALTER TABLE `tbl_chart_parent_child`
// ADD PRIMARY KEY (`child_number`),
// ADD UNIQUE KEY `parent_number` (`parent_number`);

// --
// -- Constraints for dumped tables
// --

// --
// -- Constraints for table `tbl_chart_parent_child`
// --
// ALTER TABLE `tbl_chart_parent_child`
// ADD CONSTRAINT `tbl_chart_parent_child_ibfk_1` FOREIGN KEY (`child_number`) REFERENCES `tbl_chart_account_details` (`number`) ON DELETE CASCADE ON UPDATE CASCADE,
// ADD CONSTRAINT `tbl_chart_parent_child_ibfk_2` FOREIGN KEY (`parent_number`) REFERENCES `tbl_chart_account_details` (`number`) ON DELETE CASCADE ON UPDATE CASCADE;
// COMMIT;



/*
 * ALTER TABLE `tbl_chart_parent_child` ADD FOREIGN KEY (`child_number`) REFERENCES `tbl_chart_account_details`(`number`) ON DELETE CASCADE ON UPDATE CASCADE;
 * ALTER TABLE `tbl_chart_parent_child` ADD FOREIGN KEY (`parent_number`) REFERENCES `tbl_chart_account_details`(`number`) ON DELETE CASCADE ON UPDATE CASCADE;
 *
 */

// =====================================================================
// END
// =====================================================================
