<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';
session_start();


$query = "SELECT * FROM tbl_shift";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {

  array_push(
    $response,
    array(
      'name' => $row['shift_name'],
    )
  );
}

echo json_encode($response);

mysqli_close($conn);
