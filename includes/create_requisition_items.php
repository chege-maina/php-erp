<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requisition_number = $_POST["requisition_number"];
    $requisition_date = $_POST["requisition_date"];
    $requisition_time = $_POST["requisition_time"];
    $table_items = json_decode($_POST["table_items"]);
    $table_items['message'] = "Success";
    echo json_encode($table_items);
}
?>
<?php
?>