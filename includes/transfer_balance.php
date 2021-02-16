<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trans_number = $_POST["trans_number"];
    $branch = $_POST["branch"];

    $query = "SELECT * FROM tbl_transfer_items WHERE transfer_no='$trans_number'";

    $result = mysqli_query($conn, $query);
    $response = array();

    while ($row = mysqli_fetch_assoc($result)) {

        $product = $row['product_name'];
        $qty = $row['product_quantity'];

        $query8 = "SELECT * FROM tbl_product WHERE product_name='$product'";
        $result8 = mysqli_query($conn, $query8);
        if ($row8 = mysqli_fetch_assoc($result8)) {
            $reorder = $row8['reorder'];
        }
        $control = $reorder + 10;

        $totalstore = 0;
        $totalsale = 0;

        $stats = "pending";
        $stats1 = "approved";

        $query1 = "SELECT sum(qty) FROM tbl_store_item WHERE product_name = '$product' and branch = '$branch'";
        $result1 = mysqli_query($conn, $query1);
        if ($row1 = mysqli_fetch_assoc($result1)) {
            $totalstore = $row1['sum(qty)'];
        }
        $query2 = "SELECT sum(qty) FROM tbl_sale_items WHERE product_name = '$product' and branch_location = '$branch'";
        $result2 = mysqli_query($conn, $query2);
        if ($row2 = mysqli_fetch_assoc($result2)) {
            $totalsale = $row2['sum(qty)'];
        }

        $balance = $totalstore - $totalsale - $control;

        if ($balance == $qty || $balance < $qty) {

            array_push(
                $response,
                array(
                    'product_name' => $product,
                    'balance' => $balance,
                    'qty' => $qty,
                    'message' => "nada"
                )
            );
        } else {
            array_push(
                $response,
                array(
                    'product_name' => $product,
                    'balance' => $balance,
                    'qty' => $qty,
                    'message' => "right"
                )
            );
        }
    }
    echo json_encode($response);

    mysqli_close($conn);
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
}
