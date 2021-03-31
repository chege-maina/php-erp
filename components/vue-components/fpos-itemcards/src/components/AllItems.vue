<template>
  <div class="ml-3">
    <div class="row pb-4 px-2">
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
      <div
        class="col mx-0 mb-3 px-0"
        v-for="(item, key) in items_object"
        :key="key"
      >
        <ItemCard
          v-bind:title="item.name"
          v-bind:balance="item.balance"
          v-bind:price="item.price"
          v-bind:image_url="item.image_url"
          v-bind:product_json="JSON.stringify(item)"
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
      return JSON.parse(this.items_json);
    },
    items_object: function () {
      let tmp = {};
      let i = 1;
      this.items_array.forEach((row) => {
        if (
          row.name.toLowerCase().search(this.search_term.toLowerCase()) != -1
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
      let tmp = {};
      let i = 1;
      this.items_array.forEach((row) => {
        if (
          row.name.toLowerCase().search(this.search_term.toLowerCase()) != -1
        ) {
          tmp[i] = row;
        }
        i++;
      });
    },
  },
};
</script>

<style scoped>
@import "https://qonsolidated-solutions.github.io/falcon-assets/assets/css/theme.min.css";
</style>
