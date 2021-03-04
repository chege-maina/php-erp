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

    function getHeaders(data) {
      let table_headers = [];
      if (data.length <= 0) {
        return;
      }

      for (key in data[0]) {
        let name = "";
        key.split("_").forEach(value => {
          name += " " + value;
        });

        table_headers.push({
          name: name.trim(),
          editable: false,
          key: key,
          computed: false
        });
      }
      return table_headers;
    }


    function getItems(data) {
      let table_items_c = [];
      let i = 0;
      data.forEach(row => {
        let tmp_row = {};
        tmp_row["key"] = i++;
        for (key in row) {
          tmp_row[key] = row[key];
        }
        table_items_c.push(tmp_row);
      });
      return table_items_c;
    }

    function getBaseUrl() {
      // HACK: This is to accomadate xampp devs
      const path = window.location.pathname.split('/');
      let xampp_offset = "";
      if (path.length > 3) {
        xampp_offset = "/" + path[1];
      }
      const url = window.location.href.split(window.location.host)[0] + window.location.host + xampp_offset;
      return url;
    }
  </script>
</head>
