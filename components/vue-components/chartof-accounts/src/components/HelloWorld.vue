<template>
  <div>
    <h5>This is a WebComponent Gentleman</h5>
    <div>My Name is {{ name }}</div>
  </div>
</template>

<script>
export default {
  props: {
    name: { type: String, default: "Jean" },
  },
};
</script>
