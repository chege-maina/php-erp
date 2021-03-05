<template>
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-md-4">
        <CountUpOrangey />
      </div>
      <div class="col-sm-6 col-md-4">
        <CountUpGreen />
      </div>
      <div class="col-sm-6 col-md-4">
        <CountUpCyan />
      </div>
    </div>
  </div>
</template>

<script>
import CountUpOrangey from "./components/CountUpOrangey.vue";
import CountUpGreen from "./components/CountUpGreen.vue";
import CountUpCyan from "./components/CountUpCyan.vue";

export default {
  name: "App",
  components: {
    CountUpOrangey,
    CountUpGreen,
    CountUpCyan,
  },
};
</script>
