<?php

header("Content-type:application/json");

include_once '../includes/dbconnect.php';
session_start();
$query9 = "SELECT * FROM tbl_branch";
$result9 = mysqli_query($conn, $query9);
$response2 = array();

while ($row9 = mysqli_fetch_assoc($result9)) {

    $branch = $row9['branch_name'];

    $query8 = "SELECT * FROM tbl_branch_levels WHERE branch='$branch'";
    $result8 = mysqli_query($conn, $query8);
    $response = array();

    while ($row8 = mysqli_fetch_assoc($result8)) {
        $product = $row8['product_name'];
        $reorder = $row8['min_level'];
        $max = $row8['max_level'];


        $query = "SELECT * FROM tbl_product WHERE product_name='$product'";


        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {


            $productcode = $row['product_code'];
            $unit = $row['product_unit'];
            $tax = $row['applicable_tax'];
            $price = $row['dsp_price'];
            $atomic_unit = $row['atomic_unit'];
            $bs_price = $row['bs_price'];
            $conversion = $row['conversion'];
            $category = $row['product_category'];
            $sub_category = $row['sub_category'];
            $path = $row['product_image'];

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
            $query2 = "SELECT sum(qty) FROM tbl_sale_items WHERE product_name = '$product' and branch_location = '$branch' and (status='approved' or status='done')";
            $result2 = mysqli_query($conn, $query2);
            if ($row2 = mysqli_fetch_assoc($result2)) {
                $totalsale = $row2['sum(qty)'];
            }

            $query4 = "SELECT sum(qty) FROM tbl_invoice_items WHERE product_name = '$product' and branch = '$branch' and status='approved'";
            $result4 = mysqli_query($conn, $query4);
            if ($row4 = mysqli_fetch_assoc($result4)) {
                $totalpo = $row4['sum(qty)'];
            }

            $query5 = "SELECT sum(qty) FROM tbl_invoice_items WHERE product_name = '$product' and branch = '$branch' and (status='partial' or status='done')";
            $result5 = mysqli_query($conn, $query5);
            if ($row5 = mysqli_fetch_assoc($result5)) {
                $totalpa = $row5['sum(qty)'];
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

            $balance = ($totalstore + $totalpo + $totaltra) - ($totalsale + $totalpa + $totalfro);

            if ($balance > $reorder) {
                $total = 0;

                array_push(
                    $response,
                    array(
                        'balance' => $balance,
                        'code' => $productcode,
                        'name' => $product,
                        'unit' => $unit,
                        'atomic_unit' => $atomic_unit,
                        'bs_price' => $bs_price,
                        'conversion' => $conversion,
                        'tax' => $tax,
                        'price' => $price,
                        'category' => $category,
                        'sub_category' => $sub_category,
                        'path' => $path
                    )
                );
            }
        }
    }
    array_push(
        $response2,
        array(
            'branch' => $branch,
            'branch_stuff' => $response
        )
    );
}

echo json_encode($response2);

mysqli_close($conn);
