<?php
include_once '../includes/dbconnect.php';
$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_name = sanitize_input($_POST["user_name"]);

  $product_name = sanitize_input($_POST["product_name"]);
  $product_category = sanitize_input($_POST["product_category"]);
  $product_unit = sanitize_input($_POST["product_unit"]);
  $selling_unit = sanitize_input($_POST["selling_unit"]);
  $coversion_value = sanitize_input($_POST["conversion_value"]);

  $weight = sanitize_input($_POST["weight"]);
  $sub_category = sanitize_input($_POST["sub_category"]);

  $tax_type = sanitize_input($_POST["tax_type"]);
  $applicable_tax = sanitize_input($_POST["applicable_tax"]);
  $amount_before_tax = sanitize_input($_POST["amount_before_tax"]);

  $dpp_exc_tax = sanitize_input($_POST["dpp_exc_tax"]);
  $dpp_inc_tax = sanitize_input($_POST["dpp_inc_tax"]);
  $profit_margin = sanitize_input($_POST["profit_margin"]);
  $dsp_price = sanitize_input($_POST["dsp_price"]);
  $bs_price = sanitize_input($_POST["bs_price"]);
  $table_items = json_decode($_POST["table_items"], true);

  $filename = $_FILES["product_image"]["name"];
  $filetype = $_FILES["product_image"]["type"];
  $filesize = $_FILES["product_image"]["size"];
  $tempfile = $_FILES["product_image"]["tmp_name"];
  // Make sure the folder already exists
  $filenameWithDirectory = "../uploads/" . $filename;
  $allow = array("jpg", "jpeg", "gif", "png");
  $info = explode('.', strtolower($_FILES['product_image']['name']));

  if (in_array(end($info), $allow)) // is this file allowed
  {

    // Upload the file
    if (move_uploaded_file($tempfile, $filenameWithDirectory)) {
      if ($stmt = $con->prepare('SELECT product_name FROM tbl_product WHERE product_name = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $product_name);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows == 0) {

          $query = "SELECT sub_cat_code FROM tbl_subcategory WHERE name='$sub_category'";

          $result = mysqli_query($conn, $query);
          if ($row = mysqli_fetch_assoc($result)) {
            $code = $row['sub_cat_code'];
            $query = "SELECT count(sub_category) FROM tbl_product WHERE sub_category='$sub_category'";

            $result = mysqli_query($conn, $query);
            if ($row = mysqli_fetch_assoc($result)) {
              $code2 = $row['count(sub_category)'] + 1;
              if ($code2 < 10) {
                $code2 = "00" . $code2;
              } else if ($code2 < 100) {
                $code2 = "0" . $code2;
              }
            }
            $maincode = $code . "_" . $code2;



            $path = "/uploads/" . $filename;
            if ($stmt = $con->prepare('INSERT INTO tbl_product (product_name, product_unit, product_category, product_code, weight, sub_category, product_image, dsp_price, amount_before_tax, dpp_inc_tax, applicable_tax, profit_margin, user, atomic_unit, conversion, bs_price) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)')) {
              $stmt->bind_param('ssssssssssssssss', $product_name, $product_unit, $product_category, $maincode, $weight, $sub_category, $path, $dsp_price, $amount_before_tax, $dpp_inc_tax, $applicable_tax, $profit_margin, $user_name, $selling_unit, $coversion_value, $bs_price);

              if ($stmt->execute()) {

                foreach ($table_items as $key => $value) {
                  $receipt = "opening_bal";
                  $status = "done";

                  $mysql = "INSERT INTO tbl_store_item (qty, product_name, product_code, branch, receipt_no,
                  lpo_number, product_unit, status) VALUES('" . $value["opening_bal"]  . "','" . $product_name . "','" . $maincode . "','" . $value["branch"] . "', '" . $receipt . "','" . $receipt . "','" . $product_unit . "','" . $status . "')";
                  mysqli_query($conn, $mysql);
                  $mysql = "INSERT INTO tbl_branch_levels (product_name, branch, min_level, max_level,reorder) VALUES('" . $product_name . "','" . $value["branch"] . "', '" . $value["min_level"] . "','" . $value["max_level"] . "','" . $value["reorder"] . "')";
                  mysqli_query($conn, $mysql);
                }


                $responseArray = array(
                  "message" => "success",
                  "add" => "Record saved successfuly"
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
                "message" => "Error",
                "desc" => "Could not attempt insertion of data",
                "detail" => mysqli_error($con)
              ));
            }
          } else {
            echo json_encode(array(
              "message" => "error",
              "desc" => "Error.."
            ));
          }
        } else {
          echo json_encode(array(
            "message" => "error",
            "desc" => "Product Already exists.."
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
        "desc" => "Image photo not uploaded"
      ));
    }
  } else {
    echo json_encode(array(
      "message" => "error",
      "desc" => "Image Files only..."
    ));
  }
} else {
  echo json_encode(array(
    "message" => "error",
    "desc" => "Fields required!"
  ));
}
