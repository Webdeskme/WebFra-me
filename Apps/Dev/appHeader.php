<nav class="navbar navbar-expand-md bg-light">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand text-dark" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><img src="//<?php echo $_SERVER["HTTP_HOST"] ?>/<?php echo $wd_type ?>/<?php echo $wd_app ?>/ic.png" width="48" class="img mr-2" /> Developer Tools</a>
      <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#terminalNavbar" aria-controls="terminalNavbar" aria-expanded="false" aria-label="Toggle navigation">-->
      <!--  <i class="fa fa-bars fa-fw"></i>-->
      <!--</button>-->
    </div>
    <div class="collapse justify-content-end navbar-collapse" id="terminalNavbar">

      <!--<ul class="navbar-nav justify-content-end">-->
      <!--  <li class="nav-item"></li>-->

      <!--  </li>-->
      <!--</ul>-->
      <ul class="navbar-nav justify-content-end">
        <?php
        /*// TO BE IMPLEMENTED SOMEDAY
        $dev_types = $wd_dt->getProjectTypes();
        foreach($dev_types as $key => $dev_type){
          ?>
          <li class="nav-item"><a href="<?php wd_url($wd_type, $wd_app, 'start.php', '&displayType=' . $dev_type["dir"]); ?>" class="nav-link <?php echo ($req["displayType"] == $dev_type["dir"]) ? "active" : "" ?>"><?php echo $dev_type["name"] ?></a></li>
          <?php
        }
        */
        ?>
      </ul>
        

    </div>
  </div>
</nav>