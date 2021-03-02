<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lpo_no = $_POST["po_number"];

    $stat = "approved";

    $query = "SELECT * FROM tbl_sale WHERE status='$stat' and quote_no='$lpo_no'";

    $result = mysqli_query($conn, $query);
    $response = array();

    if ($row = mysqli_fetch_assoc($result)) {
        $po_number = $row['quote_no'];
        $supplier = $row['customer_name'];
        $terms = $row['terms'];
        $sub_total = $row['sub_total'];
        $tax = $row['tax'];
        $amount = $row['amount'];

        $query3 = "SELECT * FROM tbl_sale_items WHERE quote_no='$lpo_no'";
        $result3 = mysqli_query($conn, $query3);
        $response2 = array();

        while ($row3 = mysqli_fetch_assoc($result3)) {
            $prod_code = $row3['product_code'];
            $prod_name = $row3['product_name'];
            $unit = $row3['unit'];
            $qty = $row3['qty'];
            $cost = $row3['price'];
            $itm_tax = $row3['tax'];
            $total = $row3['amount'];

            array_push(
                $response2,
                array(
                    'product_code' => $prod_code,
                    'product_name' => $prod_name,
                    'product_unit' => $unit,
                    'product_qty' => $qty,
                    'product_tax' => $itm_tax,
                    'product_cost' => $cost,
                    'tax_pc' => $row3['tax_pc'],
                    'product_total' => $total
                )
            );
        }
        array_push(
            $response,
            array(
                'po_number' => $po_number,
                'supplier_name' => $supplier,
                'delivery_note' => $sub_total,
                'date' => $tax,
                'receipt_no' => $amount,
                'terms' => $terms,
                'table_data' => $response2
            )
        );
    }
    echo json_encode($response);
    mysqli_close($conn);
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
}
