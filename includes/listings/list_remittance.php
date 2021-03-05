<?php

header("Content-type:application/json");

include_once '../dbconnect.php';

$query = "SELECT * FROM tbl_remittance";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
	array_push(
		$response,
		array(
			'Remittance_No' => $row['rem_no'],
			'Supplier' => $row['supplier_name'],
			'Date' => $row['date'],
			'Amount' => $row['amount'],
			'Payable' => $row['payable'],
			'WHT' => $row['wht'],
			'Created_By' => $row['user'],
			'Status' => $row['status']
		)
	);
}
echo json_encode($response);

mysqli_close($conn);
