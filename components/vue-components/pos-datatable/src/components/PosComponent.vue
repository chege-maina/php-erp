<template>
  <div class="table-responsive">
    <table class="table table-sm table-striped table-hover">
      <thead>
        <tr>
          <th
            scope="col"
            v-bind:class="{ 'col-sm-1': item.editable }"
            v-for="item in header"
            :key="item.key"
          >
            {{ item.name }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in body" :key="item.index">
          <td v-for="(value, key) in item" :key="key">
            <span v-if="header_object[key].editable">
              <input
                class="form-control form-control-sm"
                type="number"
                v-model="table_data[item.index][key]"
              />
            </span>
            <span v-else-if="header_object[key].computed">{{
              computeField(header_object[key].operation, item.index)
            }}</span>
            <span v-else>{{ value }}</span>
          </td>
        </tr>
      </tbody>
    </table>
    {{ table_data }}
  </div>
</template>

<script>
export default {
  created() {
    // Init the object that will hold the table values
    this.table_data = this.body_object;
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
  }),
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
        body_object[row.index] = row;
      });
      return body_object;
    },
  },
  methods: {
    computeField(expression, index) {
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
      return cumulative_total;
    },
  },
};
</script>
