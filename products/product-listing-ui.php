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
include_once '../includes/dbconnect.php';
include '../includes/base_page/head.php';
?>

<script>
  const headers = [{
      name: "key",
      editable: false,
      key: "key",
      computed: false
    },
    {
      name: "Name",
      editable: false,
      key: "name",
      computed: false
    },
    {
      name: "Code",
      editable: false,
      key: "code",
      computed: false
    },
    {
      name: "Stock",
      editable: false,
      key: "stock",
      computed: false
    },
    {
      name: "Quantity",
      editable: false,
      key: "quantity",
      computed: false
    },
    {
      name: "Price",
      editable: false,
      key: "price",
      computed: false
    },
    {
      name: "Discount",
      editable: false,
      key: "discount",
      computed: false
    },
    {
      name: "Tax %",
      editable: false,
      key: "tax_pc",
      computed: false
    },
    {
      name: "Tax",
      editable: false,
      key: "tax",
      computed: true,
      operation: "tax_pc / 100 * quantity * price",
    },
    {
      name: "Subtotal",
      editable: false,
      key: "subtotal",
      computed: true,
      operation: "tax_pc / 100 + 1 * quantity * price",
    },
  ];

  const items = [{
      key: 1,
      name: "Wiberg Super Cure",
      code: "LT38 2725 3405 4331 5052",
      stock: 59,
      quantity: 85,
      price: 13,
      discount: 40,
      tax_pc: 17,
      tax: -1,
      subtotal: 60054,
    },
    {
      key: 2,
      name: "Bacardi Breezer - Strawberry",
      code: "PS97 QVMV EN6O KQNI FXSD SPHX ICTY H",
      stock: 23,
      quantity: 59,
      price: 68,
      discount: 84,
      tax_pc: 3,
      tax: -1,
      subtotal: 784,
    },
    {
      key: 3,
      name: "Avocado",
      code: "LT21 2680 9565 6475 1512",
      stock: 26,
      quantity: 90,
      price: 84,
      discount: 2,
      tax_pc: 3,
      tax: -1,
      subtotal: 57305,
    },
    {
      key: 4,
      name: "Soup - Knorr, Country Bean",
      code: "MR92 5543 6765 4828 5308 1513 081",
      stock: 72,
      quantity: 73,
      price: 13,
      discount: 61,
      tax_pc: 15,
      tax: -1,
      subtotal: 15940,
    },
    {
      key: 5,
      name: "Kiwi",
      code: "CY32 4469 2631 OPJT FDCH I1HF 9WEQ",
      stock: 33,
      quantity: 73,
      price: 69,
      discount: 31,
      tax_pc: 15,
      tax: -1,
      subtotal: 15544,
    },
    {
      key: 6,
      name: "Banana - Green",
      code: "PT08 0202 1850 4474 9222 7254 5",
      stock: 99,
      quantity: 87,
      price: 54,
      discount: 100,
      tax_pc: 7,
      tax: -1,
      subtotal: 77459,
    },
    {
      key: 7,
      name: "Bread - Burger",
      code: "CR19 0596 3701 4238 7857 0",
      stock: 85,
      quantity: 69,
      price: 74,
      discount: 79,
      tax_pc: 11,
      tax: -1,
      subtotal: 91874,
    },
    {
      key: 8,
      name: "Bouq All Italian - Primerba",
      code: "FI31 5087 0293 5633 84",
      stock: 53,
      quantity: 85,
      price: 58,
      discount: 31,
      tax_pc: 1,
      tax: -1,
      subtotal: 78031,
    },
    {
      key: 9,
      name: "Beef - Tender Tips",
      code: "GT18 SXNS QA5F D7D9 B8P7 TYNO 83BV",
      stock: 72,
      quantity: 100,
      price: 20,
      discount: 88,
      tax_pc: 1,
      tax: -1,
      subtotal: 14014,
    },
    {
      key: 10,
      name: "Sachet",
      code: "MD71 SAAH ZICA HQPH 1JQP 3DEB",
      stock: 76,
      quantity: 53,
      price: 55,
      discount: 54,
      tax_pc: 10,
      tax: -1,
      subtotal: 10191,
    },
  ];
</script>

<body>


  <!-- ===============================================-->
  <!--    COMPONENT:: Include it -->
  <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_ -->
  <script src="../assets/js/vue"></script>
  <script src="../components/vue-components/fdatatable-list/dist/fdatatable-list.min.js"></script>
  <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_ -->
  <!-- ===============================================-->

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
        <div class="card">
          <div class="card-header bg-light">
            <h5 class="mb-0">Product Listing</h5>
          </div>
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam ipsum voluptatem necessitatibus et eaque quibusdam rerum tenetur iure quasi, quam, neque blanditiis voluptatibus quia impedit aspernatur accusamus esse, nisi rem.
            <!-- Content ends here -->
          </div>
          <!-- Additional cards can be added here -->
        </div>

        <!-- ===============================================-->
        <!--    COMPONENT:: Add it -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_ -->
        <div class="card mt-1">
          <div class="card-header bg-light">
            <h6 class="mb-0">Products</h6>
          </div>
          <div class="card-body fs--1 p-2">
            <!-- Content is to start here -->
            <div id="datatable">
            </div>
            <script>
              window.addEventListener('DOMContentLoaded', (event) => {
                const fdatatable = document.createElement("fdatatable-list");
                fdatatable.setAttribute("json_header", JSON.stringify(headers));
                fdatatable.setAttribute("json_items", JSON.stringify(items));
                document.querySelector("#datatable").appendChild(fdatatable);
              });
            </script>
          </div>
        </div>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_ -->
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
