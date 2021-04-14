<script>
  const items_to_show = [{
      "name": "Assets",
      "code": 1000,
    },
    {
      "name": "Receivables",
      "code": 1100,
      "children": [{
        "name": "zeta",
        "children": [{
            "name": "alpha",
            "value": 10,
            "file": "txt"
          },
          {
            "name": "beta",
            "value": 10,
            "file": "txt"
          },
          {
            "name": "gamma",
            "value": 10,
            "file": "txt"
          },
          {
            "name": "delta",
            "value": 10,
            "file": "txt"
          },
          {
            "name": "epsilon",
            "value": 10,
            "file": "txt"
          },

        ]
      }, ],
    },
    {
      "name": "Inventory",
      "code": 1200,
      "children": [{
          "name": "static",
          "children": [{
            "name": "eta",
            "value": 10,
            "file": "txt"
          }]
        },
        {
          "name": "theta",
          "value": 10,
          "file": "txt"
        },
        {
          "name": "iota",
          "value": 10,
          "file": "txt"
        }
      ]
    },

  ];

  window.sessionStorage.clear();
  window.sessionStorage.setItem("items", JSON.stringify(items_to_show));


  console.clear();
  const root = {
    assets: [],
    receivables: ['boom', 'zeta'],
    zeta: ['alpha', 'beta', 'gamma', 'delta', 'epsilon'],
    delta: ['force', 'man'],
  };

  const created_object = {};

  createChildren(root);

  function createChildren(_map) {
    // Begin with root
    for (let key in root) {
      // Add the root
      created_object[key] = {
        name: key,
        children: []
      };
      // Check if there are children and add them
      for (let i = 0; i < root[key].length; i++) {
        const i_child = root[key][i];
        created_object[key].children.push({
          name: i_child,
          children: []
        });
        // Check if the child has children
        if (i_child in root) {
          // Add its children
          console.log(created_object[key].children[i]);
          for (let j = 0; j < root[i_child].length; j++) {
            const j_child = root[i_child][j];
            created_object[key].children[i].children.push({
              name: j_child,
              children: [],
            });

            // Check if j_child has children
            if (j_child in root) {
              console.log(created_object[key].children[i].children[j]);
              for (let k = 0; k < root[j_child].length; k++) {
                const k_child = root[j_child][k];
                created_object[key].children[i].children[j].children.push({
                  name: k_child,
                  children: [],
                });
              }
              // We've added j_child's children, now delete it from root
              delete root[j_child];
            }
            // Add the next j_child
          }
          // We've added i_child's children, now delete it from root
          delete root[i_child];
        }
        // Add the next i_child
      }
    }
  }

  console.log(JSON.stringify(created_object, null, 2));
</script>
