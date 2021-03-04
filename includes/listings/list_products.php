<?php

header("Content-type:application/json");

include_once '../dbconnect.php';

$query = "SELECT * FROM tbl_product";

$result = mysqli_query($conn, $query);
$response = array();

while ($row = mysqli_fetch_assoc($result)) {
	array_push(
		$response,
		array(
			'code' => $row['product_code'],
			'name' => $row['product_name'],
			'category' => $row['product_category'],
			'unit' => $row['product_unit'],
			'tax_pc' => $row['applicable_tax'],
			'cost' => $row['amount_before_tax'],
			'Selling_price' => $row['dsp_price'],
			'status' => $row['status']
		)
	);
}
echo json_encode($response);

mysqli_close($conn);
