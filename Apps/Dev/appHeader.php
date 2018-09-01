<nav class="webdesk_navbar webdesk_navbar-expand-md webdesk_bg-light">
  <div class="webdesk_container-fluid">
    <div class="webdesk_navbar-header">
      <a class="webdesk_navbar-brand webdesk_text-dark" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><img src="//<?php echo $_SERVER["HTTP_HOST"] ?>/<?php echo $wd_type ?>/<?php echo $wd_app ?>/ic.png" width="48" class="webdesk_img webdesk_mr-2" /> Developer Tools</a>
      <button class="webdesk_navbar-toggler" type="button" data-toggle="webdesk_collapse" data-target="#terminalNavbar" aria-controls="terminalNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars fa-fw"></i>
      </button>
    </div>
    <div class="webdesk_collapse webdesk_justify-content-end webdesk_navbar-collapse" id="terminalNavbar">

      <ul class="webdesk_navbar-nav webdesk_justify-content-end">
        <li class="webdesk_nav-item">

          <?php
          if(test_input($_GET["sec"]) == "projectEditor.php"){
            ?>
            <a href="<?php echo wd_url(test_input($_GET["editType"]), test_input($_GET["editApp"]), 'start.php', ''); ?>" target="_blank" class="webdesk_btn webdesk_btn-secondary webdesk_text-white" title="Preview app in a new window" data-toggle="webdesk_tooltip">
            <i class="fa fa-eye fa-fw"></i> Preview
          </a>
            <a href="#publishAppModal" class="webdesk_btn webdesk_btn-secondary webdesk_text-white" data-toggle="webdesk_modal" title="Publish to Marketplace">
              <i class="fa fa-shipping-fast fa-fw"></i> Publish
            </a>
            <span data-toggle="webdesk_tooltip" title="Delete app from WebDesk">
            <!--<a href="#" class="webdesk_btn webdesk_btn-danger webdesk_text-white" data-toggle="webdesk_modal" data-target="#deleteAppModal">-->
            <!--  <i class="fa fa-trash fa-fw"></i>-->
            <!--</a>-->
            <?php $get_app = test_input($_GET["editApp"]); ?>
            <?php echo wd_confirm($wd_type, $wd_app, "projectSubDelete.php", "&MyApp=" . $get_app, "removeAppModal", "<i class='fa fa-trash fa-fw'></i> Delete"); ?>
            </span>
            <?php
          }
          ?>

        </li>
      </ul>
      <ul class="webdesk_navbar-nav webdesk_justify-content-end">
        <?php
        $dev_types = $wd_dt->getProjectTypes();
        foreach($dev_types as $key => $dev_type){
          ?>
          <li class="webdesk_nav-item"><a href="<?php wd_url($wd_type, $wd_app, 'start.php', '&displayType=' . $dev_type["dir"]); ?>" class="webdesk_nav-link <?php echo ($req["displayType"] == $dev_type["dir"]) ? "webdesk_active" : "" ?>"><?php echo $dev_type["name"] ?></a></li>
          <?php
        }
        ?>
      </ul>
        

    </div>
  </div>
</nav>