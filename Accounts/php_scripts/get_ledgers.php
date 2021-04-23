<?php
session_start();
include_once '../../includes/dbconnect.php';

$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$query = "SELECT `tl`.*, `ca`.`title` as group_title FROM `tbl_ledger` as `tl` INNER JOIN `tbl_chart_account_details` AS `ca` ON `ca`.`number` = `tl`.`group_code` ORDER BY `ca`.`title` ASC;";
$result = $conn->query($query);

$data_array = array();
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $data_array[] = $row;
  }
}

echo json_encode($data_array);

$con->close();


// =====================================================================
// Utility SQL
// =====================================================================
/*
 * ALTER TABLE `tbl_chart_parent_child` ADD FOREIGN KEY (`child_number`) REFERENCES `tbl_chart_account_details`(`number`) ON DELETE CASCADE ON UPDATE CASCADE;
 * ALTER TABLE `tbl_chart_parent_child` ADD FOREIGN KEY (`parent_number`) REFERENCES `tbl_chart_account_details`(`number`) ON DELETE CASCADE ON UPDATE CASCADE;
 */

// =====================================================================
// END
// =====================================================================
