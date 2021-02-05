<?php
	session_start();
	// Change this to your connection info.
	include_once 'dbconnect.php';
	// Try and connect using the info above.
	$con = $conn;
	if ( mysqli_connect_errno() ) {
		// If there is an error with the connection, stop the script and display the error.
		die ('Failed to connect to MySQL: ' . mysqli_connect_error());
		
	}
	// Now we check if the data was submitted, isset() function will check if the data exists.
	if (!isset($_POST['requisition_number'])) {
		// Could not get the data that should have been sent.
		die ('Please complete the registration form!');
		
	}
	
			// Username doesnt exists, insert new account
			if ($stmt = $con->prepare('INSERT INTO tbl_requisition (date, time, user, branch) VALUES (?,?,?,?)')) {
				$stmt->bind_param('ssss', $_POST['requisition_date'], $_POST['requisition_time'], $_POST['requisition_user'], $_POST['requisition_branch']);
                $stmt->execute();
                echo "Successful";
			} else {
		// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
				echo "Could not prepare statement!";
			}
		
		$stmt->close();

	$con->close();
	?>