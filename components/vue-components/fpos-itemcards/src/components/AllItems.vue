<template>
  <div class="p-2 ml-3">
    <div class="row pb-4 px-4">
      <input
        id="search_term"
        type="text"
        name="search_term"
        placeholder="Search Term"
        class="form-control"
        v-model="search_term"
      />
    </div>
    <div class="row">
      <div class="col">
        {{ search_term }}
      </div>
    </div>
    <div class="row">
      <div
        class="col mx-0 mb-3 px-0"
        v-for="(item, key) in items_object"
        :key="key"
      >
        <ItemCard
          v-bind:title="item.title"
          v-bind:balance="item.balance"
          v-bind:price="item.price"
        />
      </div>
    </div>
  </div>
</template>

<script>
import ItemCard from "./ItemCard.vue";

export default {
  name: "AllItems",
  components: {
    ItemCard,
  },
  props: {
    items_json: {
      type: String,
      default: () => "[]",
    },
  },
  data: () => ({
    json_items: [
      {
        title: "Evertec, Inc.",
        balance: 306,
        price: 4420.85,
      },
      {
        title: "Anthem, Inc.",
        balance: 348,
        price: 2803.86,
      },
      {
        title: "Guggenheim ",
        balance: 344,
        price: 6047.61,
      },
      {
        title: "Travelzoo",
        balance: 300,
        price: 5652.12,
      },
      {
        title: "Mercury Systems Inc",
        balance: 928,
        price: 3799.74,
      },
      {
        title: "Central",
        balance: 916,
        price: 7928.88,
      },
      {
        title: "Nuveen",
        balance: 784,
        price: 1119.75,
      },
      {
        title: "McCormick & Company",
        balance: 395,
        price: 8748.93,
      },
      {
        title: "BioAmber Inc.",
        balance: 416,
        price: 1088.95,
      },
      {
        title: "West Marine, Inc.",
        balance: 905,
        price: 1341.35,
      },
    ],
    search_term: "",
  }),
  mounted() {
    const falcon_js = document.createElement("script");
    falcon_js.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/assets/js/theme.min.js"
    );
    const anchor_js = document.createElement("script");
    anchor_js.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/anchorjs/anchor.min.js"
    );
    const popper = document.createElement("script");
    popper.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/popper/popper.min.js"
    );
    const bootstrap = document.createElement("script");
    bootstrap.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/bootstrap/bootstrap.min.js"
    );
    const is_js = document.createElement("script");
    is_js.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/is/is.min.js"
    );
    const prism = document.createElement("script");
    prism.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/prism/prism.js"
    );
    const fontawesome = document.createElement("script");
    fontawesome.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/fontawesome/all.min.js"
    );
    const lodash = document.createElement("script");
    lodash.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/lodash/lodash.min.js"
    );
    const polyfill = document.createElement("script");
    polyfill.setAttribute(
      "src",
      "https://polyfill.io/v3/polyfill.min.js?features,window.scroll"
    );
    const list_js = document.createElement("script");
    list_js.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/list.js/list.min.js"
    );
    const config_js = document.createElement("script");
    config_js.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/assets/js/config.js"
    );

    this.$el.prepend(config_js);
    this.$el.append(
      anchor_js,
      popper,
      bootstrap,
      is_js,
      prism,
      fontawesome,
      lodash,
      polyfill,
      list_js,
      falcon_js
    );
  },
  computed: {
    items_array: function () {
      //   return JSON.parse(this.items_json);
      return this.json_items;
    },
    items_object: function () {
      let tmp = {};
      let i = 1;
      this.items_array.forEach((row) => {
        if (
          row.title.toLowerCase().search(this.search_term.toLowerCase()) != -1
        ) {
          tmp[i] = row;
        }

        i++;
      });
      return tmp;
    },
  },
  watch: {
    search_term: function () {
      console.log(this.search_term);
      let tmp = {};
      let i = 1;
      this.items_array.forEach((row) => {
        if (
          row.title.toLowerCase().search(this.search_term.toLowerCase()) != -1
        ) {
          tmp[i] = row;
        }
        i++;
      });
      console.log(tmp);
    },
  },
};
</script>

<style scoped>
@import "https://qonsolidated-solutions.github.io/falcon-assets/assets/css/theme.min.css";
</style>
