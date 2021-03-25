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
          v-bind:title="item.name"
          v-bind:balance="item.balance"
          v-bind:price="item.price"
          v-bind:image_url="item.image_url"
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
        key: 1,
        name: "Visipaque",
        code: "497-23-2865",
        stock: 9,
        quantity: 3,
        balance: 43,
        price: 5176,
        discount: 82,
        tax: 84,
        tax_pc: 0,
        subtotal: 0,
        image_url: "http://dummyimage.com/532x548.png/dddddd/000000",
      },
      {
        key: 2,
        name: "All Day",
        code: "223-32-5184",
        stock: 69,
        quantity: 2,
        balance: 92,
        price: 4296,
        discount: 3,
        tax: 89,
        tax_pc: 0,
        subtotal: -1,
        image_url: "http://dummyimage.com/516x539.png/5fa2dd/ffffff",
      },
      {
        key: 3,
        name: "Pulmo 8",
        code: "356-89-1023",
        stock: 62,
        quantity: 1,
        balance: 61,
        price: 1123,
        discount: 38,
        tax: 41,
        tax_pc: 0,
        subtotal: 0,
        image_url: "http://dummyimage.com/518x548.png/ff4444/ffffff",
      },
      {
        key: 4,
        name: "Bupropion Hydrochloride",
        code: "557-97-6362",
        stock: 98,
        quantity: 6,
        balance: 76,
        price: 7127,
        discount: 51,
        tax: 90,
        tax_pc: -1,
        subtotal: -1,
        image_url: "http://dummyimage.com/508x549.png/dddddd/000000",
      },
      {
        key: 5,
        name: "Benazepril Hydrochloride and Hydrochlorothiazide",
        code: "443-28-6453",
        stock: 77,
        quantity: 6,
        balance: 60,
        price: 8404,
        discount: 69,
        tax: 15,
        tax_pc: 0,
        subtotal: -1,
        image_url: "http://dummyimage.com/507x517.png/5fa2dd/ffffff",
      },
      {
        ke: 6,
        name: "Nartussal",
        code: "583-67-6246",
        stock: 43,
        quantity: 7,
        balance: 87,
        price: 2447,
        discount: 5,
        tax: 30,
        tax_pc: 0,
        subtotal: 0,
        image_url: "http://dummyimage.com/503x509.png/5fa2dd/ffffff",
      },
      {
        key: 7,
        name: "Argentum Nitricum 6x",
        code: "472-76-3927",
        stock: 16,
        quantity: 7,
        balance: 57,
        price: 5296,
        discount: 81,
        tax: 46,
        tax_pc: -1,
        subtotal: 0,
        image_url: "http://dummyimage.com/504x514.png/cc0000/ffffff",
      },
      {
        key: 8,
        name: "OXYGEN",
        code: "247-93-9447",
        stock: 99,
        quantity: 8,
        balance: 38,
        price: 9396,
        discount: 20,
        tax: 39,
        tax_pc: 0,
        subtotal: 0,
        image_url: "http://dummyimage.com/526x548.png/cc0000/ffffff",
      },
      {
        key: 9,
        name: "Clean and Clear Advantage",
        code: "592-14-3054",
        stock: 46,
        quantity: 3,
        balance: 83,
        price: 5156,
        discount: 57,
        tax: 76,
        tax_pc: -1,
        subtotal: 0,
        image_url: "http://dummyimage.com/526x526.png/ff4444/ffffff",
      },
      {
        key: 10,
        name: "Metronidazole",
        code: "230-96-5894",
        stock: 47,
        quantity: 3,
        balance: 30,
        price: 8585,
        discount: 35,
        tax: 30,
        tax_pc: -1,
        subtotal: 0,
        image_url: "http://dummyimage.com/528x514.png/dddddd/000000",
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
      console.log(this.search_term);
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
      console.log(tmp);
    },
  },
};
</script>

<style scoped>
@import "https://qonsolidated-solutions.github.io/falcon-assets/assets/css/theme.min.css";
</style>
