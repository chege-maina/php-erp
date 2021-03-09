<template>
  <div id="app">
    <ItemCard msg="Welcome to Your Vue.js App" />
  </div>
</template>

<script>
import ItemCard from "./components/ItemCard.vue";

export default {
  name: "App",
  components: {
    ItemCard,
  },
};
</script>
