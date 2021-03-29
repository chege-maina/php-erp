<script>
  function initSelectElement(elem, init_text = "-- Select --") {
    elem = document.querySelector(elem);
    let opt = document.createElement("option");
    opt.appendChild(document.createTextNode(init_text));
    opt.setAttribute("value", "");
    opt.setAttribute("disabled", "");
    opt.setAttribute("selected", "");
    elem.appendChild(opt);
  }

  function populateSelectElement(elem, url_path, key_name, testing = false) {
    elem = document.querySelector(elem);

    fetch(url_path)
      .then(response => response.json())
      .then(data => {
        if (testing) {
          console.log(url_path, data);
          return;
        }
        data.forEach((value) => {
          let opt = document.createElement("option");
          opt.appendChild(document.createTextNode(value[key_name]));
          opt.value = value[key_name];
          elem.appendChild(opt);
        });
      })
      .catch((error) => {
        console.error('Error:', error);
      });

  }
</script>

<script>
  let commifyAll = () => {
    const numbers = document.querySelectorAll(".commify");
    numbers.forEach((element) => {

      const h_e = new AutoNumeric(element.childNodes[1], {
        currencySymbol: '',
        // minimumValue: 0
      });

      const real_input = document.createElement("input");
      real_input.setAttribute("type", "number");
      real_input.setAttribute("id", element.childNodes[1].dataset.commify);
      real_input.setAttribute("type", "text");
      real_input.setAttribute("name", "ctrl_" + String((Math.random() * 100000).toFixed(0)));
      real_input.classList.add("hide-this");
      element.appendChild(real_input);

      element.childNodes[1].addEventListener("keyup", () => {
        real_input.value = h_e.getNumericString();
      });

      // Sample expected element layout
      // <div class="column">
      // <label for="account_number" class="label">Account Number</label>
      // <div class="control commify">
      // <input type="text" class="input" required placeholder="Account number" data-commify="account_number">
      // </div>

      console.log(element.childNodes[1].dataset);
    });
  }

  function showSuccessAlert(message) {
    const alert_div = document.querySelector("#alert-div");
    let text = `
<article class="alert alert-success mt-3">
  <strong>Success: </strong> ${message}
</article>
`
    alert_div.innerHTML = text
  }


  let alert_div;
  window.addEventListener('DOMContentLoaded', (event) => {
    alert_div = document.querySelector("#alert-div");
  });

  function showDangerAlert(message) {
    let text = `
<article class="alert alert-danger mt-3">
  <strong>Error: </strong> ${message}
</article>
`
    alert_div.innerHTML = text
  }

  function showInfoAlert(message) {
    let text = `
<article class="alert alert-warning mt-3">
  <strong>Error: </strong> ${message}
</article>
`
    alert_div.innerHTML = text
  }

  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  function removeAlert(wait_time = 2500) {
    window.setTimeout(() => {
      alert_div.innerHTML = "";
    }, wait_time);
  }

  function reloadPage(wait_time = 2500) {
    window.setTimeout(() => {
      location.reload()
    }, wait_time);
  }


  function initSelectElement(elem, init_text = "-- Select --") {
    elem = document.querySelector(elem);
    let opt = document.createElement("option");
    opt.appendChild(document.createTextNode(init_text));
    opt.setAttribute("value", "");
    opt.setAttribute("disabled", "");
    opt.setAttribute("selected", "");
    elem.appendChild(opt);
  }

  function populateSelectElement(elem, url_path, key_name, testing = false) {
    elem = document.querySelector(elem);

    fetch(url_path)
      .then(response => response.json())
      .then(data => {
        if (testing) {
          console.log(url_path, data);
          return;
        }
        data.forEach((value) => {
          let opt = document.createElement("option");
          opt.appendChild(document.createTextNode(value[key_name]));
          opt.value = value[key_name];
          elem.appendChild(opt);
        });
      })
      .catch((error) => {
        console.error('Error:', error);
      });

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

  function getHeaders(data) {
    let table_headers = [];
    if (data.length <= 0) {
      return;
    }

    for (key in data[0]) {
      let name = "";
      key.split("_").forEach(value => {
        name += " " + capitalizeFirstLetter(value);
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

  function numberWithCommas(x) {
    if (isNaN(x)) {
      return x;
    }
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
  }

  window.addEventListener('DOMContentLoaded', (event) => {
    window.localStorage.setItem("theme", "light");
  });
</script>