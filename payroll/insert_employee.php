<?php
include_once '../includes/dbconnect.php';
$con = $conn;
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
  $first_name = sanitize_input($_POST["first_name"]);
  $middle_name = sanitize_input($_POST["middle_name"]);
  $last_name = sanitize_input($_POST["last_name"]);
  $gender = sanitize_input($_POST["gender"]);
  $date_of_birth = sanitize_input($_POST["date_of_birth"]);
  $residential_status = sanitize_input($_POST["residential_status"]);
  $national_id_no = sanitize_input($_POST["national_id_no"]);
  $pin_no = sanitize_input($_POST["pin_no"]);
  $nssf_no = sanitize_input($_POST["nssf_no"]);
  $nhif_no = sanitize_input($_POST["nhif_no"]);
  $passport = sanitize_input($_POST["passport"]);

  if ($stmt = $con->prepare('SELECT first_name FROM tbl_employee WHERE national_id = ?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('s', $national_id_no);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
      if ($stmt = $con->prepare('INSERT INTO tbl_employee (first_name, middle_name, last_name,
      gender, dob, residential_status, national_id, pin_no, nssf_no, nhif_no, passport) VALUES (?,?,?,?,?,?,?,?,?,?,?)')) {
        $stmt->bind_param('sssssssssss', $first_name, $middle_name, $last_name, $gender, $date_of_birth, $residential_status, $national_id_no, $pin_no, $nssf_no, $nhif_no, $passport);

        if ($stmt->execute()) {
          $responseArray = array(
            "message" => "success"
          );
        } else {
          $responseArray = array(
            "message" => "error",
            "desc" => "Could not insert",
            "details" => mysqli_error($con)
          );
        }
        echo json_encode($responseArray);
      } else {
        echo json_encode(array(
          "message" => "error",
          "desc" => "Could not prepare insert query",
          "details" => mysqli_error($con)
        ));
      }
    } else {
      echo json_encode(array(
        "message" => "error",
        "desc" => "Employee already exists."
      ));
    }
  } else {
    echo json_encode(array(
      "message" => "error",
      "desc" => "Database Connection Error."
    ));
  }
} else {
  echo json_encode(array(
    "message" => "error",
    "desc" => "Fields required!"
  ));
}
