<script>
  const items_to_show = [{
      "name": ".grit",
    },
    {
      "name": "node_modules",
    },
    {
      "name": "public",
      "children": [{
          "name": "static",
          "children": [{
            "name": "logo.png",
            "value": 10,
            "file": "png"
          }]
        },
        {
          "name": "favicon.ico",
          "value": 10,
          "file": "png"
        },
        {
          "name": "index.html",
          "value": 10,
          "file": "html"
        }
      ]
    },
    {
      "name": ".gitignore",
      "value": 10,
      "file": "txt"
    },
    {
      "name": "babel.config.js",
      "value": 10,
      "file": "js"
    },
    {
      "name": "package.json",
      "value": 10,
      "file": "json"
    },
    {
      "name": "README.md",
      "value": 10,
      "file": "md"
    },
    {
      "name": "vue.config.js",
      "value": 10,
      "file": "js"
    },
    {
      "name": "yarn.lock",
      "value": 10,
      "file": "txt"
    }
  ];

  window.sessionStorage.clear();
  window.sessionStorage.setItem("items", JSON.stringify(items_to_show));
</script>
