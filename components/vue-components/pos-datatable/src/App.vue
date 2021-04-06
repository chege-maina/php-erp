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
      { name: "key", key: "key" },
      { name: "Code", key: "code" },
      { name: "Name", key: "name" },
      { name: "Price", key: "price" },
      { name: "Bulk Price", key: "bulk_price", visible: false },
      { name: "Quantity", key: "quantity" },
      { name: "Units", key: "units" },
      { name: "Bulk Units", key: "bulk_units", visible: false },
      {
        name: "Tax %",
        key: "tax_pc",
      },
      {
        name: "Tax",
        key: "tax",
        computed: true,
        operation: "tax_pc / 100 * quantity * price",
      },
      {
        name: "Subtotal",
        key: "subtotal",
        computed: true,
        operation: "tax_pc / 100 + 1 * quantity * price",
      },
    ],
    items: [
      {
        key: "2591c05f-ed3d-48c7-8de3-25bb84ed6960",
        code: "002_001_001",
        name: "Kieran Griffin",
        price: 453,
        bulk_price: 4053,
        quantity: 1,
        units: "kgs",
        bulk_units: "Bags",
        tax_pc: "16",
        tax: 0,
        subtotal: 0,
      },
      {
        key: "29969787-6b77-4613-aa85-28872ff98fe8",
        code: "001_001_002",
        name: "April Wilson",
        price: 344,
        bulk_price: 4053,
        quantity: 1,
        units: "je",
        bulk_units: "Bags",
        tax_pc: "16",
        tax: "55.04",
        subtotal: "399.04",
      },
      {
        key: "490ed6cb-78cc-44f4-bbfb-9e50ef76d5e1",
        code: "001_001_001",
        name: "Brendan Huffman",
        price: 76,
        bulk_price: 4053,
        quantity: 1,
        units: "je",
        bulk_units: "Bags",
        tax_pc: "0",
        tax: "0.00",
        subtotal: "76.00",
      },
      {
        key: "461a5402-606a-4949-84b2-1578853ce6a5",
        code: "002_001_001",
        name: "Lesley Malone",
        price: 42,
        bulk_price: 4053,
        quantity: 1,
        units: "je",
        bulk_units: "Bags",
        tax_pc: "14",
        tax: "5.88",
        subtotal: "47.88",
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
