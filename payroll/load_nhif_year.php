<?php
include_once '../includes/dbconnect.php';
session_start();

$query = "SELECT descnhif FROM tbl_nhif GROUP BY descnhif";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push(
    $response,
    array(
      'year' => $row['descnhif'],
    )
  );
}
echo json_encode($response);

mysqli_close($conn);
