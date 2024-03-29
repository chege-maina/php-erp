<?php

header("Content-type:application/json");

include_once 'dbconnect.php';
session_start();

$branch = $_SESSION['branch'];

$query = "SELECT * FROM tbl_branch_levels WHERE branch='$branch'";



$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {

    $product = $row['product_name'];
    $query8 = "SELECT * FROM tbl_product WHERE product_name='$product' and status='active'";
    $result8 = mysqli_query($conn, $query8);
    if ($row8 = mysqli_fetch_assoc($result8)) {
        $productcode = $row8['product_code'];

        $unit = $row8['product_unit'];
        $reorder = $row['reorder'];
        $max = $row['max_level'];

        $totalstore = 0;
        $totalsale = 0;
        $totaltra = 0;
        $totalfro = 0;
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
        $query6 = "SELECT sum(product_quantity) FROM tbl_transfer_items WHERE product_name = '$product' and branch = '$branch' and (status='stored' or status='pending' or status='approved' or status='done' or status='accepted')";
        $result6 = mysqli_query($conn, $query6);
        if ($row6 = mysqli_fetch_assoc($result6)) {
            $totaltra = $row6['sum(product_quantity)'];
        }

        $query7 = "SELECT sum(product_quantity) FROM tbl_transfer_items WHERE product_name = '$product' and branch_from = '$branch' and (status='stored' or status='accepted')";
        $result7 = mysqli_query($conn, $query7);
        if ($row7 = mysqli_fetch_assoc($result7)) {
            $totalfro = $row7['sum(product_quantity)'];
        }

        $balance = ($totalstore + $totalreq + $totalpo + $totaltra) - ($totalsale + $totalpa + $totalfro);

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
}
echo json_encode($response);

mysqli_close($conn);
