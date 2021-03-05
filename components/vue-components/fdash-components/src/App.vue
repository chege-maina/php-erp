<template>
  <div class="container mb-8">
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
    <div class="row">
      <div class="col-sm-6 col-md-4">
        <IconXByX />
      </div>
      <div class="col-sm-6 col-md-4">
        <TipCard />
      </div>
      <div class="col-sm-6 col-md-4">
        <StatusCard />
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-md-6 h-25">
        <InfoWideCard />
      </div>
    </div>
  </div>
</template>

<script>
import CountUpOrangey from "./components/CountUpOrangey.vue";
import CountUpGreen from "./components/CountUpGreen.vue";
import CountUpCyan from "./components/CountUpCyan.vue";
import IconXByX from "./components/IconXByX.vue";
import TipCard from "./components/TipCard.vue";
import StatusCard from "./components/StatusCard.vue";
import InfoWideCard from "./components/InfoWideCard.vue";

export default {
  name: "App",
  components: {
    CountUpOrangey,
    CountUpGreen,
    CountUpCyan,
    IconXByX,
    TipCard,
    StatusCard,
    InfoWideCard,
  },
};
</script>
