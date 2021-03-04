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
			'Req_no' => $row[0],
			'date' => $row[1],
			'Created_By' => $row[3],
			'Branch' => $row[4],
			'Status' => $row[5]
		)
	);
}
echo json_encode($response);

mysqli_close($conn);
