<nav class="webdesk_navbar webdesk_navbar-expand-md webdesk_bg-light">
  <div class="webdesk_container-fluid">
    <div class="webdesk_navbar-header">
      <a class="webdesk_navbar-brand webdesk_text-dark" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><img src="//<?php echo $_SERVER["HTTP_HOST"] ?>/<?php echo $wd_type ?>/<?php echo $wd_app ?>/ic.png" width="48" class="webdesk_img webdesk_mr-2" /> Site Builder</a>
      <button class="webdesk_navbar-toggler" type="button" data-toggle="webdesk_collapse" data-target="#terminalNavbar" aria-controls="terminalNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars fa-fw"></i>
      </button>
    </div>
    <div class="webdesk_collapse webdesk_justify-content-end webdesk_navbar-collapse" id="terminalNavbar">

      <ul class="webdesk_navbar-nav webdesk_justify-content-end">
        
        <?php
        $app_nav = $wf_pagebuilder->getAppNav();
        
        foreach($app_nav as $title => $page){
          ?>
          <li class="webdesk_nav-item"><a class="webdesk_nav-link" href="<?php wd_url($wd_type, $wd_app, $page, ''); ?>"><?php echo $title ?></a></li>
          <?php
        }
        ?>
      
      </ul>
      

    </div>
  </div>
</nav>

<nav class="webdesk_navbar webdesk_bg-light webdesk_border-top">
  <div class="webdesk_container-fluid">
    <ul class="webdesk_navbar-nav">
      <li class="webdesk_navbar-item">
        <div class="webdesk_btn-group" role="group" aria-label="Basic example">
          <a href="<?php wd_url($wd_type, $wd_app, "page.php", "&page=".$req["page"]); ?>" class="webdesk_btn webdesk_btn-<?php echo ($req["sec"] == "page.php") ? "secondary webdesk_text-white" : "outline-secondary"; ?>">Code</a>
          <a href="<?php wd_url($wd_type, $wd_app, "pageB.php", "&page=".$req["page"]); ?>" class="webdesk_btn webdesk_btn-<?php echo ($req["sec"] == "pageB.php") ? "secondary webdesk_text-white" : "outline-secondary"; ?>">Basic</a>
        </div>
      </li>
    </ul>
    <ul class="webdesk_navbar-nav">
      <li class="webdesk_navbar-item">
        <a href="<?php wd_urlSub($wd_type, $wd_app, 'publishSite.php', '&return=' . urlencode($req["sec"].((!empty($req["page"])) ? "&page=".$req["page"] : ""))); ?>" class="webdesk_btn webdesk_btn-warning webdesk_shadow-sm webdesk_border"><i class="fa fa-shipping-fast fa-fw"></i> Publish Site</a>
        
      </li>
      
    </ul>
  </div>
</nav>