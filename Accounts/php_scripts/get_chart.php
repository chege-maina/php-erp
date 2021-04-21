<?php
session_start();
include_once '../../includes/dbconnect.php';

$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$query = "SELECT tbl_chart_parent_child.*,c.title AS child_title, c.type AS child_type, c.carrying_forward as child_carrying_forward, p.title AS parent_title, p.type AS parent_type, p.carrying_forward as parent_carrying_forward FROM tbl_chart_parent_child INNER JOIN tbl_chart_account_details AS c ON c.number = tbl_chart_parent_child.child_number INNER JOIN tbl_chart_account_details AS p ON p.number = tbl_chart_parent_child.parent_number;";
$result = $conn->query($query);

$data_array;
if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $data;
    foreach ($row as $key => $value) {
      $data[$key] = $value;
    }
    $data_array[] = $row;
  }
} else {
  echo "0 results";
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
