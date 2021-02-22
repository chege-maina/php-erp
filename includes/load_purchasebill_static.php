<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lpo_no = $_POST["po_number"];

    $stat = "approved";

    $query = "SELECT * FROM tbl_store WHERE status='$stat' and lpo_number='$lpo_no' ORDER BY receipt_no ASC";

    $result = mysqli_query($conn, $query);
    $response = array();

    if ($row = mysqli_fetch_assoc($result)) {
        $po_number = $row['lpo_number'];
        $supplier = $row['supplier_name'];
        $del_no = $row['invoice_no'];
        $dat_rec = $row['date'];
        $rec_no = $row['receipt_no'];

        $query2 = "SELECT payment_terms FROM tbl_supplier WHERE name='$supplier'";
        $result2 = mysqli_query($conn, $query2);

        if ($row2 = mysqli_fetch_assoc($result2)) {
            $terms = $row2['payment_terms'];
        }
        $query3 = "SELECT * FROM tbl_store_item WHERE receipt_no='$rec_no'";
        $result3 = mysqli_query($conn, $query3);
        $response2 = array();

        while ($row3 = mysqli_fetch_assoc($result3)) {
            $prod_code = $row3['product_code'];
            $prod_name = $row3['product_name'];
            $unit = $row3['product_unit'];
            $qty = $row3['qty'];

            $query4 = "SELECT product_cost FROM supplier_product WHERE product_name='$prod_name' and supplier_name='$supplier'";
            $result4 = mysqli_query($conn, $query4);

            if ($row4 = mysqli_fetch_assoc($result4)) {
                $cost = $row4['product_cost'];
                $total = $cost * $qty;
            }
            array_push(
                $response2,
                array(
                    'product_code' => $prod_code,
                    'product_name' => $prod_name,
                    'product_unit' => $unit,
                    'product_qty' => $qty,
                    'product_cost' => $cost,
                    'product_total' => $total
                )
            );
        }
        array_push(
            $response,
            array(
                'po_number' => $po_number,
                'supplier_name' => $supplier,
                'delivery_note' => $del_no,
                'date' => $dat_rec,
                'receipt_no' => $rec_no,
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
