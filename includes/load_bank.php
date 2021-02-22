<?php

header("Content-type:application/json");

include_once 'dbconnect.php';

$query = "SELECT * FROM tbl_bank";

$result = mysqli_query($conn, $query);
$response = array();

if ($row = mysqli_fetch_assoc($result)) {
	array_push(
		$response,
		array(
			'name' => $row['bank_name']
		)
	);
}
echo json_encode($response);

mysqli_close($conn);
