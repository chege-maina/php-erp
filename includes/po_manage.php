<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $req_no = $_POST["po_number"];
  

  $query = "SELECT * FROM tbl_purchaseorder WHERE po_number ='$req_no'";
        	
	$result = mysqli_query($conn, $query);
    $response = array();
	
	while($row = mysqli_fetch_assoc($result)){
        array_push($response, 
				   array(
                   'po_number'=>$row['po_number'],
                   'supplier_name'=>$row['supplier_name'],
                   'branch'=>$row['branch'],
                   'user'=>$row['user'],
                   'date'=>$row['date'],
                   'status'=>$row['status'],
                   'before_tax'=>$row['before_tax'],
                   'tax_amt'=>$row['tax_amt'],
                   'po_total'=>$row['po_total'])
                   );
                }

                echo json_encode($response);

mysqli_close($conn);
            }
            else{
                $message = "Fields have no data...";
                echo json_encode($message);
            }

?>
    