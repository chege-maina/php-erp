<?php

header("Content-type:application/json");

include_once '../dbconnect.php';

$query = "SELECT * FROM tbl_invoice";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
	array_push(
		$response,
		array(
			'Sale_Bill' => $row['salesbill_no'],
			'Sale_Order_No.' => $row['so_number'],
			'Customer' => $row['customer_name'],
			'Date' => $row['date'],
			'Due_Date' => $row['due_date'],
			'Created_By' => $row['user'],
			'Payment_Terms' => $row['payment_terms'],
			'Total' => $row['total'],
			'Status' => $row['status']
		)
	);
}
echo json_encode($response);

mysqli_close($conn);
