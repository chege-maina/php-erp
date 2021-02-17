<?php
include_once '../includes/dbconnect.php';
session_start();

$branch = $_SESSION['branch'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $req_no = $_POST["po_number"];
    $stats = 'pending';
    $stats2 = 'approved';

    $query = "SELECT * FROM tbl_purchaseorder_items WHERE po_number ='$req_no'";


    $result = mysqli_query($conn, $query);
    $response = array();


    while ($row = mysqli_fetch_assoc($result)) {

        $totalstore = 0;
        $poqty = $row['product_quantity'];
        $name = $row['product_name'];

        $query1 = "SELECT sum(qty) FROM tbl_store_item WHERE lpo_number ='$req_no' and branch='$branch' and product_name='$name' and status<>'done'";
        $result1 = mysqli_query($conn, $query1);
        if ($row1 = mysqli_fetch_assoc($result1)) {
            $totalstore = $row1['sum(qty)'];
        }
        $balance = $poqty - $totalstore;

        array_push(
            $response,
            array(
                'code' => $row['product_code'],
                'name' => $row['product_name'],
                'unit' => $row['product_unit'],
                'qty' => $balance
            )
        );
    }

    echo json_encode($response);
} else {
    $message = "Fields have no data...";
    echo json_encode($message);
}
mysqli_close($conn);
