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
        <li><a href="<?php wd_url($wd_type, $wd_app, 'psettings.php', ''); ?>">Settings</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'pplugins.php', ''); ?>">Plugins</a></li>
        <li class="active"><a href="<?php wd_url($wd_type, $wd_app, 'pthemes.php', ''); ?>">Themes</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'stats.php', ''); ?>">Stats</a></li>
        <li><a href="<?php wd_url($wd_type, $wd_app, 'log.php', ''); ?>">Log</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">

      </ul>
    </div>
  </div>
</nav>
<div class="panel panel-primary">
  <div class="panel-heading"><b>Choose an Installed Theme</b></div>
  <div class="panel-body">
  <?php
    $dir = scandir("www/Themes/");
    foreach($dir as $theme){
      if($theme != "." && $theme != ".."){
        ?>
    <span class="well"<?php if(file_exists("www/dtheme.txt")){
          $dtheme = test_input(file_get_contents("www/dtheme.txt"));
          if($theme == $dtheme){
            echo 'style="background-color: #99ff99;" data-toggle="popover" data-trigger="hover" title="Active" data-content="This theme is currently set to active."';
          }
        } ?>>
    <a href="<?php wd_urlSub($wd_type, $wd_app, 'pthemeSub.php', '&theme=' . $theme); ?>" data-toggle="tooltip" title="<?php if(file_exists("www/Themes/" . $theme . "/tell.txt")){
          echo test_input(file_get_contents("www/Themes/" . $theme . "/tell.txt"));
        }
       else{
         echo "Sorry! No description is available.";
       }
       ?>"><button class="btn btn-success"><?php echo $theme; ?></button></a>
    </span>
    <?php
      }
    }
    ?>
  </div>
</div>
