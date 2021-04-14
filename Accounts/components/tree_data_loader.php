<script>
  const parent_children = {
    assets: {
      code: 1000,
      children_to_add: []
    },
    receivables: {
      code: 1100,
      children_to_add: [{
        name: 'boom'
      }, {
        name: 'zeta'
      }],
    },
    zeta: {
      code: 1200,
      children_to_add: [{
          name: 'alpha'
        },
        {
          name: 'beta'
        },
        {
          name: 'gamma'
        },
        {
          name: 'delta'
        },
        {
          name: 'epsilon'
        },
      ],
    },
    delta: {
      code: 1300,
      children_to_add: [{
        name: 'force'
      }, {
        name: 'mean'
      }]
    },
    mean: {
      code: 1400,
      children_to_add: [{
        name: 'chili'
      }]
    },
  };

  window.sessionStorage.clear();
  window.sessionStorage.setItem("items", JSON.stringify(parent_children));
</script>
