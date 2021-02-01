<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <?php
  include './includes/base_page/head.php';
  ?>
</head>


<body>

  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <div class="container" data-layout="container">
      <script>
        var isFluid = JSON.parse(localStorage.getItem('isFluid'));
        if (isFluid) {
          var container = document.querySelector('[data-layout]');
          container.classList.remove('container');
          container.classList.add('container-fluid');
        }
      </script>
      <!--nav starts here -->
      <nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
        <script>
          var navbarStyle = localStorage.getItem("navbarStyle");
          if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
          }
        </script>
        <div class="d-flex align-items-center">
          <div class="toggle-icon-wrapper">

            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-toggle="tooltip" data-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

          </div><a class="navbar-brand" href="../index.html">
            <div class="d-flex align-items-center py-3"><img class="mr-2" src="./assets/img/logos/qubes.jpeg" alt="" width="40" /><span class="font-sans-serif">Qubes</span>
            </div>
          </a>
        </div>
        <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
          <!--vertical navbar-->
          <?php
          include './sidenav-shared.php';
          genSideBar();
          ?>
        </div>
      </nav>
      <div class="content">
        <?php
        include './navbar-shared.php';
        ?>
        <!-- body begins here -->
        <div class="card">
          <div class="card-header bg-light">
            <h5 class="mb-0">Change My Title</h5>
          </div>
          <div class="card-body fs--1 p-4">
            <!-- Content is to start here -->
            <div class="mb-3">
              <label class="form-label" for="exampleFormControlInput1">Email address</label>
              <input class="form-control" id="exampleFormControlInput1" type="search" placeholder="name@example.com" />
            </div>
            <div class="mb-3">
              <label class="form-label" for="exampleFormControlTextarea1">Example textarea</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <!-- Content ends here -->
          </div>
        </div>
        <footer>
          <div class="row g-0 justify-content-between fs--1 mt-4 mb-3">
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 text-600">Thank you for creating with Falcon <span class="d-none d-sm-inline-block">| </span><br class="d-sm-none" /> 2021 &copy; <a href="https://themewagon.com">Themewagon</a></p>
            </div>
            <div class="col-12 col-sm-auto text-center">
              <p class="mb-0 text-600">v3.0.0-alpha11</p>
            </div>
          </div>
        </footer>
      </div>

      <!-- Modals begin here --->
      <?php
      include './includes/base_page/modal-settings.php';
      ?>
      <?php
      include './includes/base_page/modal-authentication.php';
      ?>
      <!-- End of Modals -->

    </div>
  </main>
  <script src="../vendors/popper/popper.min.js"></script>
  <script src="../vendors/bootstrap/bootstrap.min.js"></script>
  <script src="../vendors/anchorjs/anchor.min.js"></script>
  <script src="../vendors/is/is.min.js"></script>
  <script src="../vendors/fontawesome/all.min.js"></script>
  <script src="../vendors/lodash/lodash.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="../vendors/list.js/list.min.js"></script>
  <script src="../assets/js/theme.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
</body>

</html>