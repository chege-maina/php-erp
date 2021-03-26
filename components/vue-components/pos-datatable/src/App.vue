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
      { name: "key", editable: false, key: "key", computed: false },
      { name: "Name", editable: false, key: "name", computed: false },
      { name: "Code", editable: false, key: "code", computed: false },
      { name: "Stock", editable: false, key: "stock", computed: false },
      { name: "Quantity", editable: true, key: "quantity", computed: false },
      { name: "Price", editable: false, key: "price", computed: false },
      { name: "Discount", editable: true, key: "discount", computed: false },
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
        key: "1A2sV3CXamtjcYY8pGfCYuS5XCaYuGeZJj",
        name: "Utopia",
        code: "074187605-1",
        stock: 14,
        quantity: 11,
        price: 30,
        discount: 23,
        tax_pc: 14,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "17ctqtzDLhaW5TKsrFV4pvxhgC1ukhPaMx",
        name: "Contracted",
        code: "462102980-0",
        stock: 7,
        quantity: 94,
        price: 40,
        discount: 9,
        tax_pc: 74,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "14M2zc3SfgXC397KvFN4pfvQug9bJ463YG",
        name: "Abbott and Costello Meet the Keystone Kops",
        code: "269056097-6",
        stock: 98,
        quantity: 42,
        price: 70,
        discount: 78,
        tax_pc: 64,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "1ALyiowNTeZsEUveYABBbUNxMed3P18H1P",
        name: "Running Mates",
        code: "228111853-3",
        stock: 57,
        quantity: 92,
        price: 16,
        discount: 43,
        tax_pc: 25,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "1ERKcCnKvQgwY37xodjcDzfE3B94Dyncph",
        name: "Tomorrow Night",
        code: "456871913-5",
        stock: 9,
        quantity: 60,
        price: 11,
        discount: 24,
        tax_pc: 71,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "1H4vEvfLBCjTTmB1WgS38zFnmHazmYYJdA",
        name: "Populaire",
        code: "101432198-0",
        stock: 49,
        quantity: 83,
        price: 79,
        discount: 57,
        tax_pc: 74,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "19JErH26bLHvQ85wcwP1YUsJEqbQLftYpc",
        name: "Spy Hard",
        code: "813552355-6",
        stock: 95,
        quantity: 73,
        price: 5,
        discount: 42,
        tax_pc: 74,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "16z6DpN6jtbDyptvoKkqjJp3mCQ9V2qtyo",
        name: "Perfect Family, The",
        code: "471732446-3",
        stock: 62,
        quantity: 13,
        price: 47,
        discount: 40,
        tax_pc: 59,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "121nD5PTM2rCXpF6boRKYTZqMHyWTfYCSS",
        name: "Booty Call",
        code: "544370333-1",
        stock: 41,
        quantity: 79,
        price: 67,
        discount: 94,
        tax_pc: 38,
        tax: -1,
        subtotal: 60054,
      },
      {
        key: "1FCjS7QifpKVWf3fjCUX2cMWykAoKRNEfb",
        name: "Spiral",
        code: "155060569-0",
        stock: 16,
        quantity: 18,
        price: 19,
        discount: 84,
        tax_pc: 66,
        tax: -1,
        subtotal: 60054,
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
