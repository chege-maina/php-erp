<template>
  <div class="p-2 ml-3" style="width: 50rem">
    <div class="row">
      <div class="col mx-0 px-0">
        <ItemCard msg="Welcome to Your Vue.js App" />
      </div>
      <div class="col mx-0 px-0">
        <ItemCard msg="Welcome to Your Vue.js App" />
      </div>
      <div class="col mx-0 px-0">
        <ItemCard msg="Welcome to Your Vue.js App" />
      </div>
      <div class="col mx-0 px-0">
        <ItemCard msg="Welcome to Your Vue.js App" />
      </div>
      <div class="col mx-0 px-0">
        <ItemCard msg="Welcome to Your Vue.js App" />
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
};
</script>
