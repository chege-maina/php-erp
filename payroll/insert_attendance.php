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
  $employee_name = sanitize_input($_POST["employee_name"]);
  $att_date = sanitize_input($_POST["att_date"]);
  $employee_no = sanitize_input($_POST["employee_no"]);
  $branch = sanitize_input($_POST["branch"]);
  $job_title = sanitize_input($_POST["job_title"]);
  $description = sanitize_input($_POST["description"]);
  $late_entry = sanitize_input($_POST["late_entry"]);
  $early_exit = sanitize_input($_POST["early_exit"]);

  $month = date("F", strtotime($att_date));
  $year = date("Y", strtotime($att_date));


  if ($stmt = $con->prepare('SELECT employee_no FROM tbl_attendance WHERE employee_no = ? AND att_date = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('ss', $employee_no, $att_date,);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
      if ($stmt = $con->prepare('INSERT INTO tbl_attendance (employee_name,att_date,employee_no,branch,job_title,description,late_entry,early_exit, d_month, d_year) VALUES (?,?,?,?,?,?,?,?,?,?)')) {
        $stmt->bind_param('ssssssssss', $employee_name, $att_date, $employee_no, $branch, $job_title, $description, $late_entry, $early_exit, $month, $year);

        if ($stmt->execute()) {
          $responseArray = array(
            "message" => "success"
          );
          require_once "../includes/muster-roll.php";
          $db = new cardio();
          $db->keeper("quoted");
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
        "desc" =>  "Record Already exists.."
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
