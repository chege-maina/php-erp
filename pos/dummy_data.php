<script>
  const headers = [{
      name: "key",
      editable: false,
      key: "key",
      computed: false
    },
    {
      name: "Code",
      editable: false,
      key: "code",
      computed: false
    },
    {
      name: "Name",
      editable: false,
      key: "name",
      computed: false
    },
    {
      name: "Price",
      editable: false,
      key: "price",
      computed: false
    },
    {
      name: "Quantity",
      editable: true,
      key: "quantity",
      computed: false
    },
    {
      name: "Units",
      editable: false,
      key: "units",
      computed: false
    },
    {
      name: "Discount",
      editable: true,
      key: "discount",
      computed: false
    },
    {
      name: "Tax %",
      editable: false,
      key: "tax_pc",
      computed: false
    },
    {
      name: "Tax",
      editable: false,
      key: "tax",
      computed: true,
      operation: "tax_pc / 100 * quantity * price",
    },
    {
      name: "Subtotal",
      editable: false,
      key: "subtotal",
      computed: true,
      operation: "tax_pc / 100 + 1 * quantity * price",
    },
  ];

  const items = [];

  // {
  // key: 1,
  // name: "Sunsipaque",
  // code: "497-23-2865",
  // stock: 9,
  // quantity: 3,
  // balance: 43,
  // price: 5176,
  // discount: 82,
  // tax: 84,
  // tax_pc: 0,
  // subtotal: 0,
  // image_url: "http://dummyimage.com/532x548.png/dddddd/000000",
  // }


  let json_items = [];
</script>
