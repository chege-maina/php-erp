<!-- has the logo and sidenav -->
<script>
  var isFluid = JSON.parse(localStorage.getItem('isFluid'));
  if (isFluid) {
    var container = document.querySelector('[data-layout]');
    container.classList.remove('container');
    container.classList.add('container-fluid');
  }
</script>

<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
  <script>
    var navbarStyle = localStorage.getItem("navbarStyle");
    if (navbarStyle && navbarStyle !== 'transparent') {
      document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
    }
  </script>
  <div class="d-flex align-items-center">
    <div class="toggle-icon-wrapper">

      <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-toggle="tooltip" data-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

    </div><a class="navbar-brand" href="../index.html">
      <div class="d-flex align-items-center py-3"><img class="mr-2" src="../assets/img/logos/qubes.jpeg" alt="OG LOL" width="40" /><span class="font-sans-serif">Qubes</span>
      </div>
    </a>
  </div>
  <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
    <!--vertical navbar-->
    <?php
    require 'sidenav-shared.php';
    genSideBar();
    ?>
  </div>
</nav>
