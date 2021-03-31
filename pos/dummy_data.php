<script>
  const headers = [{
      name: "key",
      editable: false,
      key: "key",
      computed: false
    },
    {
      name: "Name",
      editable: false,
      key: "name",
      computed: false
    },
    {
      name: "Code",
      editable: false,
      key: "code",
      computed: false
    },
    {
      name: "Stock",
      editable: false,
      key: "stock",
      computed: false
    },
    {
      name: "Quantity",
      editable: true,
      key: "quantity",
      computed: false
    },
    {
      name: "Price",
      editable: false,
      key: "price",
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


  let json_items = [{
      key: 1,
      name: "Sunsipaque",
      code: "497-23-2865",
      stock: 9,
      quantity: 3,
      balance: 43,
      price: 5176,
      discount: 82,
      tax: 84,
      tax_pc: 0,
      subtotal: 0,
      image_url: "http://dummyimage.com/532x548.png/dddddd/000000",
    },
    {
      key: 2,
      name: "All Day",
      code: "223-32-5184",
      stock: 69,
      quantity: 2,
      balance: 92,
      price: 4296,
      discount: 3,
      tax: 89,
      tax_pc: 0,
      subtotal: -1,
      image_url: "http://dummyimage.com/516x539.png/5fa2dd/ffffff",
    },
    {
      key: 3,
      name: "Pulmo 8",
      code: "356-89-1023",
      stock: 62,
      quantity: 1,
      balance: 61,
      price: 1123,
      discount: 38,
      tax: 41,
      tax_pc: 0,
      subtotal: 0,
      image_url: "http://dummyimage.com/518x548.png/ff4444/ffffff",
    },
    {
      key: 4,
      name: "Bupropion Hydrochloride",
      code: "557-97-6362",
      stock: 98,
      quantity: 6,
      balance: 76,
      price: 7127,
      discount: 51,
      tax: 90,
      tax_pc: -1,
      subtotal: -1,
      image_url: "http://dummyimage.com/508x549.png/dddddd/000000",
    },
    {
      key: 5,
      name: "Benazepril Hydrochloride and Hydrochlorothiazide",
      code: "443-28-6453",
      stock: 77,
      quantity: 6,
      balance: 60,
      price: 8404,
      discount: 69,
      tax: 15,
      tax_pc: 0,
      subtotal: -1,
      image_url: "http://dummyimage.com/507x517.png/5fa2dd/ffffff",
    },
    {
      ke: 6,
      name: "Nartussal",
      code: "583-67-6246",
      stock: 43,
      quantity: 7,
      balance: 87,
      price: 2447,
      discount: 5,
      tax: 30,
      tax_pc: 0,
      subtotal: 0,
      image_url: "http://dummyimage.com/503x509.png/5fa2dd/ffffff",
    },
    {
      key: 7,
      name: "Argentum Nitricum 6x",
      code: "472-76-3927",
      stock: 16,
      quantity: 7,
      balance: 57,
      price: 5296,
      discount: 81,
      tax: 46,
      tax_pc: -1,
      subtotal: 0,
      image_url: "http://dummyimage.com/504x514.png/cc0000/ffffff",
    },
    {
      key: 8,
      name: "OXYGEN",
      code: "247-93-9447",
      stock: 99,
      quantity: 8,
      balance: 38,
      price: 9396,
      discount: 20,
      tax: 39,
      tax_pc: 0,
      subtotal: 0,
      image_url: "http://dummyimage.com/526x548.png/cc0000/ffffff",
    },
    {
      key: 9,
      name: "Clean and Clear Advantage",
      code: "592-14-3054",
      stock: 46,
      quantity: 3,
      balance: 83,
      price: 5156,
      discount: 57,
      tax: 76,
      tax_pc: -1,
      subtotal: 0,
      image_url: "http://dummyimage.com/526x526.png/ff4444/ffffff",
    },
    {
      key: 10,
      name: "Metronidazoleiya",
      code: "230-96-5894",
      stock: 47,
      quantity: 3,
      balance: 30,
      price: 8585,
      discount: 35,
      tax: 30,
      tax_pc: 1,
      subtotal: 0,
      image_url: "http://dummyimage.com/528x514.png/dddddd/000000",
    },
  ];
</script>
