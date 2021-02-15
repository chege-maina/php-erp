<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

$branch = $_SESSION['branch'];

$query = "SELECT * FROM tbl_product";


$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {

    $product = $row['product_name'];
    $productcode = $row['product_code'];
    $unit = $row['product_unit'];
    $reorder = $row['reorder'];
    $max = $row['max_level'];

    $totalstore = 0;
    $totalsale = 0;
    $totalreq = 0;
    $totalpo = 0;
    $totalpa = 0;
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
    $query3 = "SELECT sum(product_quantity) FROM tbl_requisition_items WHERE product_name = '$product' and branch = '$branch' and (status='pending' or status='approved' or status='done')";
    $result3 = mysqli_query($conn, $query3);
    if ($row3 = mysqli_fetch_assoc($result3)) {
        $totalreq = $row3['sum(product_quantity)'];
    }

    $query4 = "SELECT sum(product_quantity) FROM tbl_purchaseorder_items WHERE product_name = '$product' and branch = '$branch' and status='approved'";
    $result4 = mysqli_query($conn, $query4);
    if ($row4 = mysqli_fetch_assoc($result4)) {
        $totalpo = $row4['sum(product_quantity)'];
    }

    $query5 = "SELECT sum(product_quantity) FROM tbl_purchaseorder_items WHERE product_name = '$product' and branch = '$branch' and (status='partial' or status='done')";
    $result5 = mysqli_query($conn, $query5);
    if ($row5 = mysqli_fetch_assoc($result5)) {
        $totalpa = $row5['sum(product_quantity)'];
    }

    $balance = ($totalstore + $totalreq + $totalpo) - ($totalsale + $totalpa);

    if ($balance == $reorder || $balance < $reorder) {
        $total = 0;

        array_push(
            $response,
            array(
                'product_code' => $productcode,
                'product_name' => $product,
                'unit' => $unit,
                'balance' => $balance,
                'max' => $max
            )
        );
    }
}
echo json_encode($response);

mysqli_close($conn);
