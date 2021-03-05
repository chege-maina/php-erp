<template>
  <div>
    <div class="d-flex flex-row-reverse mb-0">
      <ul class="pagination pagination-sm ml-2">
        <li class="page-item active">
          <button
            class="page-link"
            href="#"
            aria-label="Previous"
            v-on:click="prevPage()"
          >
            <span aria-hidden="true">&laquo;</span>
          </button>
        </li>
        <li class="page-item">
          <span class="page-link" href="#"
            >{{ i_current }} <span class="fs--2">of</span> {{ i_total }}</span
          >
        </li>
        <li class="page-item active">
          <button
            class="page-link"
            href="#"
            aria-label="Next"
            v-on:click="nextPage()"
          >
            <span aria-hidden="true">&raquo;</span>
          </button>
        </li>
      </ul>
      <div class="col col-auto align-items-center">
        <select class="form-select form-select-sm" v-model="per_page">
          <template v-for="(value, index) in list_by">
            <option
              v-if="index == 0"
              v-bind:value="value"
              v-bind:key="index"
              selected
            >
              {{ value }}
            </option>
            <option v-else v-bind:value="value" v-bind:key="index">
              {{ value }}
            </option>
          </template>
        </select>
      </div>
    </div>
    <table class="table table-sm table-striped table-hover is-fullwidth pb-0">
      <thead>
        <tr>
          <th scope="col">#</th>
          <template v-for="(item, key) in header">
            <th
              scope="col"
              v-bind:class="{ 'col-sm-1': item.editable }"
              :key="key"
              v-if="item.key !== 'key'"
            >
              {{ item.name }}
            </th>
          </template>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in visible_table_data" :key="item.key" class="py-0">
          <th scope="row" class="align-middle py-1">
            {{ table_data_relative_index[item.key].index }}
          </th>

          <template v-for="(value, key) in item">
            <td v-bind:key="key" v-if="key !== 'key'" class="align-middle py-1">
              <span v-if="header_object[key].editable" class="control">
                <input
                  class="form-control form-control-sm"
                  type="number"
                  v-model="visible_table_data[item.key][key]"
                />
              </span>
              <span v-else-if="header_object[key].computed">{{
                computeField(header_object[key].operation, item.key, key)
              }}</span>
              <span v-else>{{ value }}</span>
            </td>
          </template>

          <td class="align-middle py-1">
            <button
              class="btn btn-falcon-primary btn-sm px-1 py-0"
              v-on:click="manageItem(item.key)"
            >
              Manage
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  created() {
    // Init the object that will hold the table values
    this.table_data = this.body_object;
    window.addEventListener("storage", (event) => {
      // If our table data in the session storage has been changed
      if (event.key == this.session_key) {
        this.table_data = JSON.parse(
          window.sessionStorage.getItem(this.session_key)
        );
      }
    });
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
    is_js.setAttribute("src", "https://qonsolidated-solutions.github.io/falcon-assets/vendors/is/is.min.js");
    const prism = document.createElement("script");
    prism.setAttribute("src", "https://qonsolidated-solutions.github.io/falcon-assets/vendors/prism/prism.js");
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
    config_js.setAttribute("src", "https://qonsolidated-solutions.github.io/falcon-assets/assets/js/config.js");

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
  props: {
    json_header: {
      type: String,
      default: () => "[]",
    },
    json_items: {
      type: String,
      default: () => "[]",
    },
    // TODO: This can be done better
    //e.g. using arrays
    manage_key: {
      type: String,
      default: () => "",
    },
    manage_key_2: {
      type: String,
      default: () => "",
    },
    redirect: {
      type: String,
      default: () => "",
    },
  },
  data: () => ({
    person: {
      name: "Jean",
    },
    table_data: {},
    session_key: "table_data",
    i_current: 1,
    i_total: 9,
    list_by: [10, 25, 50, 100],
    per_page: 10,
  }),
  watch: {
    table_data: {
      handler() {
        window.sessionStorage.setItem(
          this.session_key,
          JSON.stringify(this.table_data)
        );
      },
      // TODO: receive this as a prop
      deep: true,
    },
    per_page: {
      handler(val) {
        this.i_total = this.body.length / val;

        this.i_total = this.i_total < 1 ? 1 : this.i_total;
        this.i_current =
          this.i_current > this.i_total ? this.i_total : this.i_current;

        this.i_total =
          this.i_total.toString().split(".").length > 1
            ? Number(this.i_total.toString().split(".")[0]) + 1
            : this.i_total;
      },
    },
    i_current: {
      handler() {
        this.i_current = this.i_current < 1 ? 1 : this.i_current;
        this.i_current =
          this.i_current > this.i_total ? this.i_total : this.i_current;
      },
    },
  },
  computed: {
    header: function () {
      return JSON.parse(this.json_header);
    },
    header_object: function () {
      let header_object = {};
      this.header.forEach((row) => {
        header_object[row.key] = {
          editable: row.editable,
          computed: row.computed,
          operation: row.operation,
          name: row.name,
        };
      });
      return header_object;
    },
    body: function () {
      return JSON.parse(this.json_items);
    },
    body_object: function () {
      let body_object = {};
      this.body.forEach((row) => {
        body_object[row.key] = row;
      });
      return body_object;
    },
    table_data_relative_index: function () {
      let tmp = {};
      let i = 1;
      for (let key in this.table_data) {
        tmp[key] = {
          index: i,
        };
        i++;
      }
      return tmp;
    },
    table_data_relative_index_current_page: function () {
      let tmp = {};
      let i = 0;
      let start_at = this.i_current * this.per_page - this.per_page;
      let end_at = start_at + this.per_page;
      for (let key in this.table_data_relative_index) {
        if (start_at > i) {
          i++;
          continue;
        }
        if (end_at <= i) {
          break;
        }
        tmp[key] = this.table_data_relative_index[key];
        i++;
      }
      return tmp;
    },
    visible_table_data: function () {
      let tmp = {};
      let i = 0;
      let start_at = this.i_current * this.per_page - this.per_page;
      let end_at = start_at + this.per_page;
      for (let key in this.table_data) {
        if (start_at > i) {
          i++;
          continue;
        }
        if (end_at <= i) {
          break;
        }
        tmp[key] = this.table_data[key];
        i++;
      }
      return tmp;
    },
  },
  methods: {
    computeField(expression, index, col) {
      // It computes from left to right =======>
      //so organize them in the order the calculation should be done
      //so as to respect bodmas rules
      // Rule of thumb: Don't set a computed field to be dependent on
      //another computed field.
      // TODO:The behaviour hasn't been tested yet
      const [...expanded] = expression.split(" ");
      let cumulative_total = 0;
      for (let i = 0; i < expanded.length; i += 2) {
        // Check if the value is numeric
        const value = isNaN(expanded[i])
          ? Number(this.table_data[index][expanded[i]])
          : Number(expanded[i]);

        if (i == 0) {
          cumulative_total = value;
          continue;
        }
        switch (expanded[i - 1]) {
          case "*":
            cumulative_total *= value;
            break;
          case "+":
            cumulative_total += value;
            break;
          case "/":
            cumulative_total /= value;
            break;
          case "-":
            cumulative_total -= value;
            break;
        }
      }
      this.table_data[index][col] = cumulative_total.toFixed(2);
      return cumulative_total.toFixed(2);
    },
    removeRow(row) {
      const replacement_table = {};
      for (let key in this.table_data) {
        if (key == row) {
          continue;
        }
        replacement_table[key] = this.table_data[key];
      }
      this.table_data = replacement_table;
    },
    manageItem(row) {
      window.sessionStorage.setItem(
        this.manage_key,
        this.table_data[row][this.manage_key]
      );

      if (this.manage_key_2 !== "") {
        window.sessionStorage.setItem(
          this.manage_key_2,
          this.table_data[row][this.manage_key_2]
        );
      }

      window.location.href = this.redirect;
    },
    nextPage() {
      this.i_current++;
    },
    prevPage() {
      this.i_current--;
    },
  },
};
</script>

<style>
@import "https://qonsolidated-solutions.github.io/falcon-assets/assets/css/theme.min.css";
</style>
