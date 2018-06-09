<?php if(is_file("../../wd_protect.php")){ include_once "../../wd_protect.php"; } ?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">WebSite Builder</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="<?php wd_url($wd_type, $wd_app, 'start.php', ''); ?>">Pages</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pcss.php', ''); ?>">CSS</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pheader.php', ''); ?>">Header</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pmedia.php', ''); ?>">Media</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pbanner.php', ''); ?>">Banner</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pfooter.php', ''); ?>">Footer</a></li>
        <li class="active"><a href="<?php wd_url($wd_type, $wd_app, 'psettings.php', ''); ?>">Settings</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pplugins.php', ''); ?>">Plugins</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pthemes.php', ''); ?>">Themes</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'stats.php', ''); ?>">Stats</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'log.php', ''); ?>">Log</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      </ul>
    </div>
  </div>
</nav>
<?php
if(file_exists("www/dtheme.txt")){
  $theme = file_get_contents("www/dtheme.txt");
  if(file_exists("www/Themes/" . $theme . "/settings.php")){
    include "www/Themes/" . $theme . "/settings.php";
  }
}
?>
