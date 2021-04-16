<script>
  // $(document).ready(function() {
  // $('.btn').click(function() {
  // $('#myModal').modal('show');
  // });
  // });

  window.addEventListener('show_category_crud', event => {
    // console.log(event.detail);
    console.log("Ready to begin");
  });
</script>

<div id="myModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal Title</h5>
        <button type="button" class="close" data-dismiss="modal">
          &times;
        </button>
      </div>
      <div class="modal-body">
        <p>
          This is a simple Bootstrap modal. Click the "Cancel button",
          "cross icon" or "dark gray area" to close or hide the modal.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">
          Cancel
        </button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>
