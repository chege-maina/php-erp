<template>
  <div class="card">
    <div
      class="bg-holder bg-card"
      style="
        background-image: url(http://localhost:6060/assets/img/illustrations/corner-1.png);
      "
    ></div>
    <!--/.bg-holder-->

    <div class="card-body position-relative">
      <h5 class="text-warning">Running out of your space?</h5>
      <p class="fs--1 mb-0">
        Your storage will be running out soon. Get more<br />
        space and powerful productivity features.
      </p>
      <a class="btn btn-link fs--1 text-warning mt-4 mt-lg-3 pl-0" href="#!"
        >Upgrade storage &raquo;</a
      >
    </div>
  </div>
</template>

<script>
export default {
  props: {
    name: { type: String, default: "Jean" },
    mounted() {
      const falcon_js = document.createElement("script");
      falcon_js.setAttribute(
        "src",
        "http://localhost:6060/assets/js/theme.min.js"
      );
      const anchor_js = document.createElement("script");
      anchor_js.setAttribute(
        "src",
        "http://localhost:6060/vendors/anchorjs/anchor.min.js"
      );
      const popper = document.createElement("script");
      popper.setAttribute(
        "src",
        "http://localhost:6060/vendors/popper/popper.min.js"
      );
      const bootstrap = document.createElement("script");
      bootstrap.setAttribute(
        "src",
        "http://localhost:6060/vendors/bootstrap/bootstrap.min.js"
      );
      const is_js = document.createElement("script");
      is_js.setAttribute("src", "http://localhost:6060/vendors/is/is.min.js");
      const prism = document.createElement("script");
      prism.setAttribute("src", "http://localhost:6060/vendors/prism/prism.js");
      const fontawesome = document.createElement("script");
      fontawesome.setAttribute(
        "src",
        "http://localhost:6060/vendors/fontawesome/all.min.js"
      );
      const lodash = document.createElement("script");
      lodash.setAttribute(
        "src",
        "http://localhost:6060/vendors/lodash/lodash.min.js"
      );
      const polyfill = document.createElement("script");
      polyfill.setAttribute(
        "src",
        "https://polyfill.io/v3/polyfill.min.js?features,window.scroll"
      );
      const list_js = document.createElement("script");
      list_js.setAttribute(
        "src",
        "http://localhost:6060/vendors/list.js/list.min.js"
      );
      const config_js = document.createElement("script");
      config_js.setAttribute(
        "src",
        "http://localhost:6060/assets/js/config.js"
      );

      this.$el.prepend(config_js);
      this.$el.append(
        anchor_js,
        popper,
        bootstrap,
        is_js,
        prism,
        fontawesome,
        lodash,
        polyfill,
        list_js,
        falcon_js
      );

      this.i_total = this.body.length / this.per_page;
      this.i_total = this.i_total < 1 ? 1 : this.i_total;

      this.i_total =
        this.i_total.toString().split(".").length > 1
          ? Number(this.i_total.toString().split(".")[0]) + 1
          : this.i_total;
    },
  },
};
</script>
<style>
@import "http://localhost:6060/assets/css/theme.min.css";
</style>


