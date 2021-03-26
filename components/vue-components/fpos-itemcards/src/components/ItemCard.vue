<template>
  <div
    class="card overflow-hidden"
    style="width: 9rem"
    v-on:click="itemClicked()"
  >
    <div class="card-img-top">
      <img class="img-fluid" v-bind:src="image_url" alt="Card image cap" />
    </div>
    <div class="card-body m-0 p-2 pl-3 pb-3">
      <h6 class="card-title">{{ title }}</h6>
      <h6 class="card-subtitle mb-1 text-muted">Remaining {{ balance }}</h6>
      <hr class="my-2" />
      <div class="text-muted mt-1">
        <strong style="font-size: 0.9em">{{ price }}</strong> <small>kes</small>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    product_json: {
      type: String,
      default: () => "",
    },
    title: {
      type: String,
      default: () => "Title",
    },
    balance: {
      type: Number,
      default: () => "20",
    },
    price: {
      type: Number,
      default: () => "35,000",
    },
    image_url: {
      type: String,
      default: () => "",
    },
  },
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
    product_object: function () {
      return JSON.parse(this.product_json);
    },
  },
  methods: {
    itemClicked: function () {
      console.log(this.title, " : ", this.uuid(), " : ", this.product_object);
      window.sessionStorage.setItem("table_data", this.product_json);
    },
    uuid: function () {
      return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, (c) =>
        (
          c ^
          (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4)))
        ).toString(16)
      );
    },
  },
};
</script>

<style>
@import "https://qonsolidated-solutions.github.io/falcon-assets/assets/css/theme.min.css";
</style>
