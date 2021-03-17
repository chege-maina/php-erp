<?php
include_once '../includes/dbconnect.php';
session_start();
$branch = $_SESSION['branch'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $req_no = $_POST["req_no"];
    $stats = 'pending';
    $stats2 = 'approved';

    $query8 = "SELECT * FROM tbl_quotation_items WHERE quote_no ='$req_no' and (status='$stats' or status = '$stats2')";

    $result8 = mysqli_query($conn, $query8);
    $response = array();


    while ($row8 = mysqli_fetch_assoc($result8)) {
        $product_name = $row8['product_name'];
        $query = "SELECT * FROM tbl_product WHERE product_name='$product_name'";


        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {

            $product = $row['product_name'];
            $productcode = $row['product_code'];
            $unit = $row['product_unit'];
            $tax = $row['applicable_tax'];
            $price = $row['dsp_price'];

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

            array_push(
                $response,
                array(

                    'code' => $row8['product_code'],
                    'name' => $row8['product_name'],
                    'unit' => $row8['unit'],
                    'qty' => $row8['qty'],
                    'total' => $row8['amount'],
                    'tax' => $row8['tax'],
                    'tax_pc' => $row8['tax_pc'],
                    'balance' => $row8['price'],
                    'bal' => $balance

                )
            );
        }

        echo json_encode($response);
    }
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
}
mysqli_close($conn);
