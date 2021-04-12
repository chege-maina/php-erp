<?php
include_once '../includes/dbconnect.php';
session_start();

$query = "SELECT name FROM tbl_leavecat";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'branch' => $row['name'],
    )
  );
}
echo json_encode($response);

mysqli_close($conn);
