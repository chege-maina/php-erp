<template>
  <div class="card min-vw-50">
    <div class="card-header text-center h1 display-3">Billing Info</div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-header">Order Summary</h4>
              <hr />
              <div class="row pb-2">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"
                      >Subtotal</span
                    >
                    <input
                      type="number"
                      class="form-control"
                      aria-label="subtotal"
                      v-model="subtotal"
                      aria-describedby="basic-addon1"
                      readonly
                    />
                  </div>
                </div>
              </div>
              <div class="row pb-2">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"
                      >Shipping</span
                    >
                    <input
                      type="number"
                      class="form-control"
                      placeholder="shipping"
                      aria-label="shipping"
                      value="0"
                      min="0"
                      aria-describedby="basic-addon1"
                    />
                  </div>
                </div>
              </div>
              <hr />
              <div class="row pb-2">
                <div class="col">
                  <div class="input-group mb-4">
                    <span class="input-group-text" id="basic-addon1"
                      >Grand Total</span
                    >
                    <input
                      type="number"
                      class="form-control"
                      placeholder="total"
                      aria-label="total"
                      v-model="title"
                      readonly
                      aria-describedby="basic-addon1"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card">
            <div class="card-body">
              <h4 class="card-header text-center">{{ title }}</h4>
              <hr />
              <div class="row pb-2">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">CASH</span>
                    <input
                      type="number"
                      class="form-control"
                      placeholder="Cash"
                      aria-label="Cash"
                      aria-describedby="basic-addon1"
                    />
                  </div>
                </div>
              </div>
              <div class="row pb-2">
                <div class="col">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">VISA</span>
                    <input
                      type="number"
                      class="form-control"
                      placeholder="visa"
                      aria-label="visa"
                      aria-describedby="basic-addon1"
                    />
                  </div>
                </div>
              </div>
              <div class="row pb-2">
                <div class="col">
                  <div class="input-group mb-4">
                    <span class="input-group-text" id="basic-addon1"
                      >M-PESA</span
                    >
                    <input
                      type="number"
                      class="form-control"
                      placeholder="mpesa"
                      aria-label="mpesa"
                      aria-describedby="basic-addon1"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <button type="button" class="btn btn-falcon-default">
                    Calculate
                  </button>
                </div>
                <div class="col">
                  <span>Balance : {{ balance }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center mt-3">
        <button type="button" class="btn btn-falcon-primary">CheckOut</button>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: {
    title: {
      type: String,
      default: () => "1000",
    },
    subtotal: {
      type: String,
      default: () => "1000",
    },
    balance: {
      type: String,
      min: () => "0",
      default: () => "0",
    },
  },
  mounted() {
    const falcon_js = document.createElement("script");
    falcon_js.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/assets/js/theme.min.js"
    );
    const anchor_js = document.createElement("script");
    anchor_js.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/anchorjs/anchor.min.js"
    );
    const popper = document.createElement("script");
    popper.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/popper/popper.min.js"
    );
    const bootstrap = document.createElement("script");
    bootstrap.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/bootstrap/bootstrap.min.js"
    );
    const is_js = document.createElement("script");
    is_js.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/is/is.min.js"
    );
    const prism = document.createElement("script");
    prism.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/prism/prism.js"
    );
    const fontawesome = document.createElement("script");
    fontawesome.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/fontawesome/all.min.js"
    );
    const lodash = document.createElement("script");
    lodash.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/lodash/lodash.min.js"
    );
    const polyfill = document.createElement("script");
    polyfill.setAttribute(
      "src",
      "https://polyfill.io/v3/polyfill.min.js?features,window.scroll"
    );
    const list_js = document.createElement("script");
    list_js.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/vendors/list.js/list.min.js"
    );
    const config_js = document.createElement("script");
    config_js.setAttribute(
      "src",
      "https://qonsolidated-solutions.github.io/falcon-assets/assets/js/config.js"
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
  },
};
</script>

<style>
@import "https://qonsolidated-solutions.github.io/falcon-assets/assets/css/theme.min.css";
</style>
