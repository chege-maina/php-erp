<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>Falcon | Dashboard &amp; Web App Templat</title>

  <!-- ===============================================-->
  <!--    Favicons-->
  <!-- ===============================================-->
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/img/favicons/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/img/favicons/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/img/favicons/favicon-16x16.png" />
  <link rel="shortcut icon" type="image/x-icon" href="./assets/img/favicons/favicon.ico" />
  <link rel="manifest" href="./assets/img/favicons/manifest.json" />
  <meta name="msapplication-TileImage" content="./assets/img/favicons/mstile-150x150.png" />
  <meta name="theme-color" content="#ffffff" />
  <script src="./assets/js/config.js"></script>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>

  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <link href="./vendors/swiper/swiper-bundle.min.css" rel="stylesheet" />
  <link href="./assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl" />
  <link href="./assets/css/theme.min.css" rel="stylesheet" id="style-default" />
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
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>

<body style="height: 100%;
    background-image: url(./assets/img/generic/bg-1.jpg);
    height: 100%;

        /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
  ">
  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top" style="height: 100%;">
    <nav class="navbar navbar-standard navbar-expand-lg fixed-top navbar-dark" data-navbar-darken-on-scroll="data-navbar-darken-on-scroll">
      <div class="container">
        <a class="navbar-brand" href="./index.html"><span class="text-white dark__text-white">Falcon</span></a>
      </div>
    </nav>

    <!-- ============================================-->
    <!--/.bg-holder-->

    <div class="container">
      <div class="row flex-center pt-8 pt-lg-10 pb-lg-9 pb-xl-0">
        <div class="col-md-11 col-lg-8 col-xl-4 pb-7 pb-xl-9 text-center text-xl-left">
          <h1 class="text-white fw-light">
            Bring
            <span class="typed-text fw-bold" data-typed-text='["design","beauty","elegance","perfection"]'></span><br />to your webapp
          </h1>
          <p class="lead text-white opacity-75">
            With the power of Falcon, you can now focus only on
            functionaries for your digital products, while leaving the UI
            design on us!
          </p>
        </div>
        <div class="col-xl-7 offset-xl-1 align-items-end mt-4 mt-xl-0">
          <div class="form-group">
            <h1 class="text-white">Log In</h1>
            <form class="col-md-7" id="loginfrm" name="loginfrm">
              <div class="mb-3">
                <input class="form-control" type="email" data-validate="Valid email is required: ex@abc.xyz" placeholder="Email address" name="email" id="email" />
              </div>
              <div class="mb-3">
                <input class="form-control" type="password" name="password" id="password" placeholder="Password" />
              </div>
              <div class="row flex-between-center">
                <div class="col-auto">
                  <a class="fs--1" href="./authentication/basic/forgot-password.html">Forgot Password?</a>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="btn_submit" id="btn_submit" input>
                  Log in
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>


  <script>
    $(document).ready(function() {
      $('#btn_submit').click(function(e) {
        e.preventDefault();
        var name = $('#email').val();
        var passw = $('#password').val();
        var data1 = {
          email: name,
          password: passw
        }

        if (name == '' || passw == '') {
          alert("Please complete the login form!")
        } else {
          var conf = confirm("Do You Want to Log into Dashboard?")
          if (conf) {
            $.ajax({
              url: "includes/authenticate.php",
              method: "POST",
              data: data1,
              success: function(data) {
                $('#loginfrm')[0].reset();
                if(data=='Dashboard1'){
                  window.location.replace("products/add-product-ui.php");
                }
                else if(data=='Dashboard2'){
                  window.location.replace("purchase_requisitions/warehouse_add_pr.php");
                }
                else{
                alert(data)}
                
                //console.log('response:' + data);
              }
            })

          }
        }
      })


    })
  </script>


  <!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->

  <!-- ===============================================-->
  <!--    JavaScripts-->
  <!-- ===============================================-->
  <script src="./vendors/popper/popper.min.js"></script>
  <script src="./vendors/bootstrap/bootstrap.min.js"></script>
  <script src="./vendors/anchorjs/anchor.min.js"></script>
  <script src="./vendors/is/is.min.js"></script>
  <script src="./vendors/swiper/swiper-bundle.min.js"></script>
  <script src="./vendors/typed.js/typed.js"></script>
  <script src="./vendors/fontawesome/all.min.js"></script>
  <script src="./vendors/lodash/lodash.min.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
  <script src="./vendors/list.js/list.min.js"></script>
  <script src="./assets/js/theme.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet" />
</body>

</html>
