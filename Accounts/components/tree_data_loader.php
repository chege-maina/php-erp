<script>
  const parent_children = {
    assets: {
      code: 1000,
      children_to_add: []
    },
    receivables: {
      code: 1100,
      children_to_add: [{
        name: 'boom'
      }, {
        name: 'zeta'
      }],
    },
    zeta: {
      code: 1200,
      children_to_add: [{
          name: 'alpha'
        },
        {
          name: 'beta'
        },
        {
          name: 'gamma'
        },
        {
          name: 'delta'
        },
        {
          name: 'epsilon'
        },
      ],
    },
    delta: {
      code: 1300,
      children_to_add: [{
        name: 'force'
      }, {
        name: 'mean'
      }]
    },
    mean: {
      code: 1400,
      children_to_add: [{
        name: 'chili'
      }]
    },
  };

  let raw_data = [];

  window.addEventListener('DOMContentLoaded', (event) => {
    fetch('./php_scripts/get_chart.php')
      .then(response => response.json())
      .then(data => {
        [...raw_data] = data;

        window.sessionStorage.setItem("raw_data", JSON.stringify(raw_data));
        const ev = new StorageEvent("storage", {
          key: "raw_data"
        });
        window.dispatchEvent(ev);
      })
      .catch((error) => {
        console.error('Error:', error);
      });
  });

  window.addEventListener("storage", (event) => {
    // If our table data in the session storage has been changed
    if (event.key == "raw_data") {
      let raw_data = window.sessionStorage.getItem("raw_data");
      raw_data = JSON.parse(raw_data);
      convertRawDataToMap(raw_data);
    }
  });

  function convertRawDataToMap(data) {
    let data_map = {};
    data.forEach(row => {
      data_map[row.parent_title] = row.parent_title in data_map ?
        data_map[row.parent_title] : {
          code: row.parent_number,
          children_to_add: [],
          type: row.parent_type
        };
      data_map[row.parent_title].children_to_add.push({
        name: row.child_title,
        code: row.child_number,
        type: row.child_type
      });
    });

    window.sessionStorage.setItem("items", JSON.stringify(data_map));
    const ev = new StorageEvent("storage", {
      key: "items"
    });
    window.dispatchEvent(ev);
  }

  window.sessionStorage.clear();
  window.sessionStorage.setItem("items", JSON.stringify(parent_children));
</script>
