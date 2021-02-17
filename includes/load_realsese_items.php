<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $req_no = $_POST["req_no"];

  $stat = "done";

  $query = "SELECT * FROM tbl_transfer WHERE status='$stat' and transfer_no='$req_no'";


  $result = mysqli_query($conn, $query);
  $response = array();

  while ($row = mysqli_fetch_assoc($result)) {
    array_push(
      $response,
      array(
        'req_no' => $row['transfer_no'],
        'branch' => $row['branch'],
        'date' => $row['date'],
        'user' => $row['user']
      )
    );
  }

  echo json_encode($response);

  mysqli_close($conn);
} else {
  $message = "Fields have no data...";
  echo json_encode($message);
}
