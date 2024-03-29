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

  <style>
    .hide_page {
      display: none;
    }
  </style>
</head>


<body>
  <script>
    // Clear session storage
    window.sessionStorage.clear();

    window.addEventListener("beforeunload", event => {
      window.sessionStorage.clear();
    })
  </script>

  <?php
  include 'dummy_data.php';
  ?>


  <?php
  include 'scripts.php';
  ?>

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

        <?php
        include 'bottom_navbar.php';
        ?>

        <!-- ======================================================= -->
        <!-- page main -->
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <div id="page_main">

          <div class="row my-2">

            <div class="col-lg-5 col-sm-4 pl-2">
              <div class="row">
                <div class="col-lg-9 pr-1">
                  <?php
                  include 'cat_filter.php';
                  ?>
                </div>
                <div class="col p-0">

                  <?php
                  include 'branch_filter.php';
                  ?>
                </div>
              </div>
              <div class="row">
                <div class="col pr-0">
                  <div class="card mt-1">
                    <div class="card-body fs--1 p-4">
                      <div id="items_component">
                      </div>
                      <script>
                        window.addEventListener('AllItemsLoaded', (event) => {
                          const fpos_component = document.createElement("fpos-all-items");
                          fpos_component.setAttribute("items_json", event.detail);
                          document.querySelector("#items_component").appendChild(fpos_component);
                        });

                        window.addEventListener('ItemsUpdated', (event) => {
                          // TODO: Account for products in different branches
                          const items_component = document.querySelector("#items_component");
                          items_component.innerHTML = "";
                          const fpos_component = document.createElement("fpos-all-items");
                          fpos_component.setAttribute("items_json", event.detail);
                          items_component.appendChild(fpos_component);
                        });
                      </script>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col">
              <div class="row">

                <div class="col">

                  <div class="row">
                    <div class="col px-2">
                      <?php
                      include 'above_datatable.php';
                      ?>
                    </div>
                  </div>

                  <div class="row mt-1">
                    <div class="col px-2">
                      <div class="card">
                        <div class="card-body fs--1 p-4">
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

                </div>

              </div>
              <div class="row my-1 mb-7">
                <div class="col px-2">
                  <div class="row">
                    <div class="col">
                      <?php
                      include 'subtotals.php';
                      ?>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>
        <!-- -_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_-_- -->
        <!-- end page main -->
        <!-- ======================================================= -->
        <div id="page_checkout" class="hide_page">
          <?php
          include 'checkout_page.php';
          ?>
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
