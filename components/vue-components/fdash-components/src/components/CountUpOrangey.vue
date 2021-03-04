<template>
  <div>
    <h5>This is a WebComponent Gentleman</h5>
    <div>My Name is {{ name }}</div>
    <div class="row">
      <div class="col-sm-6 col-md-4">
        <div class="card overflow-hidden" style="min-width: 12rem">
          <div
            class="bg-holder bg-card"
            style="
              background-image: url(http://localhost:6060/assets/img/illustrations/corner-1.png);
            "
          ></div>
          <!--/.bg-holder-->

          <div class="card-body position-relative">
            <h6>
              Customers<span class="badge badge-soft-warning rounded-pill ml-2"
                >-0.23%</span
              >
            </h6>
            <div
              class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-warning"
              data-countup='{"endValue":58.386,"decimalPlaces":2,"suffix":"k"}'
            >
              58.39k
            </div>
            <a
              class="fw-semi-bold fs--1 text-nowrap"
              href="e-commerce/customers.html"
              >See all</a
            >
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-md-4">
        <div class="card overflow-hidden" style="min-width: 12rem">
          <div
            class="bg-holder bg-card"
            style="
              background-image: url(http://localhost:6060/assets/img/illustrations/corner-2.png);
            "
          ></div>
          <!--/.bg-holder-->

          <div class="card-body position-relative">
            <h6>
              Orders<span class="badge badge-soft-info rounded-pill ml-2"
                >0.0%</span
              >
            </h6>
            <div
              class="display-4 fs-4 mb-2 fw-normal font-sans-serif text-info"
              data-countup='{"endValue":23.434,"decimalPlaces":2,"suffix":"k"}'
            >
              23.43k
            </div>
            <a
              class="fw-semi-bold fs--1 text-nowrap"
              href="e-commerce/orders.html"
            >
              All orders
            </a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-3 overflow-hidden" style="min-width: 12rem">
          <div
            class="bg-holder bg-card"
            style="
              background-image: url(http://localhost:6060/assets/img/illustrations/corner-3.png);
            "
          ></div>
          <!--/.bg-holder-->

          <div class="card-body position-relative">
            <h6>
              Revenue<span class="badge badge-soft-success rounded-pill ml-2"
                >9.54%</span
              >
            </h6>
            <div
              class="display-4 fs-4 mb-2 fw-normal font-sans-serif"
              data-countup='{"endValue":43594,"prefix":"$"}'
            >
              $43,594
            </div>
            <a class="fw-semi-bold fs--1 text-nowrap" href="index.html">
              Statistics
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-xl-5 col-xxl-4 pr-xl-2">
        <div class="row g-0">
          <div class="col-lg-4 col-xl-12 pr-lg-2 pr-xl-0 mb-3">
            <div class="card h-100">
              <div class="card-header d-flex flex-between-center pb-0">
                <h6 class="mb-0">Weather</h6>
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
                    &raquo;
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
                      <img
                        class="mr-3"
                        src="http//localhost:6060/assets/img/icons/weather-icon.png"
                        alt=""
                        height="60"
                      />
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
                    <div
                      class="fs-4 fw-normal font-sans-serif text-primary mb-1 lh-1"
                    >
                      31°
                    </div>
                    <div class="fs--1 text-800">32° / 25°</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-5 col-xl-12 px-lg-2 px-xl-0 mb-3">
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
                <a
                  class="btn btn-link fs--1 text-warning mt-4 mt-lg-3 pl-0"
                  href="#!"
                  >Upgrade storage &raquo;</a
                >
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-xl-12 pl-lg-2 pl-xl-0 mb-3">
            <div class="card h-100">
              <div
                class="bg-holder d-none d-xl-block bg-card"
                style="
                  background-image: url(http://localhost:6060/assets/img/illustrations/corner-4.png);
                  opacity: 0.7;
                "
              ></div>
              <!--/.bg-holder-->

              <div class="card-body">
                <h5>Order Details: #2737</h5>
                <p class="fs--1">April 21, 2019, 5:33 PM</p>
                <div>
                  <strong class="mr-2">Status: </strong>
                  <div class="badge rounded-pill badge-soft-success fs--2">
                    Completed
                    <span
                      class="fas fa-check ml-1"
                      data-fa-transform="shrink-2"
                    ></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
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
