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
			'Product_Code' => $row['product_code'],
			'Name' => $row['product_name'],
			'Category' => $row['product_category'],
			'Unit' => $row['product_unit'],
			'Tax_Pc' => $row['applicable_tax'],
			'Cost' => $row['amount_before_tax'],
			'Selling_Price' => $row['dsp_price'],
			'Status' => $row['status']
		)
	);
}
echo json_encode($response);

mysqli_close($conn);
