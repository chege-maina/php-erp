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
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="16"
                      height="16"
                      fill="currentColor"
                      class="bi bi-check2-all"
                      viewBox="0 0 16 16"
                    >
                      <path
                        d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7l-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z"
                      />
                      <path
                        d="M5.354 7.146l.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z"
                      />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
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
