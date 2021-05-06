<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $year = $_POST["year"];

  $query = "SELECT * FROM tbl_nhif WHERE descnhif='$year' ORDER BY fromnhif ASC";

  $result = mysqli_query($conn, $query);
  $response = array();

  while ($row = mysqli_fetch_assoc($result)) {
    array_push(
      $response,
      array(
        'from' => $row['fromnhif'],
        'to' => $row['tonhif'],
        'rate' => $row['rate']
      )
    );
  }
  echo json_encode($response);

  mysqli_close($conn);
} else {
  $message = "Fields have no data...";
  echo json_encode($message);
}
