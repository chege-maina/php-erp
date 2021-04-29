<?php
include_once '../includes/dbconnect.php';
session_start();

$query = "SELECT ledger_name FROM tbl_ledger";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'ledger_name' => $row['ledger_name'],
      'group_id' => $row['group_code']
    )
  );
}
echo json_encode($response);

mysqli_close($conn);
