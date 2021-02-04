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
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['email'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	die ('Please fill both the username and password field!');
}
// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT email, password, designation, branch, first_name, last_name FROM tbl_user WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
if ($stmt->num_rows > 0) {
	$stmt->bind_result($email, $password, $designation, $branch, $first_name, $last_name);
	$stmt->fetch();
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) {
		// Verification success! User has loggedin!
		// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
		if ($designation==='Procurement officer'){
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['branch'] = $branch;
		$_SESSION['name'] = $first_name." ".$last_name;
		$_SESSION['designation'] = $designation;

		echo 'Dashboard1';
	}
	else if ($designation==='Warehouse manager'){
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['branch'] = $branch;
		$_SESSION['name'] = $first_name." ".$last_name;
		$_SESSION['designation'] = $designation;

		echo 'Dashboard2';
	}

		//header('Location: ../dashtmp.php');
	} else {
		echo 'Incorrect password!';
	}
} else {
	echo 'Incorrect Email Address!';
}
$stmt->close();
}
 else {
	echo 'Database Error Connection!';
}