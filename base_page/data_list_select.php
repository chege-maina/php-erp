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