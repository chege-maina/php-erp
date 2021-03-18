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
  $name = sanitize_input($_POST["name"]);
  $email = sanitize_input($_POST["email"]);
  $tel_no = sanitize_input($_POST["tel_no"]);
  $postal_address = sanitize_input($_POST["postal_address"]);
  $physical_address = sanitize_input($_POST["physical_address"]);
  $tax_id = sanitize_input($_POST["tax_id"]);
  $terms = sanitize_input($_POST["terms"]);
  $limit = sanitize_input($_POST["limit"]);
  $sales_rep = sanitize_input($_POST["sales_rep"]);

  if ($stmt = $con->prepare('SELECT name FROM tbl_customer WHERE name = ? and email =?')) {
    // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
    $stmt->bind_param('ss', $name, $email);
    $stmt->execute();
    // Store the result so we can check if the account exists in the database.
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
      if ($stmt = $con->prepare('INSERT INTO tbl_customer (name, email, tel_no, 
      postal_address, physical_address, tax_id, payment_terms, credit_limit, sales_rep) VALUES (?,?,?,?,?,?,?,?,?)')) {
        $stmt->bind_param('sssssssss', $name, $email, $tel_no, $postal_address, $physical_address, $tax_id, $terms, $limit, $sales_rep);

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
        "desc" => "Customer Already exists.."
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
