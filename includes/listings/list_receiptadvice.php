<?php

header("Content-type:application/json");

include_once '../dbconnect.php';

$query = "SELECT * FROM tbl_receiptadv";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
	array_push(
		$response,
		array(
			'Advice_No' => $row['rem_no'],
			'Supplier' => $row['customer_name'],
			'Date' => $row['date'],
			'Amount' => $row['amount'],
			'Paid' => round($row['payable'], 2),
			'WHT' => round($row['wht'], 2),
			'Created_By' => $row['user'],
			'Status' => $row['status']
		)
	);
}
echo json_encode($response);

mysqli_close($conn);
