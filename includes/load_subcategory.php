<?php

header("Content-type:application/json");

include_once 'dbconnect.php';

$query = "SELECT * FROM tbl_category";

$result = mysqli_query($conn, $query);
$response = array();


while ($row = mysqli_fetch_assoc($result)) {

	$category = $row['category_name'];
	$query2 = "SELECT * FROM tbl_subcategory WHERE category='$category'";
	$result2 = mysqli_query($conn, $query2);
	$response2 = array();
	while ($row2 = mysqli_fetch_assoc($result2)) {
		$subcategory = $row2['name'];
		array_push(
			$response2,
			array(
				'subcategory' => $subcategory
			)
		);
	}
	array_push(
		$response,
		array(
			'category' => $category,
			'subcategories' => $response2
		)
	);
}
echo json_encode($response);

mysqli_close($conn);
