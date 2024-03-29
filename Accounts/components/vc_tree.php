<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

<div id="app">
  <v-app style="background-color: #121E2D00">
    <v-treeview open-all :open="initiallyOpen" :items="arrayed_tree" activatable item-key="name" open-on-click>
      <template v-slot:prepend="{ item, open }">
        <a>
          <v-icon v-if="!item.file">
            {{ open ? "mdi-folder-open" : "mdi-folder" }}
          </v-icon>
          <v-icon v-else>
            {{ files[item.file] }}
          </v-icon>
          <span v-if="item.code" class="font-weight-thin">
            {{ item.code }}
          </span>
        </a>
      </template>
      <template v-slot:append="{ item }">
        <a>
          <span>
            <small><strong>opening</strong></small>
            <span v-if="!item.opening_balance"> 0 </span>
            <span v-else>
              {{ dp2wc(item.opening_balance) }}
            </span>
          </span>


          <span style="margin-left: 1em">
            <small><strong>debit</strong></small>
            <span v-if="!item.debit"> 0 </span>
            <span v-else>{{ dp2wc(item.debit) }}</span>
          </span>

          <span style="margin-left: 1em">
            <small><strong>credit</strong></small>
            <span v-if="!item.credit"> 0 </span>
            <span v-else>{{ dp2wc(item.credit) }}</span>
          </span>

          <span style="margin-left: 1em">
            <small><strong>closing</strong></small>
            <span v-if="!item.closing_balance"> 0 </span>
            <span v-else>{{ dp2wc(item.closing_balance) }}</span>
          </span>

          <!--
          <span>
            <span v-if="!item.value"> 0 </span>
            <span v-else>
              {{ item.value }}
            </span>
          </span>

          <span>
            <span v-if="!item.type"></span>
            <span v-else>
              {{ item.type }}
            </span>
          </span>
          -->
        </a>
      </template>
    </v-treeview>
  </v-app>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script>
  new Vue({
    el: '#app',
    vuetify: new Vuetify({
      theme: {
        dark: false,
      },
    }),

    data: () => ({
      initiallyOpen: ["public"],
      darkTheme: false,
      files: {
        html: "mdi-language-html5",
        js: "mdi-nodejs",
        json: "mdi-code-json",
        md: "mdi-language-markdown",
        pdf: "mdi-file-pdf",
        png: "mdi-file-image",
        txt: "mdi-file-document-outline",
        xls: "mdi-file-excel",
      },
      root: [],
      items: [],
      index: {},
      dialog: false,
    }),
    created() {
      // Init the object that will hold the table values
      // this.items = this.body_object;
      window.addEventListener("storage", (event) => {
        // If our table data in the session storage has been changed
        if (event.key == "items") {
          this.root = JSON.parse(window.sessionStorage.getItem("items"));
        } else if (event.key == "theme") {
          const currentTheme = window.localStorage.getItem("theme");
          this.$vuetify.theme.dark = currentTheme === "dark" ? true : false;
        }
      });
    },
    mounted() {
      this.root = JSON.parse(window.sessionStorage.getItem("items"));

      const currentTheme = window.localStorage.getItem("theme");
      this.$vuetify.theme.dark = currentTheme === "dark" ? true : false;
    },
    computed: {
      arrayed_tree: function() {
        const tree_array = [];
        for (let key in this.tree) {
          tree_array.push(this.tree[key]);
        }
        return tree_array;
      },
      tree: function() {
        return this.getTreeObject();
      },
    },
    methods: {
      getTreeObject: function() {
        let created_object = {};
        // Begin with root
        for (let key in this.root) {
          // Add the this.root
          created_object[key] = {
            code: this.root[key].code,
            name: key,
            type: this.root[key].type,
            debit: 'debit' in this.root[key] ? this.root[key].debit : 0,
            credit: 'credit' in this.root[key] ? this.root[key].credit : 0,
            opening_balance: 'opening_balance' in this.root[key] ? this.root[key].opening_balance : 0,
            closing_balance: 'closing_balance' in this.root[key] ? this.root[key].closing_balance : 0,
            children: [],
          };
          // Add it to this.index
          this.index[key] = [key];

          // Check if there are children and add them
          for (let i = 0; i < this.root[key].children_to_add.length; i++) {
            const i_child = this.root[key].children_to_add[i];
            created_object[key].children.push({
              name: i_child.name,
              code: i_child.code,
              type: i_child.type,
              debit: 'debit' in i_child ? i_child.debit : 0,
              credit: 'credit' in i_child ? i_child.credit : 0,
              opening_balance: 'opening_balance' in i_child ? i_child.opening_balance : 0,
              closing_balance: 'closing_balance' in i_child ? i_child.closing_balance : 0,
              children: [],
            });
            // Add it to this.index
            this.index[i_child.name] = [this.root[key].code, i_child.name];

            // Check if the child has children
            if (i_child.name in this.root) {
              // It probably has a code, add it
              created_object[key].children[i]["code"] = this.root[
                i_child.name
              ].code;
              created_object[key].children[i]["debit"] = this.root[
                i_child.name
              ].debit;
              created_object[key].children[i]["credit"] = this.root[
                i_child.name
              ].credit;
              created_object[key].children[i]["opening_balance"] = this.root[
                i_child.name
              ].opening_balance;
              created_object[key].children[i]["closing_balance"] = this.root[
                i_child.name
              ].closing_balance;

              for (
                let j = 0; j < this.root[i_child.name].children_to_add.length; j++
              ) {
                const j_child = this.root[i_child.name].children_to_add[j];
                created_object[key].children[i].children.push({
                  name: j_child.name,
                  type: j_child.type,
                  code: j_child.code,
                  debit: 'debit' in j_child ? j_child.debit : 0,
                  credit: 'credit' in j_child ? j_child.credit : 0,
                  opening_balance: 'opening_balance' in j_child ? j_child.opening_balance : 0,
                  closing_balance: 'closing_balance' in j_child ? j_child.closing_balance : 0,
                  children: [],
                });
                // Add it to this.index
                this.index[j_child.name] = [this.root[key].code, i_child.code, j_child.name];

                // Check if j_child has children
                if (j_child.name in this.root) {
                  created_object[key].children[i].children[j]["code"] = this.root[
                    j_child.name
                  ].code;
                  for (
                    let k = 0; k < this.root[j_child.name].children_to_add.length; k++
                  ) {
                    const k_child = this.root[j_child.name].children_to_add[k];
                    created_object[key].children[i].children[j].children.push({
                      name: k_child.name,
                      type: k_child.type,
                      code: k_child.code,
                      debit: 'debit' in k_child ? k_child.debit : 0,
                      credit: 'credit' in k_child ? k_child.credit : 0,
                      opening_balance: 'opening_balance' in k_child ? k_child.opening_balance : 0,
                      closing_balance: 'closing_balance' in k_child ? k_child.closing_balance : 0,
                      children: [],
                    });
                    // Add it to this.index
                    this.index[k_child.name] = [
                      this.root[key].code,
                      i_child.code,
                      j_child.code,
                      k_child.name,
                    ];

                    if (k_child.name in this.root) {
                      created_object[key].children[i].children[j].children[k][
                        "code"
                      ] = this.root[k_child.name].code;
                      for (
                        let l = 0; l < this.root[k_child.name].children_to_add.length; l++
                      ) {
                        const l_child = this.root[k_child.name].children_to_add[
                          l
                        ];
                        created_object[key].children[i].children[j].children[
                          k
                        ].children.push({
                          name: l_child.name,
                          debit: 'debit' in l_child ? l_child.debit : 0,
                          credit: 'credit' in l_child ? l_child.credit : 0,
                          opening_balance: 'opening_balance' in l_child ? l_child.opening_balance : 0,
                          closing_balance: 'closing_balance' in l_child ? l_child.closing_balance : 0,
                          children: [],
                        });
                        // Add it to this.index
                        this.index[l_child.name] = [
                          this.root[key].code,
                          i_child.code,
                          j_child.code,
                          k_child.code,
                          l_child.name,
                        ];
                      }
                      // We've added the child, delete it from this.root
                      delete this.root[k_child.name];
                    }
                    // Add the next k_child
                  }
                  // We've added j_child's children, now delete it from this.root
                  delete this.root[j_child.name];
                }
                // Add the next j_child
              }
              // We've added i_child's children, now delete it from this.root
              delete this.root[i_child.name];
            }
            // Add the next i_child
          }
        }
        this.indexToSession();
        return created_object;
      },
      getTotals: function(tree, level, iteration) {
        const total = 0;
        if ("children" in tree) {
          tree.children.forEach((subItem) => {
            this.getTotals(subItem, level + 1, iteration++);
          });
        } else {
          console.log(`iteration ${iteration}`);
          console.log(level, " Finale ", tree);
        }
        return total;
      },
      dp2wc: function(x) { // To two decimal places with commas
        return this.numberWithCommas(Number(x).toFixed(2));
      },
      indexToSession: function() {
        window.sessionStorage.setItem("index", JSON.stringify(this.index));
        const ev = new StorageEvent("storage", {
          key: "index"
        });
        // Dispatch this event so the totals can be calculated
        window.dispatchEvent(ev);
      },
      numberWithCommas: function(x) {
        if (isNaN(x)) {
          return x;
        }
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join(".");
      },
    },
  });
</script>
