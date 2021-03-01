<template>
  <div class="container">
    <div class="card">
      <div class="card-body">
        <div class="card-title">Pos Component</div>
        <PosComponent v-bind:header="jsonHeader" v-bind:items="jsonBody" />
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
    headers: ["#", "first", "last", "twitter handle"],
    items: [
      {
        index: 1,
        first: "John",
        last: "Doe",
        handle: "doey",
      },
      {
        index: 2,
        first: "Jane",
        last: "Doe",
        handle: "janey",
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
