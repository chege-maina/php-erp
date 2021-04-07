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
      { name: "key", key: "key", visible: false },
      { name: "Code", key: "code" },
      { name: "Name", key: "name" },
      { name: "Branch", key: "branch" },
      { name: "Price", key: "price" },
      { name: "Current Unit", key: "current_unit", visible: false },
      { name: "Current Price", key: "current_price", visible: false },
      { name: "Bulk Price", key: "bulk_price", visible: false },
      { name: "Quantity", editable: true, key: "quantity" },
      { name: "Units", key: "units", selectable: true },
      { name: "Bulk Units", key: "bulk_units", visible: false },
      {
        name: "Tax %",
        key: "tax_pc",
      },
      {
        name: "Tax",
        key: "tax",
        computed: true,
        operation: "tax_pc / 100 * quantity * current_price",
      },
      {
        name: "Subtotal",
        key: "subtotal",
        computed: true,
        operation: "tax_pc / 100 + 1 * quantity * current_price",
      },
    ],
    items: [
      {
        key: "2591c05f-ed3d-48c7-8de3-25bb84ed6960",
        code: "002_001_001",
        branch: "MM1",
        name: "Kieran Griffin",
        price: 400,
        bulk_price: 4000,
        current_price: 400,
        quantity: 1,
        units: "kgs",
        current_unit: "kgs",
        bulk_units: "Bags",
        tax_pc: "10",
        tax: 0,
        subtotal: 0,
      },
      {
        key: "29969787-6b77-4613-aa85-28872ff98fe8",
        code: "001_001_002",
        branch: "MM1",
        name: "April Wilson",
        price: 344,
        bulk_price: 4053,
        current_price: 344,
        quantity: 1,
        units: "je",
        current_unit: "je",
        bulk_units: "Bags",
        tax_pc: "16",
        tax: "55.04",
        subtotal: "399.04",
      },
      {
        key: "490ed6cb-78cc-44f4-bbfb-9e50ef76d5e1",
        code: "001_001_001",
        branch: "MM1",
        name: "Brendan Huffman",
        price: 76,
        bulk_price: 4053,
        current_price: 76,
        quantity: 1,
        units: "je",
        current_unit: "je",
        bulk_units: "Bags",
        tax_pc: "0",
        tax: "0.00",
        subtotal: "76.00",
      },
      {
        key: "461a5402-606a-4949-84b2-1578853ce6a5",
        code: "002_001_001",
        branch: "MM1",
        name: "Lesley Malone",
        price: 42,
        bulk_price: 4053,
        current_price: 42,
        quantity: 1,
        units: "je",
        current_unit: "je",
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
