<nav class="webdesk_navbar webdesk_navbar-expand-md webdesk_bg-light">
  <div class="webdesk_container-fluid">
    <div class="webdesk_navbar-header">
      <a class="webdesk_navbar-brand webdesk_text-dark" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><img src="//<?php echo $_SERVER["HTTP_HOST"] ?>/<?php echo $wd_type ?>/<?php echo $wd_app ?>/ic.png" width="48" class="webdesk_img webdesk_mr-2" /> Developer Tools</a>
      <!--<button class="webdesk_navbar-toggler" type="button" data-toggle="webdesk_collapse" data-target="#terminalNavbar" aria-controls="terminalNavbar" aria-expanded="false" aria-label="Toggle navigation">-->
      <!--  <i class="fa fa-bars fa-fw"></i>-->
      <!--</button>-->
    </div>
    <div class="webdesk_collapse webdesk_justify-content-end webdesk_navbar-collapse" id="terminalNavbar">

      <!--<ul class="webdesk_navbar-nav webdesk_justify-content-end">-->
      <!--  <li class="webdesk_nav-item"></li>-->

      <!--  </li>-->
      <!--</ul>-->
      <ul class="webdesk_navbar-nav webdesk_justify-content-end">
        <?php
        /*// TO BE IMPLEMENTED SOMEDAY
        $dev_types = $wd_dt->getProjectTypes();
        foreach($dev_types as $key => $dev_type){
          ?>
          <li class="webdesk_nav-item"><a href="<?php wd_url($wd_type, $wd_app, 'start.php', '&displayType=' . $dev_type["dir"]); ?>" class="webdesk_nav-link <?php echo ($req["displayType"] == $dev_type["dir"]) ? "webdesk_active" : "" ?>"><?php echo $dev_type["name"] ?></a></li>
          <?php
        }
        */
        ?>
      </ul>
        

    </div>
  </div>
</nav>