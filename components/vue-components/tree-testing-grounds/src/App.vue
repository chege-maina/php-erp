<template>
  <v-app>
    <v-app-bar app color="primary" dark>
      <div class="d-flex align-center">
        <v-img
          alt="Vuetify Logo"
          class="shrink mr-2"
          contain
          src="https://cdn.vuetifyjs.com/images/logos/vuetify-logo-dark.png"
          transition="scale-transition"
          width="40"
        />

        <v-img
          alt="Vuetify Name"
          class="shrink mt-1 hidden-sm-and-down"
          contain
          min-width="100"
          src="https://cdn.vuetifyjs.com/images/logos/vuetify-name-dark.png"
          width="100"
        />
      </div>

      <v-spacer></v-spacer>

      <v-btn
        href="https://github.com/vuetifyjs/vuetify/releases/latest"
        target="_blank"
        text
      >
        <span class="mr-2">Latest Release</span>
        <v-icon>mdi-open-in-new</v-icon>
      </v-btn>
    </v-app-bar>

    <v-main>
      <HelloWorld />
    </v-main>
  </v-app>
</template>

<script>
import HelloWorld from "./components/HelloWorld";

export default {
  name: "App",

  components: {
    HelloWorld,
  },
  data: () => ({
    parent_children: {
      assets: {
        code: 1000,
        children_to_add: [],
      },
      receivables: {
        code: 1100,
        children_to_add: [
          {
            name: "boom",
          },
          {
            name: "zeta",
          },
        ],
      },
      zeta: {
        code: 1200,
        children_to_add: [
          {
            name: "alpha",
          },
          {
            name: "beta",
          },
          {
            name: "gamma",
          },
          {
            name: "delta",
          },
          {
            name: "epsilon",
          },
        ],
      },
      delta: {
        code: 1300,
        children_to_add: [
          {
            name: "force",
          },
          {
            name: "mean",
          },
        ],
      },
      mean: {
        code: 1400,
        children_to_add: [
          {
            name: "chili",
          },
        ],
      },
    },
  }),
  mounted() {
    window.sessionStorage.clear();
    window.sessionStorage.setItem(
      "items",
      JSON.stringify(this.parent_children)
    );
  },
};
</script>
