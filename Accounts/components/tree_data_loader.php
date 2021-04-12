<script>
  const items_to_show = [{
      "name": ".grit",
    },
    {
      "name": "node_modules",
      "children": [{
          "name": ".gitignore",
          "value": 10,
          "file": "txt"
        },
        {
          "name": "babel.config.js",
          "value": 10,
          "file": "txt"
        },
        {
          "name": "package.json",
          "value": 10,
          "file": "txt"
        },
        {
          "name": "README.md",
          "value": 10,
          "file": "txt"
        },
        {
          "name": "vue.config.js",
          "value": 10,
          "file": "txt"
        },
        {
          "name": "yarn.lock",
          "value": 10,
        },
      ],
    },
    {
      "name": "public",
      "children": [{
          "name": "static",
          "children": [{
            "name": "logo.png",
            "value": 10,
            "file": "txt"
          }]
        },
        {
          "name": "favicon.ico",
          "value": 10,
          "file": "txt"
        },
        {
          "name": "index.html",
          "value": 10,
          "file": "txt"
        }
      ]
    },

  ];

  window.sessionStorage.clear();
  window.sessionStorage.setItem("items", JSON.stringify(items_to_show));
</script>
