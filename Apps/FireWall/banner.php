<?php include_once "../../wd_protect.php"; ?>
 <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="<?php wd_url($wd_type, $wd_app, 'start.php', '') ?>"><?php echo $wd_app; ?></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="<?php wd_url($wd_type, $wd_app, 'site.php', '') ?>">Sites</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php wd_url($wd_type, $wd_app, 'ip.php', '') ?>">IP Filters</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php wd_url($wd_type, $wd_app, 'set.php', '') ?>">Settings</a>
      </li>
    </ul>
  </div>
</nav>
