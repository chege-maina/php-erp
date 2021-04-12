<script>
  const items_to_show = [{
      "name": "Assets",
      "code": 1000,
    },
    {
      "name": "Receivables",
      "code": 1100,
      "children": [{
          "name": "alpha",
          "value": 10,
          "file": "txt"
        },
        {
          "name": "beta",
          "value": 10,
          "file": "txt"
        },
        {
          "name": "gamma",
          "value": 10,
          "file": "txt"
        },
        {
          "name": "delta",
          "value": 10,
          "file": "txt"
        },
        {
          "name": "epsilon",
          "value": 10,
          "file": "txt"
        },
        {
          "name": "zeta",
          "value": 10,
        },
      ],
    },
    {
      "name": "Inventory",
      "code": 1200,
      "children": [{
          "name": "static",
          "children": [{
            "name": "eta",
            "value": 10,
            "file": "txt"
          }]
        },
        {
          "name": "theta",
          "value": 10,
          "file": "txt"
        },
        {
          "name": "iota",
          "value": 10,
          "file": "txt"
        }
      ]
    },

  ];

  window.sessionStorage.clear();
  window.sessionStorage.setItem("items", JSON.stringify(items_to_show));
</script>
