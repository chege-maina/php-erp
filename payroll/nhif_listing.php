<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';

$query = "SELECT * FROM tbl_nhif GROUP BY descnhif";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'Description' => $row['descnhif'],
      'Status' => $row['status'],
    )
  );
}
echo json_encode($response);

mysqli_close($conn);
