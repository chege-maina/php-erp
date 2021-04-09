<div class="card">
  <div class="card-body py-3">
    <div class="row">
      <div class="col px-4">
        <div class="row m-0 p-0">
          <small>
            <b>
              <?= $_SESSION['name'] ?>
            </b>
            ,
            <?= $_SESSION['branch'] ?>
          </small>
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
        <!-- TODO: Possibly show alert? -->
        <a class="btn btn-falcon-default btn-sm" href="../includes/logout.php">
          <span class="fas fa-door-open"></span>
          End Session
        </a>
      </div>
    </div>
  </div>
</div>
