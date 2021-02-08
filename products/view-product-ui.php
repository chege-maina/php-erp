<?php
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en-US" dir="ltr">
<?php
include '../includes/base_page/head.php';
include_once '../includes/dbconnect.php';
?>
<?php

include_once '../includes/dbconnect.php';
$product_code = $_REQUEST['product_code'];
$query = "SELECT * FROM tbl_product WHERE product_code = '" . $product_code . "'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($result);

?>

<body>
  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <div class="container" data-layout="container">
      <!--nav starts here -->
      <?php
      include '../includes/base_page/nav.php';
      ?>

      <div class="content">
        <?php
        include '../navbar-shared.php';
        ?>

        <!-- =========================================================== -->
        <!-- body begins here -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <h5 class="p-2">View Record</h5>
        <div class="card">
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <form>
              <div class="row my-3">
                <div class="col">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Product Code</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product Category</th>
                        <th scope="col">Min Level</th>
                        <th scope="col">Product Reorder Level</th>
                        <th scope="col">Default Selling Price</th>
                        <th scope="col">Amount Before Tax</th>
                        <th scope="col">Default Purchase Price Inclusive of Tax</th>
                        <th scope="col">Profit Margin</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $count = 1;
                      $sel_query = "Select * from tbl_product ORDER BY product_code desc;";
                      $result = mysqli_query($conn, $sel_query);
                      while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                          <td scope="col"><?php echo $row["product_code"]; ?></td>
                          <td scope="col"><?php echo $row["product_name"]; ?></td>
                          <td scope="col"><?php echo $row["product_category"]; ?></td>
                          <td scope="col"><?php echo $row["min_level"]; ?></td>
                          <td scope="col"><?php echo $row["reorder"]; ?></td>
                          <td scope="col"><?php echo $row["dsp_price"]; ?></td>
                          <td scope="col"><?php echo $row["amount_before_tax"]; ?></td>
                          <td scope="col"><?php echo $row["dpp_inc_tax"]; ?></td>
                          <td scope="col"><?php echo $row["profit_margin"]; ?></td>
                          <td scope="col">
                            <a href="edit_ product.php?id=<?php echo $row["product_code"]; ?>">Edit</a>
                          </td>
                          <td scope="col">
                            <a href="delete_product.php?id=<?php echo $row["product_code"]; ?>">Delete</a>
                          </td>
                        </tr>
                      <?php $count++;
                      } ?>
                    </tbody>
                  </table>
                </div>
            </form>
            <!-- Content ends here -->
          </div>
          <!-- Additional cards can be added here -->
        </div>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- body ends here -->
        <!-- =========================================================== -->



        <!-- =========================================================== -->
        <!-- Footer Begin -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <?php
        include '../includes/base_page/footer.php';
        ?>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- Footer End -->
        <!-- =========================================================== -->
</body>

</html>
