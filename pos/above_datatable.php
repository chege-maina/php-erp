<div class="card">
  <div class="card-body py-3">
    <div class="row">
      <div class="col px-4">
        <div class="row m-0 p-0">
          <b>
            <small>
              <?= $_SESSION['name'] ?>
            </small>
          </b>
        </div>
        <div class="row m-0 p-0">
          <small>
            Logged in at:
            <?= $_SESSION['login_time'] ?>
            , <?php echo date("d/m/Y"); ?>
          </small>
        </div>
      </div>
      <div class="col col-auto d-flex align-items-center">
        <button class="btn btn-falcon-default btn-sm">
          <span class="fas fa-door-open"></span>
          End Session
        </button>
      </div>
    </div>
  </div>
</div>
