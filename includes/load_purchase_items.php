<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $branch = $_POST["branch"];
    $stat = "approved";

    $query = "SELECT product_code, product_name, product_unit, sum(product_quantity) FROM tbl_requisition_items WHERE status='$stat' and branch='$branch' GROUP BY product_code ORDER BY product_code ASC";
    $result = mysqli_query($conn, $query);
    $response = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $prodnme = $row['product_name'];


        $query1 = "SELECT * FROM supplier_product WHERE product_name='$prodnme' ORDER BY product_cost ASC";
        $result1 = mysqli_query($conn, $query1);
        $response1 = array();
        while ($row1 = mysqli_fetch_assoc($result1)) {
            array_push(
                $response1,
                array(
                    'supplier' => $row1['supplier_name'],
                    'cost' => $row1['product_cost']
                )
            );
        }

        array_push(
            $response,
            array(
                'code' => $row['product_code'],
                'name' => $row['product_name'],
                'unit' => $row['product_unit'],
                'qty' => $row['sum(product_quantity)'],
                'suppliers' => $response1
            )
        );
    }

    echo json_encode($response);
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
}
mysqli_close($conn);
