<?php
include_once '../includes/dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $requisition_number = $_POST["requisition_number"];
  $user_name = $_POST["user_name"];
  $user_branch = $_POST["user_branch"];
  $requisition_date = $_POST["requisition_date"];
  $requisition_time = $_POST["requisition_time"];
  $table_items = json_decode($_POST["table_items"], true);

  $mysql = "INSERT INTO tbl_requisition (date, time, user, branch) VALUES ('".$requisition_date."', 
  '".$requisition_time."', '".$user_name."', '".$user_branch."')";
  $mysql .= "SELECT requisition_No FROM tbl_requisition ORDER BY requisition_No DESC LIMIT 1";
  mysqli->multi_query($conn, $mysql);
  $result = mysqli_query($conn, $mysql);
  $row = mysqli_fetch_assoc($result);
  $requisition_number = $row['requisition_No'];


  // foreach ($table_items as $key => $value) {
            
  //   $mysql = "INSERT INTO tbl_requisition_items (requisition_No, product_code, product_name, product_unit, product_quantity, status, branch) 
  //   VALUES('".$requisition_number."','".$value["code"]."','".$value["name"]."','".$value["unit"]."',
  //   '".$value["quantity"]."', '".$user_branch."')";
  //   mysqli_query($conn, $mysql);
  // }

  // $table_items['message'] = "Success";
  echo json_encode($requisition_number);
}
?>
