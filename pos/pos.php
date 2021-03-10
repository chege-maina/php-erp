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

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>Falcon | Dashboard &amp; Web App Templat</title>


  <!-- ===============================================-->
  <!--    Favicons-->
  <!-- ===============================================-->
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/img/favicons/favicon-16x16.png">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicons/favicon.ico">
  <link rel="manifest" href="../assets/img/favicons/manifest.json">
  <meta name="msapplication-TileImage" content="../assets/img/favicons/mstile-150x150.png">
  <meta name="theme-color" content="#ffffff">
  <script src="../assets/js/config.js"></script>


  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <link href="../vendors/prism/prism-okaidia.css" rel="stylesheet">
  <link href="../assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
  <link href="../assets/css/theme.min.css" rel="stylesheet" id="style-default">
  <script>
    var isRTL = JSON.parse(localStorage.getItem('isRTL'));
    if (isRTL) {
      var linkDefault = document.getElementById('style-default');
      linkDefault.setAttribute('disabled', true);
      document.querySelector('html').setAttribute('dir', 'rtl');
    } else {
      var linkRTL = document.getElementById('style-rtl');
      linkRTL.setAttribute('disabled', true);
    }
  </script>
</head>


<body>

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
        editable: true,
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
        editable: true,
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


  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <div class="container-fluid" data-layout="container">
      <div class="content">

        <!-- ======================================================= -->
        <!-- body goes here  -->
        <!-- ======================================================= -->
        <script src="../assets/js/vue"></script>
        <script src="../components/vue-components/pos-datatable/dist/pos-component.min.js"></script>
        <script src="../components/vue-components/fpos-itemcards/dist/fpos.js"></script>
        <div class="row">

          <div class="col-lg-5 col-sm-4">
            <div class="card mt-1">
              <div class="card-body fs--1 p-4">
                <div id="items_component">
                </div>
                <script>
                  window.addEventListener('DOMContentLoaded', (event) => {
                    const fpos_component = document.createElement("fpos-all-items");
                    document.querySelector("#items_component").appendChild(fpos_component);
                  });
                </script>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card">
              <div class="card-body fs--1 p-4">
                Content is to start here
                <div id="pos_component">
                </div>
                <script>
                  window.addEventListener('DOMContentLoaded', (event) => {
                    const pos_component = document.createElement("pos-component");
                    pos_component.setAttribute("json_header", JSON.stringify(headers));
                    pos_component.setAttribute("json_items", JSON.stringify(items));
                    document.querySelector("#pos_component").appendChild(pos_component);
                  });
                </script>
              </div>
            </div>
          </div>

        </div>
        <!-- ====================================================== -->
        <!-- body ends here  -->
        <!-- ====================================================== -->
      </div>
    </div>
  </main>
  <!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->




  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <script src="../vendors/popper/popper.min.js"></script>
  <script src="../vendors/bootstrap/bootstrap.min.js"></script>
  <script src="../vendors/anchorjs/anchor.min.js"></script>
  <script src="../vendors/is/is.min.js"></script>
  <script src="../vendors/prism/prism.js"></script>
  <script src="../vendors/fontawesome/all.min.js"></script>
  <script src="../vendors/lodash/lodash.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="../vendors/list.js/list.min.js"></script>
  <script src="../assets/js/theme.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
</body>

</html>