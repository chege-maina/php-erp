<?php
include_once '../includes/dbconnect.php';
$con = $conn;
if (mysqli_connect_errno()) {
  // If there is an error with the connection, stop the script and display the error.
  die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first_name = sanitize_input($_POST["first_name"]);
  $middle_name = sanitize_input($_POST["middle_name"]);
  $last_name = sanitize_input($_POST["last_name"]);
  $gender = sanitize_input($_POST["gender"]);
  $date_of_birth = sanitize_input($_POST["date_of_birth"]);
  $residential_status = sanitize_input($_POST["residential_status"]);
  $national_id_no = sanitize_input($_POST["national_id_no"]);
  $pin_no = sanitize_input($_POST["pin_no"]);
  $nssf_no = sanitize_input($_POST["nssf_no"]);
  $nhif_no = sanitize_input($_POST["nhif_no"]);

  $branch = sanitize_input($_POST["branch"]);
  $job_number = sanitize_input($_POST["job_number"]);
  $employ_date = sanitize_input($_POST["employ_date"]);
  $start_date = sanitize_input($_POST["start_date"]);
  $end_date = sanitize_input($_POST["end_date"]);
  $duration = sanitize_input($_POST["duration"]);
  $job_title = sanitize_input($_POST["job_title"]);
  $department = sanitize_input($_POST["department"]);
  $head_of = sanitize_input($_POST["head_of"]);
  $report_to = sanitize_input($_POST["report_to"]);
  $region = sanitize_input($_POST["region"]);


  $employment_type = sanitize_input($_POST["employment_type"]);
  $payment_currency = sanitize_input($_POST["payment_currency"]);
  $work_shift = sanitize_input($_POST["work_shift"]);
  $monthly_salary = sanitize_input($_POST["monthly_salary"]);
  $salary_type = sanitize_input($_POST["salary_type"]);
  $off_days = sanitize_input($_POST["off_days"]);
  $income_tax = sanitize_input($_POST["income_tax"]);
  $deduct_nssf = sanitize_input($_POST["deduct_nssf"]);
  $deduct_nhif = sanitize_input($_POST["deduct_nhif"]);


  $official_email = sanitize_input($_POST["official_email"]);
  $personal_email = sanitize_input($_POST["personal_email"]);
  $country = sanitize_input($_POST["country"]);
  $mobile_no = sanitize_input($_POST["mobile_no"]);
  $official_no = sanitize_input($_POST["official_no"]);
  $ext_no = sanitize_input($_POST["ext_no"]);
  $city_town = sanitize_input($_POST["city_town"]);
  $county = sanitize_input($_POST["county"]);
  $p_code = sanitize_input($_POST["p_code"]);

  $s_payment_option = sanitize_input($_POST["s_payment_option"]);
  $s_account_no = sanitize_input($_POST["s_account_no"]);
  $s_account_name = sanitize_input($_POST["s_account_name"]);
  $s_bank_name = sanitize_input($_POST["s_bank_name"]);
  $s_sort_code = sanitize_input($_POST["s_sort_code"]);
  $s_mobile_no = sanitize_input($_POST["s_mobile_no"]);
  $s_bank_branch = sanitize_input($_POST["s_bank_branch"]);
  $table_items = json_decode($_POST["table_items"], true);

  $filename = $_FILES["passport"]["name"];
  $filetype = $_FILES["passport"]["type"];
  $filesize = $_FILES["passport"]["size"];
  $tempfile = $_FILES["passport"]["tmp_name"];
  // Make sure the folder already exists
  $filenameWithDirectory = "../uploads/" . $filename;
  $allow = array("jpg", "jpeg", "gif", "png");
  $info = explode('.', strtolower($_FILES['passport']['name']));

  if (in_array(end($info), $allow)) { // Is this file allowed
    // Upload the file
    if (move_uploaded_file($tempfile, $filenameWithDirectory)) {

      // =======================================================================================
      // Attempt data insert
      // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
      if ($stmt = $con->prepare('SELECT f_name FROM tbl_staff WHERE nat_id = ?')) {
        // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
        $stmt->bind_param('s', $national_id_no);
        $stmt->execute();
        // Store the result so we can check if the account exists in the database.
        $stmt->store_result();
        if ($stmt->num_rows == 0) {
          if ($stmt = $con->prepare('INSERT INTO tbl_staff (
          f_name, m_name, l_name,
          gender, dob, res, nat_id, pin_no, nssf_no, nhif_no, passport, off_mail, pers_mail,
          country, mobile_no, phone_no, ext_no, city, county, postal_code, branch, job_no, employ_date, 
          begin_date, duration, end_date, job_title, department, report_to, head_of, region, currency, 
          employ_type, shift, off_days, pay_type, salary, income_tax, deduct_nssf, deduct_nhif, account_name,
          account_no, bank_name, sort_code, s_mobile_no , s_bank_branch, s_payment) 
          VALUES (
            ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)')) {
            $path = "/uploads/" . $filename;
            $stmt->bind_param(
              'sssssssssssssssssssssssssssssssssssssssssssssss',
              $first_name,
              $middle_name,
              $last_name,
              $gender,
              $date_of_birth,
              $residential_status,
              $national_id_no,
              $pin_no,
              $nssf_no,
              $nhif_no,
              $path,
              $official_email,
              $personal_email,
              $country,
              $mobile_no,
              $official_no,
              $ext_no,
              $city_town,
              $county,
              $p_code,
              $branch,
              $job_number,
              $employ_date,
              $start_date,
              $duration,
              $end_date,
              $job_title,
              $department,
              $report_to,
              $head_of,
              $region,
              $payment_currency,
              $employ_date,
              $work_shift,
              $off_days,
              $salary_type,
              $monthly_salary,
              $income_tax,
              $deduct_nssf,
              $deduct_nhif,
              $s_account_name,
              $s_account_no,
              $s_bank_name,
              $s_sort_code,
              $s_mobile_no,
              $s_bank_branch,
              $s_payment_option
            );

            if ($stmt->execute()) {
              $name = "name";
              $email = "email";
              $phone = "phone";
              $relation = "relation";

              foreach ($table_items as $key => $value) {
                $mysql = "INSERT INTO tbl_staff_items (name, email, phone, relation) VALUES('" . $value["name"] . "', '" . $value["email"] . "','" . $value["phone"] . "','" . $value["relation"] . "')";
                mysqli_query($conn, $mysql);
              }


              $responseArray = array(
                "message" => "success"
              );
            } else {
              $responseArray = array(
                "message" => "error",
                "desc" => "Could not insert",
                "details" => $con->error
              );
            }
            echo json_encode($responseArray);
          } else {
            echo json_encode(array(
              "message" => "error",
              "desc" => "Could not prepare insert query",
              "details" => $con->error
            ));
          }
        } else {
          echo json_encode(array(
            "message" => "error",
            "desc" => "Employee already exists."
          ));
        }
      } else {
        echo json_encode(array(
          "message" => "error",
          "desc" => "Database Connection Error."
        ));
      }
      // -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-
      // =======================================================================================
    } else {
      echo json_encode(array(
        "message" => "error",
        "desc" => "Image not uploaded."
      ));
    }
  } else {
    echo json_encode(array(
      "message" => "error",
      "desc" => "Image files only."
    ));
  }
} else {
  echo json_encode(array(
    "message" => "error",
    "desc" => "Fields required!"
  ));
}
