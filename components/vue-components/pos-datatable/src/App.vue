<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="card-title">Pos Component</div>
        <PosComponent
          v-bind:json_header="jsonHeader"
          v-bind:json_items="jsonBody"
        />
      </div>
    </div>
  </div>
</template>

<script>
import PosComponent from "./components/PosComponent.vue";

export default {
  name: "App",
  components: {
    PosComponent,
  },
  data: () => ({
    headers: [
      { name: "#", editable: false },
      { name: "Name", editable: false },
      { name: "Code", editable: false },
      { name: "Stock", editable: false },
      { name: "Quantity", editable: true },
      { name: "Price", editable: false },
      { name: "Discount", editable: true },
      { name: "Tax", editable: false },
      { name: "Subtotal", editable: false },
      { name: "Action", editable: false },
    ],
    items: [
      {
        index: 1,
        name: "Wiberg Super Cure",
        code: "LT38 2725 3405 4331 5052",
        stock: 59,
        quantity: 85,
        price: 13,
        discount: 40,
        tax: 17,
        subtotal: 60054,
        action: "BR",
      },
      {
        index: 2,
        name: "Bacardi Breezer - Strawberry",
        code: "PS97 QVMV EN6O KQNI FXSD SPHX ICTY H",
        stock: 23,
        quantity: 59,
        price: 68,
        discount: 84,
        tax: 3,
        subtotal: 784,
        action: "CN",
      },
      {
        index: 3,
        name: "Avocado",
        code: "LT21 2680 9565 6475 1512",
        stock: 26,
        quantity: 90,
        price: 84,
        discount: 2,
        tax: 3,
        subtotal: 57305,
        action: "CZ",
      },
      {
        index: 4,
        name: "Soup - Knorr, Country Bean",
        code: "MR92 5543 6765 4828 5308 1513 081",
        stock: 72,
        quantity: 73,
        price: 13,
        discount: 61,
        tax: 15,
        subtotal: 15940,
        action: "RU",
      },
      {
        index: 5,
        name: "Kiwi",
        code: "CY32 4469 2631 OPJT FDCH I1HF 9WEQ",
        stock: 33,
        quantity: 73,
        price: 69,
        discount: 31,
        tax: 15,
        subtotal: 15544,
        action: "BR",
      },
      {
        index: 6,
        name: "Banana - Green",
        code: "PT08 0202 1850 4474 9222 7254 5",
        stock: 99,
        quantity: 87,
        price: 54,
        discount: 100,
        tax: 7,
        subtotal: 77459,
        action: "CN",
      },
      {
        index: 7,
        name: "Bread - Burger",
        code: "CR19 0596 3701 4238 7857 0",
        stock: 85,
        quantity: 69,
        price: 74,
        discount: 79,
        tax: 11,
        subtotal: 91874,
        action: "HR",
      },
      {
        index: 8,
        name: "Bouq All Italian - Primerba",
        code: "FI31 5087 0293 5633 84",
        stock: 53,
        quantity: 85,
        price: 58,
        discount: 31,
        tax: 1,
        subtotal: 78031,
        action: "CU",
      },
      {
        index: 9,
        name: "Beef - Tender Tips",
        code: "GT18 SXNS QA5F D7D9 B8P7 TYNO 83BV",
        stock: 72,
        quantity: 100,
        price: 20,
        discount: 88,
        tax: 1,
        subtotal: 14014,
        action: "BR",
      },
      {
        index: 10,
        name: "Sachet",
        code: "MD71 SAAH ZICA HQPH 1JQP 3DEB",
        stock: 76,
        quantity: 53,
        price: 55,
        discount: 54,
        tax: 10,
        subtotal: 10191,
        action: "JP",
      },
    ],
  }),
  computed: {
    jsonHeader: function () {
      return JSON.stringify(this.headers);
    },
    jsonBody: function () {
      return JSON.stringify(this.items);
    },
  },
};
</script>
