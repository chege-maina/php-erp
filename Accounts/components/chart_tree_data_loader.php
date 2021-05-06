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
        // This only need be done once once the page is loaded;
        [...global_raw_data] = raw_data;

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
      // console.log("Showing: ", raw_data);
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
          type: row.parent_type,
          debit: 'parent_debit_val' in row ? row.parent_debit_val : 0,
          credit: 'parent_credit_val' in row ? row.parent_credit_val : 0,
          opening_balance: 'parent_opening_bal' in row ? row.parent_opening_bal : 0,
          closing_balance: 'parent_closing_bal' in row ? row.parent_closing_bal : 0,
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

    console.log("Processed: ", data_map);
    window.sessionStorage.setItem("items", JSON.stringify(data_map));
    const ev = new StorageEvent("storage", {
      key: "items"
    });
    window.dispatchEvent(ev);
  }

  window.sessionStorage.setItem("items", JSON.stringify(parent_children));


  let updated_items;

  function calculateTreeTotals(index) {
    console.log("Calculting totals");
    // 1. Get the index and items we can calculate totals.
    index = JSON.parse(index);
    updated_items = JSON.parse(sessionStorage.getItem("raw_data"));

    let max = 0;
    // 2. Get the longest path in the index
    for (let key in index) {
      if (index[key].length > max) {
        max = index[key].length;
      }
    }
    // console.log(max);

    // 3. With the longest path, calculate totals of in descending order
    for (let i = max; i > 0; i--) {
      // Calculate totals only for elements with length i
      for (let key in index) {
        // Only those elements with a length >= 2 can be calculated on
        if (index[key].length >= 2) {
          if (index[key].length == i) {
            // Get this node's index
            const parent_index = index[key][i - 2];
            // console.log(key, index[key], parent_index);

            // 4. With the node's index, see everywhere it appears and set its total
            updated_items.forEach(item => {
              // HACK: I realize that I should make all names unique
              // Or set the index to a numerical value if available and fallback to name
              if (item.child_title == key) {
                // We have found the item, get it's specifics
                // console.log("Adding values to parent", item);
                addValuesToParent(
                  item.parent_number,
                  'child_debit_val' in item ? Number(item.child_debit_val) : 0,
                  'child_credit_val' in item ? Number(item.child_credit_val) : 0,
                  'child_opening_bal' in item ? Number(item.child_opening_bal) : 0,
                  'child_closing_bal' in item ? Number(item.child_closing_bal) : 0,
                );
              }
            });
          }
        }
      }
    }

    // 5. Now all calculations have been done up to level 1 (0...)
    // Children who are parents, sync the debit, credit, ob, cb values
    syncToLevel2();

    // . Now update the session stored value
    window.sessionStorage.setItem("raw_data", JSON.stringify(updated_items));
    const ev = new StorageEvent("storage", {
      key: "raw_data"
    });
    window.dispatchEvent(ev);

    // raw_data.forEach(row =>
    // console.log(JSON.stringify(row, null, "  "))
    // )
  }


  function addValuesToParent(parent_id, debit, credit, opening, closing) {
    // To clean up on unecessary console log dirt
    if (debit <= 0 && credit <= 0 && opening <= 0 && closing <= 0) {
      return false;
    }
    // Look for all instances of this parent
    // console.log("Looking for instances of ", parent_id, debit, credit, opening, closing);
    // As of commit fbbac6d5b0c everything up to this line (in the hierarchy of logic flow) is okay

    for (let i = 0; i < updated_items.length; i++) {
      // If the parent is a child in this instance
      if (updated_items[i].child_number == parent_id) {
        updated_items[i]['child_debit_val'] = 'child_debit_val' in updated_items[i] ?
          Number(updated_items[i].child_debit_val) + debit : debit;
        updated_items[i]['child_credit_val'] = 'child_credit_val' in updated_items[i] ?
          Number(updated_items[i].child_credit_val) + credit : credit;
        updated_items[i]['child_opening_bal'] = 'child_opening_bal' in updated_items[i] ?
          Number(updated_items[i].child_opening_bal) + opening : opening;
        updated_items[i]['child_closing_bal'] = 'child_closing_bal' in updated_items[i] ?
          Number(updated_items[i].child_closing_bal) + closing : closing;
        // console.log("jj bb ss ", JSON.stringify(updated_items[i]));
      }
    }
  }

  function syncToLevel2() {
    console.log("Syncing to level 2");
    const index = JSON.parse(sessionStorage.getItem("index"));
    const data_map = JSON.parse(sessionStorage.getItem("items"));

    for (let key in index) {
      const item = index[key];
      // 1. Get only items in level 2
      if (item.length == 2) {
        // console.log("Here goes", item);
        // 2. Search for this item in raw data
        let item_data;
        for (let i = 0; i < updated_items.length; i++) {
          if (updated_items[i].child_title == key) {
            ({
              ...item_data
            } = updated_items[i]);
          }
        }

        // 3. Now check wherever it appears as a parent and set its totals
        for (let i = 0; i < updated_items.length; i++) {
          if (updated_items[i].parent_title == key) {
            updated_items[i]['parent_debit_val'] =
              'child_debit_val' in item_data ? item_data.child_debit_val : 0;
            updated_items[i]['parent_credit_val'] =
              'child_credit_val' in item_data ? item_data.child_credit_val : 0;
            updated_items[i]['parent_opening_bal'] =
              'child_opening_bal' in item_data ? item_data.child_opening_bal : 0;
            updated_items[i]['parent_closing_bal'] =
              'child_closing_bal' in item_data ? item_data.child_closing_bal : 0;
            // console.log("Found parent: ", updated_items[i]);
          }
        }
      }
    }
  }
</script>
