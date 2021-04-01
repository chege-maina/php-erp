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
  $date = sanitize_input($_POST["date"]);
  $emp_name = sanitize_input($_POST["emp_name"]);
  $designation = sanitize_input($_POST["designation"]);
  $department = sanitize_input($_POST["department"]);
  $emp_no = sanitize_input($_POST["emp_no"]);
  $loan_type = sanitize_input($_POST["loan_type"]);
  $desc = sanitize_input($_POST["desc"]);
  $amount = sanitize_input($_POST["amount"]);
  $balance = sanitize_input($_POST["balance"]);
  $installment = sanitize_input($_POST["installment"]);
  $pc_interest = sanitize_input($_POST["pc_interest"]);
  $issue_date = sanitize_input($_POST["issue_date"]);
  $start_date = sanitize_input($_POST["start_date"]);
  $int_type = sanitize_input($_POST["int_type"]);
  $fringe_tax = sanitize_input($_POST["fringe_tax"]);
  $loan_id = $emp_no . " " . $issue_date;
  $stat = "pending";

  if (strcmp($loan_type, 'loan') == 0) {
    if ($stmt = $con->prepare('SELECT emp_name FROM tbl_companyloans WHERE emp_no = ? and status =? and loan_type =?')) {
      // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
      $stmt->bind_param('sss', $emp_no, $stat, $loan_type);
      $stmt->execute();
      // Store the result so we can check if the account exists in the database.
      $stmt->store_result();
      if ($stmt->num_rows == 0) {
        if ($stmt = $con->prepare('INSERT INTO tbl_companyloans (date, emp_name, designation, 
      department, emp_no, loan_type, description, amount, balance, installment, pc_interest, issue_date, start_date,
      int_type, fringe_tax, loan_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)')) {
          $stmt->bind_param(
            'ssssssssssssssss',
            $date,
            $emp_name,
            $designation,
            $department,
            $emp_no,
            $loan_type,
            $desc,
            $amount,
            $balance,
            $installment,
            $pc_interest,
            $issue_date,
            $start_date,
            $int_type,
            $fringe_tax,
            $loan_id
          );

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
          "desc" => "Loan Already exists.."
        ));
      }
    } else {
      echo json_encode(array(
        "message" => "error",
        "desc" => mysqli_error($con)
      ));
    }
  } else {
    if ($stmt = $con->prepare('INSERT INTO tbl_companyloans (date, emp_name, designation, 
      department, emp_no, loan_type, description, amount, balance, installment, pc_interest, issue_date, start_date,
      int_type, fringe_tax, loan_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)')) {
      $stmt->bind_param(
        'ssssssssssssssss',
        $date,
        $emp_name,
        $designation,
        $department,
        $emp_no,
        $loan_type,
        $desc,
        $amount,
        $balance,
        $installment,
        $pc_interest,
        $issue_date,
        $start_date,
        $int_type,
        $fringe_tax,
        $loan_id
      );

      if ($stmt->execute()) {
        $responseArray = array(
          "message" => "success"
        );
      } else {
        $responseArray = array(
          "message" => "error",
          "desc" => mysqli_error($con),
          "descss" => $date . " " . $desc
        );
      }
      echo json_encode($responseArray);
    } else {
      echo json_encode(array(
        "message" => "error",
        "desc" => mysqli_error($con)
      ));
    }
  }
} else {
  echo json_encode(array(
    "message" => "error",
    "desc" => "Fields required!"
  ));
}
