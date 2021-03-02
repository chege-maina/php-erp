<template>
  <div class="table-responsive">
    <table class="table table-sm table-striped table-hover">
      <thead>
        <tr>
          <th scope="col" v-for="(item, index) in header" :key="index">
            {{ item.name }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in body" :key="item.index">
          <td v-for="(value, key) in item" :key="key">
            {{ value }}
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
  computed: {
    header: function () {
      return JSON.parse(this.json_header);
    },
    body: function () {
      return JSON.parse(this.json_items);
    },
  },
};
</script>
