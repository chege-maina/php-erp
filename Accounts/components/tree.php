<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

<div id="app">
  <v-app style="background-color: #121E2D00">
    <v-treeview v-model="tree" :open="initiallyOpen" :items="items" activatable item-key="name" open-on-click>
      <template v-slot:prepend="{ item, open }">
        <a @click="itemClicked(item.name)">
          <v-icon v-if="!item.file">
            {{ open ? 'mdi-folder-open' : 'mdi-folder' }}
          </v-icon>
          <v-icon v-else>
            {{ files[item.file] }}
          </v-icon>
          <span v-if="item.code" class="font-weight-thin">
            {{ item.code }}
          </span>

        </a>
      </template>
      <template v-slot:append="{ item, open }">
        <a @click="itemClicked(item.name)">
          <span v-if="!item.value">
            0
          </span>
          <span v-else>
            {{ item.value }}
          </span>
        </a>
      </template>
    </v-treeview>
    <v-container>
      <v-btn color="primary" elevation="2" v-on:click="buttonClicked()">Calculate</v-btn>
    </v-container>
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
      initiallyOpen: ['public'],
      darkTheme: false,
      files: {
        html: 'mdi-language-html5',
        js: 'mdi-nodejs',
        json: 'mdi-code-json',
        md: 'mdi-language-markdown',
        pdf: 'mdi-file-pdf',
        png: 'mdi-file-image',
        txt: 'mdi-file-document-outline',
        xls: 'mdi-file-excel',
      },
      tree: [],
      items: [],
    }),
    created() {
      // Init the object that will hold the table values
      // this.items = this.body_object;
      window.addEventListener("storage", (event) => {
        // If our table data in the session storage has been changed
        if (event.key == 'items') {
          this.items = JSON.parse(
            window.sessionStorage.getItem('items')
          );
        } else if (event.key == 'theme') {
          const currentTheme = window.localStorage.getItem('theme')
          this.$vuetify.theme.dark = currentTheme === 'dark' ? true : false;
        }
      });
    },
    mounted() {
      this.items = JSON.parse(
        window.sessionStorage.getItem('items')
      );

      const currentTheme = window.localStorage.getItem('theme')
      this.$vuetify.theme.dark = currentTheme === 'dark' ? true : false;
    },
    methods: {
      itemClicked: function(item) {
        console.log("You clicked: ", item);
      },
      getTotals: function(tree, level, iteration) {
        const total = 0;
        if ('children' in tree) {
          tree.children.forEach(subItem => {
            this.getTotals(subItem, level + 1, iteration++);
          });
        } else {
          console.log(`iteration ${iteration}`)
          console.log(level, " Finale ", tree);
        }
      },
      buttonClicked: function(item) {
        this.items.forEach(item => {
          this.getTotals(item, 0, 1);
        });
      },
    },
  })
</script>