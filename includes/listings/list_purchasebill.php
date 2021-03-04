<?php

header("Content-type:application/json");

include_once '../dbconnect.php';

$query = "SELECT * FROM tbl_purchase_bill";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
	array_push(
		$response,
		array(
			'Purchase_Bill' => $row['purchasebill_no'],
			'LPO_No' => $row['po_number'],
			'Receipt_No' => $row['receipt_no'],
			'Delivery_Note' => $row['delivery_note_no'],
			'Invoice_No' => $row['invoice_no'],
			'Supplier' => $row['supplier_name'],
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
