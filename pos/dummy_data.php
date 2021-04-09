<script>
  const headers = [{
      name: "key",
      key: "key",
      visible: false
    },
    {
      name: "Code",
      key: "code"
    },
    {
      name: "Name",
      key: "name"
    },
    {
      name: "Branch",
      key: "branch"
    },
    {
      name: "Price",
      key: "price"
    },
    {
      name: "Current Unit",
      key: "current_unit",
      visible: false
    },
    {
      name: "Current Price",
      key: "current_price",
      visible: false
    },
    {
      name: "Bulk Price",
      key: "bulk_price",
      visible: false
    },
    {
      name: "Quantity",
      editable: true,
      key: "quantity"
    },
    {
      name: "Units",
      key: "units",
      selectable: true
    },
    {
      name: "Bulk Units",
      key: "bulk_units",
      visible: false
    },
    {
      name: "Tax %",
      key: "tax_pc",
    },
    {
      name: "Tax",
      key: "tax",
      computed: true,
      operation: "tax_pc / 100 * quantity * current_price",
    },
    {
      name: "Subtotal",
      key: "subtotal",
      computed: true,
      operation: "tax_pc / 100 + 1 * quantity * current_price",
    },
    {
      name: "Conversion",
      key: "conversion",
      visible: false
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
