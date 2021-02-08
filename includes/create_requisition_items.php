<?php
include_once '../includes/dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requisition_number = $_POST["requisition_number"];
    $requisition_date = $_POST["requisition_date"];
    $requisition_time = $_POST["requisition_time"];
    $table_items = json_decode($_POST["table_items"], true);

    foreach ($table_items as $key => $value) {
            
        $mysql = "INSERT INTO tbl_requisition_items (requisition_No, product_code, product_name, product_unit, product_quantity) 
        VALUES('".$requisition_number."','".$value["code"]."','".$value["name"]."','".$value["unit"]."',
        '".$value["quantity"]."')";
        mysqli_query($conn, $mysql);
      }


    $table_items['message'] = "Success";
    echo json_encode($table_items);
}
?>