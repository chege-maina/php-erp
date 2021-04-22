<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();
// O Sensei...

$query = "SELECT * FROM `tbl_chart_parent_child` as `pc` INNER JOIN `tbl_chart_account_details` as `ad` ON `ad`.`number`=`pc`.`child_number` WHERE `pc`.`parent_number`='010000'";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {

  array_push(
    $response,
    array(
      'code' => $row['number'],
      'name' => $row['title']
    )
  );
}
echo json_encode($response);

mysqli_close($conn);
