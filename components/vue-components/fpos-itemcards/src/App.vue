<template>
  <div id="app">
    <AllItems msg="Welcome to Your Vue.js App" />
  </div>
</template>

<script>
import AllItems from "./components/AllItems.vue";

export default {
  name: "App",
  components: {
    AllItems,
  },
};
</script>
