<?php

header("Content-type:application/json");

include_once '../dbconnect.php';

$query = "SELECT * FROM tbl_paybill WHERE pay_type='receipt'";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
	array_push(
		$response,
		array(
			'Date' => $row['date'],
			'Customer_Name' => $row['supplier_name'],
			'Bank' => $row['bank_name'],
			'Cheque_No' => $row['cheque_no'],
			'Amount' => $row['amount'],
			'Cheque_Type' => $row['cheque_type'],
			'Status' => $row['status']
		)
	);
}
echo json_encode($response);

mysqli_close($conn);
