<?php
include_once '../includes/dbconnect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $req_no = $_POST["req_no"];
  

  $query = "SELECT * FROM tbl_quotation WHERE quote_no ='$req_no'";
        	
	$result = mysqli_query($conn, $query);
    $response = array();
	
	while($row = mysqli_fetch_assoc($result)){
        array_push($response, 
				   array(
                   'req_no'=>$row['quote_no'],
                   'date'=>$row['date'],
                   'branch'=>$row['due_date'],
                   'user'=>$row['user'],
                   'customer'=>$row['customer_name'],
                   'status'=>$row['status'])
                   );
                }

                echo json_encode($response);

mysqli_close($conn);
            }
            else{
                $message = "Fields have no data...";
                echo json_encode($message);
            }
