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
    $data_array[] = $row;
  }
} else {
  echo "0 results";
}

// 2. Now get root parents that have no children at all
$parent_query = "SELECT * FROM `tbl_chart_account_details` AS `ad` LEFT JOIN `tbl_chart_parent_child` as `pc` ON `ad`.`number`= `pc`.`child_number` OR `ad`.`number`=`pc`.`parent_number` WHERE `pc`.`child_number`IS NULL AND `pc`.`parent_number` IS NULL;";

$result = $conn->query($parent_query);

if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $data = array(
      "parent_number" => $row["number"],
      "parent_title" => $row["title"],
      "parent_type" => $row["type"],
      "parent_carrying_forward" => $row["carrying_forward"],
      "child_number" => "null",
      "child_title" => "null",
      "child_type" => "null",
      "child_carrying_forward" => "null"

    );
    $data_array[] = $data;
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
