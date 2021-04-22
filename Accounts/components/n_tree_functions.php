<script>
  let root = {};
  let index = {};
  let deepest_of_them = {};

  window.addEventListener("storage", (event) => {
    // If our table data in the session storage has been changed
    if (event.key == "items") {
      root = JSON.parse(window.sessionStorage.getItem("items"));
      getTreeObject();

      const ev = new CustomEvent('populate_groups', {
        detail: JSON.stringify(deepest_of_them)
      });
      window.dispatchEvent(ev);
      // console.log("Deepest ", deepest_of_them);
    }
  });

  // Scripts go here
  function getTreeObject() {
    let created_object = {};
    // Begin with root
    for (let key in root) {
      // Add the root
      created_object[key] = {
        code: root[key].code,
        name: key,
        type: root[key].type,
        children: [],
      };
      // Add it to index
      index[key] = [key];

      // Check if there are children and add them
      for (let i = 0; i < root[key].children_to_add.length; i++) {
        const i_child = root[key].children_to_add[i];
        created_object[key].children.push({
          name: i_child.name,
          code: i_child.code,
          type: i_child.type,
          children: [],
        });
        // Add it to index
        index[i_child.name] = [key, i_child.name];

        // Check if the child has children
        if (i_child.name in root) {
          // It probably has a code, add it
          created_object[key].children[i]["code"] = root[
            i_child.name
          ].code;
          for (
            let j = 0; j < root[i_child.name].children_to_add.length; j++
          ) {
            const j_child = root[i_child.name].children_to_add[j];
            created_object[key].children[i].children.push({
              name: j_child.name,
              type: j_child.type,
              code: j_child.code,
              children: [],
            });
            // Add it to index
            index[j_child.name] = [key, i_child.name, j_child.name];

            // Check if j_child has children
            if (j_child.name in root) {
              created_object[key].children[i].children[j]["code"] = root[
                j_child.name
              ].code;
              for (
                let k = 0; k < root[j_child.name].children_to_add.length; k++
              ) {
                const k_child = root[j_child.name].children_to_add[k];
                created_object[key].children[i].children[j].children.push({
                  name: k_child.name,
                  type: k_child.type,
                  code: k_child.code,
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
                    "code"
                  ] = root[k_child.name].code;
                  for (
                    let l = 0; l < root[k_child.name].children_to_add.length; l++
                  ) {
                    const l_child = root[k_child.name].children_to_add[
                      l
                    ];
                    created_object[key].children[i].children[j].children[
                      k
                    ].children.push({
                      name: l_child.name,
                      children: [],
                    });
                    // Add it to index
                    index[l_child.name] = [
                      key,
                      i_child.name,
                      j_child.name,
                      k_child.name,
                      l_child.name,
                    ];

                    // All l_childs are the deepest_of_them
                    deepest_of_them[l_child.code] = l_child;
                  }
                  // We've added the child, delete it from root
                  delete root[k_child.name];
                } else {
                  // k_child k not in root, add it to our deepest_of_them
                  deepest_of_them[k_child.code] = k_child;
                }
                // Add the next k_child
              }
              // We've added j_child's children, now delete it from root
              delete root[j_child.name];
            } else {
              // j_child j not in root, add it to our deepest_of_them
              deepest_of_them[j_child.code] = j_child;
            }
            // Add the next j_child
          }
          // We've added i_child's children, now delete it from root
          delete root[i_child.name];
        } else {
          // i_child i not in root, add it to our deepest_of_them
          deepest_of_them[i_child.code] = i_child;
        }
        // Add the next i_child
      }
    }
    return created_object;
  };
</script>
