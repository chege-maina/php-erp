<script>
  const items_to_show = [{
      "name": ".grit"
    },
    {
      "name": "node_modules"
    },
    {
      "name": "public",
      "children": [{
          "name": "static",
          "children": [{
            "name": "logo.png",
            "file": "png"
          }]
        },
        {
          "name": "favicon.ico",
          "file": "png"
        },
        {
          "name": "index.html",
          "file": "html"
        }
      ]
    },
    {
      "name": ".gitignore",
      "file": "txt"
    },
    {
      "name": "babel.config.js",
      "file": "js"
    },
    {
      "name": "package.json",
      "file": "json"
    },
    {
      "name": "README.md",
      "file": "md"
    },
    {
      "name": "vue.config.js",
      "file": "js"
    },
    {
      "name": "yarn.lock",
      "file": "txt"
    }
  ];

  window.sessionStorage.clear();
  window.sessionStorage.setItem("items", JSON.stringify(items_to_show));
</script>
