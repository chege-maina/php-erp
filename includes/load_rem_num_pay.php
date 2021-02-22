<?php

header("Content-type:application/json");

include_once 'dbconnect.php';

$query = "SELECT * FROM tbl_remittance WHERE status='approved'";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
	array_push(
		$response,
		array(
			'rem_num' => $row['rem_no'],
			'supplier' => $row['supplier_name'],
			'date' => $row['date']
		)
	);
}
echo json_encode($response);

mysqli_close($conn);
