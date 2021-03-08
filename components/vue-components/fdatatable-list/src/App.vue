<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="card-title">New Stuff</div>
        <PosComponent
          v-bind:json_header="jsonHeader"
          v-bind:json_items="jsonBody"
          manage_key="code"
          redirect="http://localhost:5000/customer/add_customer_ui.php"
        />
      </div>
    </div>
  </div>
</template>

<script>
import PosComponent from "./components/DataTableList.vue";

export default {
  name: "App",
  components: {
    PosComponent,
  },
  data: () => ({
    headers: [
      { name: "key", editable: false, key: "key", computed: false },
      { name: "Name", editable: false, key: "name", computed: false },
      { name: "Code", editable: false, key: "code", computed: false },
      { name: "Stock", editable: false, key: "stock", computed: false },
      { name: "Quantity", editable: false, key: "quantity", computed: false },
      { name: "Price", editable: false, key: "price", computed: false },
      { name: "Discount", editable: false, key: "discount", computed: false },
      { name: "Tax %", editable: false, key: "tax_pc", computed: false },
      {
        name: "Tax",
        editable: false,
        key: "tax",
        computed: true,
        operation: "tax_pc / 100 * quantity * price",
      },
      {
        name: "Subtotal",
        editable: false,
        key: "subtotal",
        computed: true,
        operation: "tax_pc / 100 + 1 * quantity * price",
      },
    ],
    items: [
      {
        key: 1,
        name: "Fabaceae",
        code: "485922360-8",
        stock: 578,
        quantity: 797,
        price: 31406,
        discount: 100,
        tax_pc: 63,
        tax: 814,
        subtotal: 4789,
      },
      {
        key: 2,
        name: "Dicranaceae",
        code: "608631511-6",
        stock: 833,
        quantity: 492,
        price: 9035,
        discount: 4,
        tax_pc: 95,
        tax: 110,
        subtotal: 2934,
      },
      {
        key: 3,
        name: "Arecaceae",
        code: "652200438-0",
        stock: 620,
        quantity: 402,
        price: 7264,
        discount: 24,
        tax_pc: 63,
        tax: 287,
        subtotal: 514,
      },
      {
        key: 4,
        name: "Hydrophyllaceae",
        code: "237646359-9",
        stock: 751,
        quantity: 210,
        price: 21235,
        discount: 24,
        tax_pc: 60,
        tax: 443,
        subtotal: 4466,
      },
      {
        key: 5,
        name: "Malvaceae",
        code: "636124992-1",
        stock: 110,
        quantity: 906,
        price: 13923,
        discount: 16,
        tax_pc: 21,
        tax: 526,
        subtotal: 8392,
      },
      {
        key: 6,
        name: "Graphidaceae",
        code: "359489994-2",
        stock: 51,
        quantity: 336,
        price: 60859,
        discount: 16,
        tax_pc: 9,
        tax: 500,
        subtotal: 90,
      },
      {
        key: 7,
        name: "Cyperaceae",
        code: "937363139-X",
        stock: 924,
        quantity: 153,
        price: 75650,
        discount: 73,
        tax_pc: 4,
        tax: 920,
        subtotal: 3648,
      },
      {
        key: 8,
        name: "Saxifragaceae",
        code: "698585797-3",
        stock: 98,
        quantity: 568,
        price: 49039,
        discount: 53,
        tax_pc: 37,
        tax: 22,
        subtotal: 1514,
      },
      {
        key: 9,
        name: "Saxifragaceae",
        code: "661750505-0",
        stock: 598,
        quantity: 973,
        price: 92279,
        discount: 59,
        tax_pc: 32,
        tax: 919,
        subtotal: 9836,
      },
      {
        key: 10,
        name: "Asteraceae",
        code: "477705771-2",
        stock: 506,
        quantity: 989,
        price: 26475,
        discount: 31,
        tax_pc: 25,
        tax: 657,
        subtotal: 83,
      },
      {
        key: 11,
        name: "Lamiaceae",
        code: "309151253-3",
        stock: 35,
        quantity: 446,
        price: 72912,
        discount: 79,
        tax_pc: 100,
        tax: 636,
        subtotal: 3589,
      },
      {
        key: 12,
        name: "Fabaceae",
        code: "497017697-3",
        stock: 25,
        quantity: 911,
        price: 18903,
        discount: 83,
        tax_pc: 36,
        tax: 741,
        subtotal: 46,
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
