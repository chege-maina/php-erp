
<?php
include_once '../includes/dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $sub_category = $_POST["sub_category"];
  $category =  $_POST["category"];
  $query = "SELECT count(name) FROM tbl_subcategory WHERE name='$sub_category'";

  $result = mysqli_query($conn, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $message = "Sub-Group Already Exists..";
    echo json_encode($message);
  } else {
    $query = "SELECT category_code FROM tbl_category WHERE category_name='$category'";

    $result = mysqli_query($conn, $query);
    if ($row = mysqli_fetch_assoc($result)) {
      $code = $row['category_code'];
      if ($code < 10) {
        $code = "00" . $code;
      } else if ($code < 100) {
        $code = "0" . $code;
      }
      $query = "SELECT count(name) FROM tbl_subcategory WHERE category='$category'";

      $result = mysqli_query($conn, $query);
      if ($row = mysqli_fetch_assoc($result)) {
        $code2 = $row['count(name)'] + 1;
        if ($code2 < 10) {
          $code2 = "00" . $code2;
        } else if ($code2 < 100) {
          $code2 = "0" . $code2;
        }
      }
      $maincode = $code . "-" . $code2;
      $mysql = "INSERT INTO tbl_subcategory (name, category, sub_cat_code) VALUES('" . $sub_category . "','" . $category . "','" . $maincode . "')";
      mysqli_query($conn, $mysql);
      $message = "Sub-Group added Successfully..";
      echo json_encode($message);
    }
  }
}

mysqli_close($conn);
