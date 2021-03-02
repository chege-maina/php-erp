<template>
  <div class="table-responsive">
    <table class="table table-sm table-striped table-hover">
      <thead>
        <tr>
          <th
            scope="col"
            v-bind:class="{ 'col-sm-1': item.editable }"
            v-for="(item, index) in header"
            :key="index"
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
                v-bind:value="value"
              />
            </span>
            <span v-else>{{ value }}</span>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
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
  }),
  computed: {
    header: function () {
      return JSON.parse(this.json_header);
    },
    header_object: function () {
      let header_object = {};
      this.header.forEach((row) => {
        header_object[row.name.toLowerCase()] = {
          editable: row.editable,
        };
      });
      return header_object;
    },
    body: function () {
      return JSON.parse(this.json_items);
    },
  },
};
</script>
