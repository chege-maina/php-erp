<template>
  <div id="app">
    <AllItems
      v-bind:items_json="JSON.stringify(json_items)"
      style="width: 50rem"
    />
    <!-- {{ json_items }} -->
  </div>
</template>

<script>
import AllItems from "./components/AllItems.vue";

export default {
  name: "App",
  components: {
    AllItems,
  },
  data: () => ({
    json_items: [
      {
        title: "Evertech, Inc.",
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
  }),
};
</script>
