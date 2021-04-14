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

  const created_object = {};
  const index = {};

  createChildren(parent_children);


  const object_to_array = [];
  for (let key in created_object) {
    object_to_array.push(created_object[key]);
  }
  window.sessionStorage.setItem("items", JSON.stringify(object_to_array));

  function createChildren(root) {
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

                if (k_child.name in root) {
                  created_object[key].children[i].children[j].children[k][
                    'code'
                  ] = root[k_child.name].code;
                  for (
                    let l = 0; l < root[k_child.name].children_to_add.length; l++
                  ) {
                    const l_child = root[k_child.name].children_to_add[l];
                    created_object[key].children[i].children[j].children[
                      k
                    ].children.push({
                      name: l_child.name,
                      children: [],
                    });
                    // Add it to index
                    index[j_child.name] = [
                      key,
                      i_child.name,
                      j_child.name,
                      k_child.name,
                      l_child.name,
                    ];
                  }
                  // We've added the child, delete it from root
                  delete root[k_child.name];
                }
                // Add the next k_child
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
</script>
