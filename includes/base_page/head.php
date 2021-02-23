<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">


  <!-- ===============================================-->
  <!--    Document Title-->
  <!-- ===============================================-->
  <title>ERP</title>


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
  <script src="../assets/js/jquery-3.5.1.js"></script>
  <script src="../assets/js/autoNumeric.js"></script>

  <!-- ===============================================-->
  <!--    Stylesheets-->
  <!-- ===============================================-->
  <link href="../assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
  <link href="../assets/css/theme.min.css" rel="stylesheet" id="style-default">
  <style>
    .hide-this {
      display: none;
    }
  </style>
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

    const commify = (input_element, helper_element) => {
      const h_e = new AutoNumeric(helper_element, {
        currencySymbol: '',
        minimumValue: 0
      });
      const i_e = document.querySelector(input_element);
      const h_e_v = document.querySelector(helper_element);
      h_e_v.addEventListener("keyup", () => {
        i_e.value = h_e.getNumericString();
      });

      return [i_e, h_e];
    }

    function addDays(date_v, days) {
      return new Date(date_v.getTime() + ((Number(days)) * 24 * 60 * 60 * 1000));
    }

    const populateDatalist = (path, elem, key_main = "name", key_sub_1 = null, testing = false) => {
      elem = document.querySelector("#" + elem);
      fetch(path)
        .then(response => response.json())
        .then(result => {
          if (testing) {
            console.log('Success:', result);
            return;
          }
          result.forEach((value) => {
            let opt = document.createElement("option");
            opt.value = value[key_main];
            if (key_sub_1 !== null) {
              opt.appendChild(document.createTextNode(key_sub_1 + ": " + value[key_sub_1]));
            } else {
              opt.appendChild(document.createTextNode(value[key_main]));
            }
            elem.appendChild(opt);
          });
          return result;
        })
        .catch(error => {
          console.error('Error:', error);
        });
    }


    function d_toString(value) {
      return value < 10 ? '0' + value : String(value);
    }
  </script>
</head>