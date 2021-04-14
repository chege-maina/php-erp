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
        name: 'man'
      }]
    },
  };

  const created_object = {};
  const index = {};

  createChildren(root);


  const object_to_array = [];
  for (let key in created_object) {
    object_to_array.push(created_object[key]);
  }
  window.sessionStorage.setItem("items", JSON.stringify(object_to_array));

  function createChildren(_map) {
    // Begin with root
    for (let key in root) {
      // Add the root
      created_object[key] = {
        code: root[key].code,
        name: key,
        children: []
      };
      // Add it to index
      index[key] = [key];

      // Check if there are children and add them
      for (let i = 0; i < root[key].children_to_add.length; i++) {
        const i_child = root[key].children_to_add[i];
        created_object[key].children.push({
          name: i_child.name,
          children: [],
        });
        // Add it to index
        index[i_child.name] = [key, i_child.name];

        // Check if the child has children
        if (i_child.name in root) {
          // It probably has a code, add it
          created_object[key].children[i]['code'] = root[i_child.name].code;
          for (let j = 0; j < root[i_child.name].children_to_add.length; j++) {
            const j_child = root[i_child.name].children_to_add[j];
            created_object[key].children[i].children.push({
              name: j_child.name,
              children: [],
            });
            // Add it to index
            index[j_child.name] = [key, i_child.name, j_child.name];

            // Check if j_child has children
            if (j_child.name in root) {
              created_object[key].children[i].children[j]['code'] =
                root[j_child.name].code;
              for (
                let k = 0; k < root[j_child.name].children_to_add.length; k++
              ) {
                const k_child = root[j_child.name].children_to_add[k];
                created_object[key].children[i].children[j].children.push({
                  name: k_child.name,
                  children: [],
                });
                // Add it to index
                index[k_child.name] = [
                  key,
                  i_child.name,
                  j_child.name,
                  k_child.name,
                ];
              }
              // We've added j_child's children, now delete it from root
              delete root[j_child.name];
            }
            // Add the next j_child
          }
          // We've added i_child's children, now delete it from root
          delete root[i_child.name];
        }
        // Add the next i_child
      }
    }
  }

  console.log(JSON.stringify(created_object, null, 4));
  // console.log(JSON.stringify(index, null, 2));
</script>
