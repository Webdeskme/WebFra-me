<nav class="navbar navbar-expand-md bg-light">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand text-dark" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><img src="//<?php echo $_SERVER["HTTP_HOST"] ?>/<?php echo $wd_type ?>/<?php echo $wd_app ?>/ic.png" width="48" class="img mr-2" /> Creator's Market</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#terminalNavbar" aria-controls="terminalNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars fa-fw"></i>
      </button>
    </div>
    <div class="collapse justify-content-end navbar-collapse" id="terminalNavbar">
      
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item">
          
          
          
        </li>
      </ul>
      <form id="searchForm" class="form-inline my-2 my-lg-0 noloadingicon">
        <div class="input-group">
          <input class="form-control" type="text" name="search" placeholder="Search" aria-label="Search" onfocus="$(this).css('width','50vw');" />
          <div class="input-group-append">
            <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" /><i class="fa fa-search fa-fw"></i></button>
          </div>
        </div>
      </form>
    </div>
  </div>
</nav>