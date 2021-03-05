<template>
  <div class="card bg-light mb-3 h-xxl-100">
    <div class="card-body p-3">
      <p class="fs--1 mb-0">
        <a href="#!">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="16"
            height="16"
            fill="currentColor"
            class="mr-2"
            viewBox="0 0 16 16"
          >
            <path
              fill-rule="evenodd"
              d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"
            />
          </svg>
          A payout for <strong>$921.42 </strong>was deposited 13 days ago</a
        >. Your next deposit is expected on
        <strong>Tuesday, March 13.</strong>
      </p>
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



