<?php

header("Content-type:application/json");

include_once '../dbconnect.php';

$query = "SELECT * FROM tbl_store";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
	array_push(
		$response,
		array(
			'Receipt no' => $row['receipt_no'],
			'date' => $row['date'],
			'LPO_No' => $row['lpo_number'],
			'Supplier' => $row['supplier_name'],
			'Delivery_Note' => $row['invoice_no'],
			'Created_By' => $row['user'],
			'Branch' => $row['branch'],
			'Status' => $row['status']
		)
	);
}
echo json_encode($response);

mysqli_close($conn);
