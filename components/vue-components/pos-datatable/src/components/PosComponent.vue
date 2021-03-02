<template>
  <div class="table-responsive">
    <table class="table table-sm table-striped table-hover">
      <thead>
        <tr>
          <th scope="col" v-for="(item, index) in jsonHeader" :key="index">
            {{ item.name }}
          </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in jsonBody" :key="item.index">
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
    header: {
      type: String,
      default: () => "[]",
    },
    items: {
      type: String,
      default: () => "[]",
    },
  },
  computed: {
    jsonHeader: function () {
      return JSON.parse(this.header);
    },
    jsonBody: function () {
      return JSON.parse(this.items);
    },
  },
};
</script>
