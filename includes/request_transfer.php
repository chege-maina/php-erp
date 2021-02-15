<?php
include_once '../includes/dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requisition_number = $_POST["requisition_number"];
    $user_name = $_POST["user_name"];
    $user_branch = $_POST["user_branch"];
    $requisition_date = $_POST["requisition_date"];
    $requisition_time = $_POST["requisition_time"];
    $table_items = json_decode($_POST["table_items"], true);

    $mysql = "INSERT INTO tbl_transfer (date, time, user, branch) VALUES ('" . $requisition_date . "', 
  '" . $requisition_time . "', '" . $user_name . "', '" . $user_branch . "');";
    $mysql .= "SELECT transfer_no FROM tbl_transfer ORDER BY transfer_no DESC LIMIT 1";

    if (mysqli_multi_query($conn, $mysql)) {
        do {
            /* store first result set */
            if ($result = mysqli_store_result($conn)) {
                while ($row = mysqli_fetch_row($result)) {
                    $requisition_number = $row[0];
                }
                mysqli_free_result($result);
            }
            /* print divider */
            if (mysqli_more_results($conn)) {
                // echo "-----------------\n";
            }
        } while (mysqli_next_result($conn));

        foreach ($table_items as $key => $value) {

            $mysql = "INSERT INTO tbl_transfer_items (transfer_no, product_code, product_name, product_unit, product_quantity, branch, balance)
  VALUES('" . $requisition_number . "','" . $value["code"] . "','" . $value["name"] . "','" . $value["unit"] . "',
  '" . $value["quantity"] . "', '" . $user_branch . "','" . $value["balance"] . "')";
            mysqli_query($conn, $mysql);
        }


        $message = "Transfer Nmuber " . $requisition_number . " Created Successfully..";
        echo json_encode($message);
    } else {
        echo "Multiquery failed";
    }
}
mysqli_close($conn);
