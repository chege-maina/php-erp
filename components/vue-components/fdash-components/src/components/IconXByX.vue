<template>
  <div class="card h-100">
    <div class="card-header d-flex flex-between-center pb-0">
      <h6 class="mb-0 text-warning">Weather</h6>
      <div class="dropdown font-sans-serif btn-reveal-trigger">
        <button
          class="btn btn-link text-600 btn-sm dropdown-toggle btn-reveal dropdown-caret-none"
          type="button"
          id="dropdown-weather-update"
          data-toggle="dropdown"
          data-boundary="viewport"
          aria-haspopup="true"
          aria-expanded="false"
        >
          <b>...</b>
        </button>
        <div
          class="dropdown-menu dropdown-menu-right border py-2"
          aria-labelledby="dropdown-weather-update"
        >
          <a class="dropdown-item" href="#!">View</a
          ><a class="dropdown-item" href="#!">Export</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item text-danger" href="#!">Remove</a>
        </div>
      </div>
    </div>
    <div class="card-body pt-2">
      <div class="row g-0 h-100 align-items-center">
        <div class="col">
          <div class="d-flex align-items-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="56"
              height="56"
              fill="currentColor"
              class="mr-4"
              viewBox="0 0 16 16"
            >
              <path
                d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"
              />
            </svg>
            <div>
              <h6 class="mb-2">New York City</h6>
              <div class="fs--2 fw-semi-bold">
                <div class="text-warning">Sunny</div>
                Precipitation: 50%
              </div>
            </div>
          </div>
        </div>
        <div class="col-auto text-center pl-2">
          <div class="fs-4 fw-normal font-sans-serif text-primary mb-1 lh-1">
            31°
          </div>
          <div class="fs--1 text-800">32° / 25°</div>
        </div>
      </div>
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


