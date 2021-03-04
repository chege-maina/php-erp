<?php

header("Content-type:application/json");

include_once '../dbconnect.php';

$query = "SELECT * FROM tbl_requisition";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
	array_push(
		$response,
		array(
			'Req_no' => $row['requisition_No'],
			'date' => $row['date'],
			'Created_By' => $row['user'],
			'Branch' => $row['branch'],
			'Status' => $row['status']
		)
	);
}
echo json_encode($response);

mysqli_close($conn);
