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
  let global_raw_data = [];

  window.addEventListener('DOMContentLoaded', (event) => {
    fetch('./php_scripts/vc_get_chart.php')
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
      [...global_raw_data] = raw_data;
      convertRawDataToMap(raw_data);
    } else if (event.key == "index") {
      calculateTreeTotals(window.sessionStorage.getItem("index"));
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
      if (row.child_number == "null" && row.child_title == "null" && row.child_type == "null") {
        return;
      } else {
        data_map[row.parent_title].children_to_add.push({
          name: row.child_title,
          code: row.child_number,
          type: row.child_type,
          debit: 'child_debit_val' in row ? row.child_debit_val : 0,
          credit: 'child_credit_val' in row ? row.child_credit_val : 0,
          opening_balance: 'child_opening_bal' in row ? row.child_opening_bal : 0,
          closing_balance: 'child_closing_bal' in row ? row.child_closing_bal : 0,
        });
      }
    });

    window.sessionStorage.setItem("items", JSON.stringify(data_map));
    const ev = new StorageEvent("storage", {
      key: "items"
    });
    window.dispatchEvent(ev);
  }

  window.sessionStorage.setItem("items", JSON.stringify(parent_children));

  function calculateTreeTotals(index) {
    console.log("Calculting totals");
    // 1. Get the index and items we can calculate totals.
    index = JSON.parse(index);
    const items = JSON.parse(sessionStorage.getItem("raw_data"));

    let max = 0;
    // 2. Get the longest path in the index
    for (let key in index) {
      if (index[key].length > max) {
        max = index[key].length;
      }
    }
    console.log(max);

    // 3. With the longest path, calculate totals of in descending order
    for (let i = max; i > 0; i--) {
      // Calculate totals only for elements with length i
      for (let key in index) {
        if (index[key].length == i) {
          console.log(index[key]);
        }
      }
    }
  }
</script>
