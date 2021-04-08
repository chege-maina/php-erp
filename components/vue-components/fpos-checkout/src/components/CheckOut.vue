<template>
  <div class="card min-vw-50">
    <div class="card-header text-center h1 display-6 pb-0">
      Billing Information
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-sm-6 pl-1 pr-0">
          <div class="row p-0 m-0">
            <div class="card p-0">
              <h5 class="card-header bg-100">Order Summary</h5>
              <div class="card-body">
                <table class="table table-sm table-striped table-hover">
                  <tbody>
                    <tr>
                      <td class="text-right">
                        <label class="form-label">Subtotal*</label>
                      </td>
                      <td>
                        <input
                          type="number"
                          class="form-control form-control-sm"
                          v-model="subtotal"
                          readonly
                        />
                      </td>
                    </tr>
                    <tr>
                      <td class="text-right">
                        <label class="form-label">Shipping*</label>
                      </td>
                      <td>
                        <input
                          type="number"
                          class="form-control form-control-sm"
                          v-model="shipping"
                        />
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="row p-0 m-0 mt-1">
            <div class="card p-0">
              <div class="card-body py-2">
                <table class="table table-sm table-striped table-hover mb-0">
                  <tbody>
                    <tr>
                      <td class="text-right">
                        <label class="form-label"
                          ><strong>Grand Total*</strong></label
                        >
                      </td>
                      <td>
                        <input
                          type="number"
                          class="form-control form-control-sm"
                          v-model="grand_total"
                          readonly
                        />
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 px-1">
          <!-- =========== -->
          <div class="row p-0 m-0">
            <div class="card p-0">
              <h5 class="card-header bg-100">Payment Options</h5>
              <div class="card-body">
                <table class="table table-sm table-striped table-hover">
                  <tbody>
                    <tr>
                      <td class="text-right">
                        <label class="form-label">Cash</label>
                      </td>
                      <td>
                        <input
                          type="number"
                          class="form-control form-control-sm"
                          id="cash_input"
                          v-on:click="paymentInputClicked('cash')"
                          v-model="cash_paid"
                        />
                      </td>
                    </tr>
                    <tr>
                      <td class="text-right">
                        <label class="form-label">VISA</label>
                      </td>
                      <td>
                        <input
                          type="number"
                          class="form-control form-control-sm"
                          id="visa_input"
                          v-on:click="paymentInputClicked('visa')"
                          v-model="visa_paid"
                        />
                      </td>
                    </tr>
                    <tr>
                      <td class="text-right">
                        <label class="form-label">M-PESA</label>
                      </td>
                      <td>
                        <input
                          type="number"
                          id="mpesa_input"
                          class="form-control form-control-sm"
                          v-on:click="paymentInputClicked('mpesa')"
                          v-model="mpesa_paid"
                        />
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- =========== -->
          <div class="row mt-1 p-0 m-0">
            <div class="card">
              <div class="card-body p-2">
                <table class="table table-sm table-striped table-hover mb-0">
                  <tbody>
                    <tr>
                      <td class="text-right">
                        <label class="form-label"
                          ><strong>Balance</strong></label
                        >
                      </td>
                      <td>
                        <input
                          type="number"
                          class="form-control form-control-sm"
                          v-model="balance_amount"
                          readonly
                        />
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row px-1 py-1">
        <div class="card bg-100">
          <div class="text-center p-2">
            <button type="button" class="btn btn-falcon-primary">
              CheckOut
            </button>
          </div>
        </div>
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
      type: Number,
      default: () => 1000,
    },
  },
  data: () => ({
    grand_total: 0,
    shipping: 0,
    cash_paid: 0,
    visa_paid: 0,
    mpesa_paid: 0,
    balance_amount: 0,
  }),
  watch: {
    shipping: {
      handler() {
        this.grand_total = Number(this.subtotal) + Number(this.shipping);
      },
    },
    cash_paid: {
      handler() {
        this.calculateBalance();
      },
    },
    visa_paid: {
      handler() {
        this.calculateBalance();
      },
    },
    mpesa_paid: {
      handler() {
        this.calculateBalance();
      },
    },
  },
  methods: {
    calculateBalance() {
      this.balance_amount =
        Number(this.cash_paid) +
        Number(this.visa_paid) +
        Number(this.mpesa_paid) -
        Number(this.grand_total);
    },
    paymentInputClicked(elem) {
      const cash_input = document.querySelector("#cash_input");
      const visa_input = document.querySelector("#visa_input");
      const mpesa_input = document.querySelector("#mpesa_input");

      switch (elem) {
        case "cash":
          cash_input.select();
          break;
        case "visa":
          visa_input.select();
          break;
        case "mpesa":
          mpesa_input.select();
          break;
      }
    },
  },
  mounted() {
    this.grand_total = this.subtotal;
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
