<?php
include_once '../includes/dbconnect.php';
$con = $conn;

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $shift_name = sanitize_input($_POST["shift_name"]);
  $start_time = sanitize_input($_POST["start_time"]);
  $end_time = sanitize_input($_POST["end_time"]);
  $work_hours = sanitize_input($_POST["work_hours"]);
  $non_work = sanitize_input($_POST["non_work"]);


  if ($stmt = $con->prepare('SELECT shift_id FROM tbl_shift WHERE shift_id = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $shift_id);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
      if ($stmt = $con->prepare('INSERT INTO tbl_shift (shift_name,start_time,end_time,work_hours,non_work) VALUES (?,?,?,?,?)')) {
        $stmt->bind_param('sssss', $shift_name, $start_time, $end_time, $work_hours, $non_work);

        if ($stmt->execute()) {
          $responseArray = array(
            "message" => "success"
          );
        } else {
          $responseArray = array(
            "message" => "error",
            "desc" => "Internal Server Error"
          );
        }
        echo json_encode($responseArray);
      } else {
        echo json_encode(array(
          "message" => "error",
          "desc" => mysqli_error($con)
        ));
      }
    } else {
      echo json_encode(array(
        "message" => "error",
        "desc" => "Record Already exists.."
      ));
    }
  } else {
    echo json_encode(array(
      "message" => "error",
      "desc" => "Database Connection Error.."
    ));
  }
} else {
  echo json_encode(array(
    "message" => "error",
    "desc" => "Fields required!"
  ));
}
