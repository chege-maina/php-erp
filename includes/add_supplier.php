<?php
include_once '../includes/dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $tel_no = $_POST["tel_no"];
  $postal_address = $_POST["postal_address"];
  $physical_address = $_POST["physical_address"];
  $tax_id = $_POST["tax_id"];
  $payment_terms = $_POST["payment_terms"];
  $table_items = json_decode($_POST["table_items"], true);

  $name = trim($name);
  $email = trim($email);

  $mysql = "INSERT INTO tbl_supplier (name, email, tel_no, postal_address, physical_address, tax_id, payment_terms)
   VALUES ('" . $name . "', '" . $email . "', '" . $tel_no . "', '" . $postal_address . "' , '" . $physical_address . "'
   , '" . $tax_id . "', '" . $payment_terms . "');";
  $mysql .= "SELECT name FROM tbl_supplier ORDER BY supplier_id DESC LIMIT 1";

  if (mysqli_multi_query($conn, $mysql)) {
    do {
      /* store first result set */
      if ($result = mysqli_store_result($conn)) {
        while ($row = mysqli_fetch_row($result)) {
          $prod_name = $row[0];
        }
        mysqli_free_result($result);
      }
      /* print divider */
      if (mysqli_more_results($conn)) {
        // echo "-----------------\n";
      }
    } while (mysqli_next_result($conn));
  } else {
    echo "Multiquery failed";
  }

  foreach ($table_items as $key => $value) {

    $mysql = "INSERT INTO supplier_product (supplier_name, product_name, product_cost)
  VALUES('" . $name . "','" . $value["name"] . "','" . $value["cost"] . "')";
    mysqli_query($conn, $mysql);
  }

  $message = "Supplier Added Successfully..";
  echo json_encode($message);
}
mysqli_close($conn);
