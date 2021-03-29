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
  <title>Qubes | POS</title>


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
        key: "1A2sV3CXamtjcYY8pGfCYuS5XCaYuGeZJj",
        name: "Utopia",
        code: "074187605-1",
        stock: 14,
        quantity: 11,
        price: 30,
        discount: 23,
        tax_pc: 14,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "17ctqtzDLhaW5TKsrFV4pvxhgC1ukhPaMx",
        name: "Contracted",
        code: "462102980-0",
        stock: 7,
        quantity: 94,
        price: 40,
        discount: 9,
        tax_pc: 74,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "14M2zc3SfgXC397KvFN4pfvQug9bJ463YG",
        name: "Abbott and Costello Meet the Keystone Kops",
        code: "269056097-6",
        stock: 98,
        quantity: 42,
        price: 70,
        discount: 78,
        tax_pc: 64,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "1ALyiowNTeZsEUveYABBbUNxMed3P18H1P",
        name: "Running Mates",
        code: "228111853-3",
        stock: 57,
        quantity: 92,
        price: 16,
        discount: 43,
        tax_pc: 25,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "1ERKcCnKvQgwY37xodjcDzfE3B94Dyncph",
        name: "Tomorrow Night",
        code: "456871913-5",
        stock: 9,
        quantity: 60,
        price: 11,
        discount: 24,
        tax_pc: 71,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "1H4vEvfLBCjTTmB1WgS38zFnmHazmYYJdA",
        name: "Populaire",
        code: "101432198-0",
        stock: 49,
        quantity: 83,
        price: 79,
        discount: 57,
        tax_pc: 74,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "19JErH26bLHvQ85wcwP1YUsJEqbQLftYpc",
        name: "Spy Hard",
        code: "813552355-6",
        stock: 95,
        quantity: 73,
        price: 5,
        discount: 42,
        tax_pc: 74,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "16z6DpN6jtbDyptvoKkqjJp3mCQ9V2qtyo",
        name: "Perfect Family, The",
        code: "471732446-3",
        stock: 62,
        quantity: 13,
        price: 47,
        discount: 40,
        tax_pc: 59,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "121nD5PTM2rCXpF6boRKYTZqMHyWTfYCSS",
        name: "Booty Call",
        code: "544370333-1",
        stock: 41,
        quantity: 79,
        price: 67,
        discount: 94,
        tax_pc: 38,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "1FCjS7QifpKVWf3fjCUX2cMWykAoKRNEfb",
        name: "Spiral",
        code: "155060569-0",
        stock: 16,
        quantity: 18,
        price: 19,
        discount: 84,
        tax_pc: 66,
        tax: -1,
        subtotal: 60054,
      },
    ];


    let json_items = [{
        key: 1,
        name: "Sunsipaque",
        code: "497-23-2865",
        stock: 9,
        quantity: 3,
        balance: 43,
        price: 5176,
        discount: 82,
        tax: 84,
        tax_pc: 0,
        subtotal: 0,
        image_url: "http://dummyimage.com/532x548.png/dddddd/000000",
      },
      {
        key: 2,
        name: "All Day",
        code: "223-32-5184",
        stock: 69,
        quantity: 2,
        balance: 92,
        price: 4296,
        discount: 3,
        tax: 89,
        tax_pc: 0,
        subtotal: -1,
        image_url: "http://dummyimage.com/516x539.png/5fa2dd/ffffff",
      },
      {
        key: 3,
        name: "Pulmo 8",
        code: "356-89-1023",
        stock: 62,
        quantity: 1,
        balance: 61,
        price: 1123,
        discount: 38,
        tax: 41,
        tax_pc: 0,
        subtotal: 0,
        image_url: "http://dummyimage.com/518x548.png/ff4444/ffffff",
      },
      {
        key: 4,
        name: "Bupropion Hydrochloride",
        code: "557-97-6362",
        stock: 98,
        quantity: 6,
        balance: 76,
        price: 7127,
        discount: 51,
        tax: 90,
        tax_pc: -1,
        subtotal: -1,
        image_url: "http://dummyimage.com/508x549.png/dddddd/000000",
      },
      {
        key: 5,
        name: "Benazepril Hydrochloride and Hydrochlorothiazide",
        code: "443-28-6453",
        stock: 77,
        quantity: 6,
        balance: 60,
        price: 8404,
        discount: 69,
        tax: 15,
        tax_pc: 0,
        subtotal: -1,
        image_url: "http://dummyimage.com/507x517.png/5fa2dd/ffffff",
      },
      {
        ke: 6,
        name: "Nartussal",
        code: "583-67-6246",
        stock: 43,
        quantity: 7,
        balance: 87,
        price: 2447,
        discount: 5,
        tax: 30,
        tax_pc: 0,
        subtotal: 0,
        image_url: "http://dummyimage.com/503x509.png/5fa2dd/ffffff",
      },
      {
        key: 7,
        name: "Argentum Nitricum 6x",
        code: "472-76-3927",
        stock: 16,
        quantity: 7,
        balance: 57,
        price: 5296,
        discount: 81,
        tax: 46,
        tax_pc: -1,
        subtotal: 0,
        image_url: "http://dummyimage.com/504x514.png/cc0000/ffffff",
      },
      {
        key: 8,
        name: "OXYGEN",
        code: "247-93-9447",
        stock: 99,
        quantity: 8,
        balance: 38,
        price: 9396,
        discount: 20,
        tax: 39,
        tax_pc: 0,
        subtotal: 0,
        image_url: "http://dummyimage.com/526x548.png/cc0000/ffffff",
      },
      {
        key: 9,
        name: "Clean and Clear Advantage",
        code: "592-14-3054",
        stock: 46,
        quantity: 3,
        balance: 83,
        price: 5156,
        discount: 57,
        tax: 76,
        tax_pc: -1,
        subtotal: 0,
        image_url: "http://dummyimage.com/526x526.png/ff4444/ffffff",
      },
      {
        key: 10,
        name: "Metronidazoleiya",
        code: "230-96-5894",
        stock: 47,
        quantity: 3,
        balance: 30,
        price: 8585,
        discount: 35,
        tax: 30,
        tax_pc: 1,
        subtotal: 0,
        image_url: "http://dummyimage.com/528x514.png/dddddd/000000",
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
                    fpos_component.setAttribute("items_json", JSON.stringify(json_items));
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
