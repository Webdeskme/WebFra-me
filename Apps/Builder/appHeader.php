<nav class="navbar navbar-expand-md bg-light">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand text-dark" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>"><img src="//<?php echo $_SERVER["HTTP_HOST"] ?>/<?php echo $wd_type ?>/<?php echo $wd_app ?>/ic.png" width="48" class="img mr-2" /> Site Builder</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#terminalNavbar" aria-controls="terminalNavbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars fa-fw"></i>
      </button>
    </div>
    <div class="collapse justify-content-end navbar-collapse" id="terminalNavbar">

      <ul class="navbar-nav justify-content-end">
        
        <?php
        $app_nav = $wf_pagebuilder->getAppNav();
        
        foreach($app_nav as $title => $page){
          ?>
          <li class="nav-item"><a class="nav-link" href="<?php wd_url($wd_type, $wd_app, $page, ''); ?>"><?php echo $title ?></a></li>
          <?php
        }
        ?>
      
      </ul>
      

    </div>
  </div>
</nav>

<nav class="navbar bg-light border-top">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <li class="navbar-item">
        <?php
        if(!empty($req["sec"]) && in_array($req["sec"], array("page.php", "pageB.php"))){
          ?>
          <div class="btn-group" role="group" aria-label="Basic example">
            <a href="<?php wd_url($wd_type, $wd_app, "page.php", "&page=".$req["page"]); ?>" class="btn btn-<?php echo ($req["sec"] == "page.php") ? "secondary text-white" : "outline-secondary"; ?>">Code</a>
            <a href="<?php wd_url($wd_type, $wd_app, "pageB.php", "&page=".$req["page"]); ?>" class="btn btn-<?php echo ($req["sec"] == "pageB.php") ? "secondary text-white" : "outline-secondary"; ?>">Basic</a>
          </div>
          <?php
        }
        ?>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="navbar-item">
        <a href="<?php wd_urlSub($wd_type, $wd_app, 'publishSite.php', '&return=' . urlencode($req["sec"].((!empty($req["page"])) ? "&page=".$req["page"] : ""))); ?>" class="btn btn-warning shadow-sm border"><i class="fa fa-shipping-fast fa-fw"></i> Publish Site</a>
        
      </li>
      
    </ul>
  </div>
</nav>