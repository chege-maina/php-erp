<template>
  <div class="table-responsive">
    <table class="table table-sm table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <template v-for="(item, key) in header">
            <th
              scope="col"
              v-bind:class="{ 'col-sm-1': item.editable }"
              :key="key"
              v-if="header_object[item.key].visible"
            >
              {{ item.name }}
            </th>
          </template>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in table_data" :key="item.key" class="py-0">
          <th scope="row" class="align-middle py-1">
            {{ table_data_relative_index[item.key].index }}
          </th>

          <template v-for="(value, key) in item">
            <td
              v-bind:key="key"
              v-if="header_object[key].visible"
              class="align-middle py-1"
            >
              <span v-if="header_object[key].editable">
                <input
                  class="form-control form-control-sm"
                  type="number"
                  v-model="table_data[item.key][key]"
                />
              </span>
              <span v-else-if="header_object[key].selectable">
                <select
                  class="form-select form-select-sm"
                  v-model="table_data[item.key].current_unit"
                  v-on:click="unitUpdated(item.key)"
                >
                  <option v-bind:value="table_data[item.key].units">
                    {{ table_data[item.key].units }}
                  </option>
                  <option v-bind:value="table_data[item.key].bulk_units">
                    {{ table_data[item.key].bulk_units }}
                  </option>
                </select>
              </span>
              <span v-else-if="header_object[key].computed">{{
                computeField(header_object[key].operation, item.key, key)
              }}</span>
              <span v-else>{{ value }}</span>
            </td>
          </template>

          <td class="align-middle py-1">
            <button
              class="btn btn-falcon-default btn-sm rounded-pill px-1 py-0"
              type="button"
              v-on:click="removeRow(item.key)"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-x"
                viewBox="0 0 16 16"
              >
                <path
                  d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"
                />
              </svg>
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
  props: {
    json_header: {
      type: String,
      default: () => "[]",
    },
    json_items: {
      type: String,
      default: () => "[]",
    },
  },
  data: () => ({
    person: {
      name: "Jean",
    },
    table_data: {},
    session_key: "table_data",
  }),
  watch: {
    table_data: {
      handler() {
        window.sessionStorage.setItem(
          this.session_key,
          JSON.stringify(this.table_data)
        );
        const event = new Event("calculate_subtotals");
        // Dispatch the event.
        window.dispatchEvent(event);
      },
      // TODO: receive this as a prop
      deep: true,
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
          editable: "editable" in row ? row.editable : false,
          computed: "computed" in row ? row.computed : false,
          operation: "operation" in row ? row.operation : false,
          selectable: "selectable" in row ? row.selectable : false,
          visible: "visible" in row ? row.visible : true,
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
    unitUpdated(index) {
      const current_unit = this.table_data[index].current_unit;
      const units = this.table_data[index].units;
      const price =
        current_unit == units
          ? this.table_data[index].price
          : this.table_data[index].bulk_price;
      this.table_data[index].current_price = price;
    },
  },
};
</script>
<style>
@import "https://qonsolidated-solutions.github.io/falcon-assets/assets/css/theme.min.css";
</style>
