<script>
  window.addEventListener('DOMContentLoaded', (event) => {

    fetch('./pos_items_sales.php')
      .then(response => response.json())
      .then(data => {
        console.log("Fetched: ", data);
      })
      .catch((error) => {
        console.error('Error:', error);
      });


  });
</script>
