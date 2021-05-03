<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';

$query = "SELECT * FROM tbl_nhif";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'From' => $row['fromnhif'],
      'To' => $row['tonhif'],
      'Rate' => $row['rate'],
      'Description' => $row['descnhif']
    )
  );
}
echo json_encode($response);

mysqli_close($conn);
