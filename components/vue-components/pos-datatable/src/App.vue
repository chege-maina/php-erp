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
      { name: "Code", editable: false, key: "code", computed: false },
      { name: "Name", editable: false, key: "name", computed: false },
      { name: "Price", editable: false, key: "price", computed: false },
      { name: "Quantity", editable: true, key: "quantity", computed: false },
      { name: "Units", editable: false, key: "units", computed: false },
      {
        name: "Tax %",
        editable: false,
        key: "tax_pc",
        computed: false,
      },
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
        key: "2591c05f-ed3d-48c7-8de3-25bb84ed6960",
        code: "002_001_001",
        name: "Kieran Griffin",
        price: 453,
        quantity: 1,
        units: "kgs",
        tax_pc: "16",
        tax: 0,
        subtotal: 0,
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
